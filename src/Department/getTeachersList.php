<?php
include('checkdepartment.php');

$cols = "teacher_id, teacher_name, teacher_designation, teacher_mobile, teacher_email";
$query = "SELECT " . $cols . " from teacher_info where department_info_iddepartment_info=" . $id_department;
$data = mysqli_query($connection, $query);

while ($row = $data->fetch_row()) {
    echo '<tr>
      <td>' . $row[1] . '</td>
      <td>' . $row[2] . '</td>
      <td>' . $row[3] . '</td>
      <td>' . $row[4] . '</td>
      </tr>';
}

?>
