<?php
include_once('checkteacher.php');

$session=$_POST['session'];
$course=$_POST['course'];
$marks=$_POST['marks'];
$studentQuery="select student_roll,student_name,student_index from student_info where
student_session='" . $session . "' ORDER BY CAST(SUBSTRING(student_roll, 4, 2)
AS INT) DESC, CAST(SUBSTRING(student_roll, 6, 5) AS INT)";
$studentData=mysqli_query($conn, $studentQuery);

$assignCourseID_query="select idcourse_assign
from course_info ci, course_assign ca
where ci.idcourse_info=ca.course_info_idcourse_info and
ci.course_code='" . $course . "' and
ca.teacher_info_idteacher_info='" . $id_teacher . "'";

$courseAssignData=mysqli_query($conn, $assignCourseID_query);
$course_assign_id = $courseAssignData->fetch_row()[0];

$dept_id_query="SELECT department_info_iddepartment_info from teacher_info where idteacher_info=".$id_teacher;
$dept_id = mysqli_query($conn, $dept_id_query)->fetch_row();
$dept_snam_query="SELECT department_shortname from department_info where iddepartment_info=".$dept_id[0];

$dept_snam=mysqli_query($conn,$dept_snam_query)->fetch_row()[0];
$batch = (explode("-", $session))[1] - 2005;
$dept_sname_batch = $dept_snam."_b" . $batch;
$att_table = "attendance_" . $dept_sname_batch;

$totalClassQuery="SELECT COUNT(*) FROM " . $att_table . " WHERE
course_assign_idcourse_assign=" . $course_assign_id . "";
$totalClassData=mysqli_query($conn, $totalClassQuery);
$totalClassCount = $totalClassData->fetch_row()[0];

$col_query = "SELECT * FROM " . $att_table;
$col_data = mysqli_query($conn, $col_query);
// $col_count = mysqli_num_fields($col_data);
$col_count = mysqli_num_rows($studentData);
// echo "COL " . $col_count . " ";
$sum_val = "";
$fetch = $studentData->fetch_all();
for ($i=0; $i < $col_count; $i++) {
  $sep = ", ";
  if ($i == $col_count - 1) {
    $sep = "";
  }
  // $sum_val .= "SUM(s" . $i . ")" . $sep;
  $row = $fetch[$i];
  $sum_val .= "SUM(" . $row[2] . ")" . $sep; // Fetch 'student_index'
}
$att_query = "SELECT " . $sum_val . " FROM " . $att_table . " WHERE course_assign_idcourse_assign=" . $course_assign_id;

$att_data = mysqli_query($conn,$att_query)->fetch_row();

// $i = 0;
  if ($totalClassCount==0) {
    echo "This class has not started";
  }else {
    for ($i=0; $i < $col_count; $i++) {
      $row = $fetch[$i];
    // while ($row=$studentData->fetch_row()) {
    $percentage=round($att_data[$i] / $totalClassCount , 2 );
    $serialNo=$i+1;
      echo "<tr>";
      echo "<td>" .  $serialNo . "</td>";
      echo "<td>" . $row[0] . "</td>";
      echo "<td>" . ucwords(strtolower($row[1])) . "</td>";
    //  echo "<td>" . $course . "</td>";
      echo "<td class= 'text-capitalize'>" . $att_data[$i]  . "</td>";
    if ($percentage <0.7) {
      echo "<td class='bg-danger'>" . ($percentage) * 100  . "%</td>";
    }else {
      echo "<td>" . ($percentage) * 100  . "%</td>";
    }

      echo "<td>" . ($percentage  *  $marks) . "</td>";
      echo "</tr>";
      // $i++;
  }
}
?>
