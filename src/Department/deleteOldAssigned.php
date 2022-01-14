<?php
include_once('checkdepartment.php');

$teacher_id = $_POST['teacher_id'];
$course_id = $_POST['course_id'];

$query = "DELETE FROM `course_assign` WHERE teacher_info_idteacher_info=". $teacher_id . " AND course_info_idcourse_info=" . $course_id;
$data = mysqli_query($connection, $query);

if ($data) {
  echo "Deleted successfully.";
} else {
  echo "Cannot Delete." . $data->error();
}

 ?>
