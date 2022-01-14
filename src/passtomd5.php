<?php include('Department/dbconnection.php') ?>

<?php

$teacher = array("teacher_info", "teacher_password", "teacher_id");
$department = array("department_info", "department_password", "iddepartment_info");

$array = "";
for ($i=0; $i < 2; $i++) {
  if ($i == 0) {
    $array = $department;
  } else {
    $array = $teacher;
  }

  $tableName = $array[0];
  $update_col_name = $array[1];
  $condition_col_name = $array[2];
  $cols = $condition_col_name . ", " . $update_col_name;

  $query = "SELECT " . $cols . " FROM " . $tableName;
  echo $query . " ";
  $data = mysqli_query($connection, $query);

  while ($row = $data->fetch_row()) {
    $query = "UPDATE " . $tableName . " SET " . $update_col_name . "='" . md5($row[1]) . "' WHERE " . $condition_col_name . "='" . $row[0] . "'";
    echo $query . " ";
    mysqli_query($connection, $query);
  }
}

 ?>
