<?php include_once('checkteacher.php');
$course=$_POST['course'];
$session=$_POST['session'];
$DepartmentNameQuery ="select department_name,course_level FROM course_info course_info,department_info
 WHERE course_info.department_info_iddepartment_info=department_info.iddepartment_info
 AND course_info.course_code='" . $course ."'";

 $deptName=mysqli_query($conn, $DepartmentNameQuery)->fetch_row();
 $teacherNameQuery="select teacher_name,teacher_designation from teacher_info where idteacher_info='" . $id_teacher . "'";
 $teacherName=mysqli_query($conn,$teacherNameQuery)->fetch_row();

 $courseTitleQuery="select course_title from course_info where course_code='" . $course . "'";
 $courseTitle=mysqli_query($conn,$courseTitleQuery)->fetch_row();

 $year=substr($deptName[1],0,1);
 $term=substr($deptName[1],2,2);

echo "<div class='row'>";
echo "<div class='col'>";
echo "<h3 class=' pl-3'><b>Noakhali Science and Technology University</b></h3>";
echo "</div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col'>";
echo "<h4 class='pl-3'><b>" . $deptName[0] . "</b></h4>";
echo "</div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col'>";
echo "<h3 class=''><b>Session: </b><i>" . $session . "</i>, <b>Year-</b><i>" . $year. "</i>, <b>Term-</b><i>" . $term . "</i></h3>";
echo "</div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col'>";
echo "<h3><strong>Name and Designation of Course Teacher: </strong><i>" . $teacherName[0] . ", " . $teacherName[1] . "</i></h3>";
echo "</div>";
echo "</div>";
echo "<div class='row'>";
echo "<div class='col'>";
echo "<h3> <b>Course code:</b> <i>" . $course . "</i>, <b>Course Title</b>: <i>"  . $courseTitle[0] . "</i></h3>";
echo "</div>";
echo "</div>";
 ?>
