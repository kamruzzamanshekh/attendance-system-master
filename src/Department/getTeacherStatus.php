<?php
include('checkdepartment.php');

$teacher_id = $_POST['teacher_id'];
$query = "SELECT teacher_status FROM teacher_info WHERE idteacher_info=" . $teacher_id;
$data = mysqli_query($connection, $query);
echo $data->fetch_row()[0];
 ?>
