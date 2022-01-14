<?php
include('checkdepartment.php');
$dept_id =$_POST['dept_id'];
$cols = "idteacher_info, teacher_name";
$query = "SELECT " . $cols . " from teacher_info where department_info_iddepartment_info=" . $dept_id;
$data = mysqli_query($connection, $query);

while ($row = $data->fetch_row()) {
  echo "<option value='" . $row[0] . "-" . $row[1] . "'>" . $row[1] . "</option>";
}

?>
