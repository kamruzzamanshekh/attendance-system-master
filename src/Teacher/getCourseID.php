<?php
include('checkteacher.php');
$course_code=$_POST['course_code'];
$query="select idcourse_assign from course_info ci, course_assign ca where ci.idcourse_info=ca.course_info_idcourse_info and ci.course_code='" . $course_code . "' and ca.teacher_info_idteacher_info='" . $id_teacher . "'";
$data=mysqli_query($conn, $query);
$row = $data->fetch_row();

echo $row[0];
 ?>
