<?php
include('Department/dbconnection.php');

$student_id = $_POST['student_id'];
$course_level = $_POST['course_level'];

echo "<h2 class='pl-3'><b>Noakhali Science and Technology University</b></h2>
      <h3 class='pl-3'><b>";

$query = "SELECT di.department_name, di.iddepartment_info, si.student_current_batch, si.student_name from student_info si, department_info di where di.iddepartment_info=si.department_info_iddepartment_info AND student_roll='" . $student_id . "'";
$data = mysqli_query($connection, $query)->fetch_row();

$dept_name = $data[0];
$stu_batch = $data[2];
$stu_name = $data[3];

$temp = explode('-', $course_level);
$year = $temp[0];
$term = $temp[1];

echo $dept_name;
echo "</b></h3>
      <h3>" . ucwords(strtolower($stu_name)) . "</h3>
      <h3><b>Batch: </b><i>" . $stu_batch . "</i></h3>
      <h3><b>Year: </b><i>" . $year . "</i>, <b>Term: </b><i>" . $term . "</i></h3>";
?>
