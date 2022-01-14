<?php
include('checkdepartment.php');
$query = "SELECT department_name from department_info where iddepartment_info=" . $id_department;
$data = mysqli_query($connection, $query);
$row = $data->fetch_row();
echo $row[0];
 ?>
