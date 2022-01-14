<?php
include_once('checkdepartment.php');
$session = $_POST['session'];

$cols = "student_roll, student_name, student_mobile, student_email";
$query = "SELECT " . $cols . " from student_info where student_session='" . $session . "' AND department_info_iddepartment_info=" . $id_department . " ORDER BY CAST(SUBSTRING(student_roll, 4, 2) AS INT) DESC, CAST(SUBSTRING(student_roll, 6, 5) AS INT)";
$data = mysqli_query($connection, $query);
while ($row = $data->fetch_row()) {
    $serialNo=substr($row[1], 8, 10);
    // echo "alert($serialNo)";
    echo '<tr>
      <td>' . $row[0] . '</td>
      <td>' . ucwords(strtolower($row[1])) . '</td>
      <td>' . $row[2] . '</td>
      <td>' . $row[3] . '</td>
      </tr>';
}
