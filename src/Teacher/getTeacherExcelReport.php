<?php
include_once('checkteacher.php');

$table_html = $_POST['table_html'];
$session = $_POST['sessionStr'];
$course_id = $_POST['courseStr'];

$DepartmentNameQuery ="select department_name,course_level FROM course_info course_info,department_info
 WHERE course_info.department_info_iddepartment_info=department_info.iddepartment_info
 AND course_info.course_code='" . $course_id ."'";
 $deptName=mysqli_query($conn, $DepartmentNameQuery)->fetch_row();
 $year=substr($deptName[1], 0, 1);
 $term=substr($deptName[1], 2, 2);

$table = new DOMDocument();
$table->loadHTML($table_html);
$columnData = array();
$rowData = array();
$i = 0;

// Get table data in array
$trs = $table->getElementsByTagName("tr");
foreach ($trs as $tr) {
    if ($tr->parentNode->tagName == 'thead') {
        $ths = $tr->getElementsByTagName("th");
        foreach ($ths as $th) {
            $columnData[] = trim($th->textContent);
        }
    } elseif ($tr->parentNode->tagName == 'tbody') {
        $j = 0;
        $tds = $tr->getElementsByTagName("td");
        foreach ($tds as $td) {
            $rowData[$i][$j++] = trim($td->textContent);
        }
        $i++;
    }
}
// print_r($columnData);
// print_r($rowData);

function cleanData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) {
        $str = '"' . str_replace('"', '""', $str) . '"';
    }
}

$filename = "CourseReport_Year-" . $year . "_Term-" . $year . "_Session-" . $session . ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

echo implode("\t", array_values($columnData)) . "\r\n";
foreach ($rowData as $row) {
    array_walk($row, __NAMESPACE__ . '\cleanData');
    echo implode("\t", array_values($row)) . "\r\n";
}
