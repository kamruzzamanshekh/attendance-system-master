<?php
include_once('checkdepartment.php');

$table_html = $_POST['table_html'];
$session = $_POST['sessionStr'];
$year_term = $_POST['year_termStr'];

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
  } else if ($tr->parentNode->tagName == 'tbody') {
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
  if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

$year_term = explode("-", $year_term);
$filename = "StudentReport_Year-" . $year_term[0] . "_Term-" . $year_term[1] . "_Session-" . $session . ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

echo implode("\t", array_values($columnData)) . "\r\n";
foreach ($rowData as $row) {
  array_walk($row , __NAMESPACE__ . '\cleanData');
  echo implode("\t", array_values($row)) . "\r\n";
}

 ?>
