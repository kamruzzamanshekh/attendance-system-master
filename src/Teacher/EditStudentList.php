<?php include('DBConnector.php'); ?>
<?php
$teacherID=4;
$session="2017-2018";//$_POST['session_str'];
$course="SE3101";//$_POST['course_code'];
$date="2020-02-10";//$_POST['date'];

// $query="select student_roll,student_name from student_info where student_session='" . $val . "'";
$query1="SELECT idcourse_info from course_info where course_code='" . $course . "'";
$data1=mysqli_query($conn,$query1);
$courseInfo = $data1->fetch_row();

$query2="SELECT idcourse_assign from course_assign where course_info_idcourse_info=" . $courseInfo[0] . " and teacher_info_idteacher_info=" . $teacherID . "";
$data2=mysqli_query($conn,$query2);
$AssignID = $data2->fetch_row();

$query3="SELECT * from attendance_iit_b13 where course_assign_idcourse_assign=" . $AssignID[0] . " and attendance_date='" .$date . "'";
// echo $query;
$data=mysqli_query($conn, $query3);

$col_count = mysqli_num_fields($data);

while ($row=$data->fetch_row()) {
    echo "<tr>";
    echo "<td scope='row'><input type='checkbox' name='check'></td>";
    // echo "<td>" . $row[0] . "</td>";
    for ($i=3; $i < $col_count - 2; $i++) {
      $isCheck = "";
      if ($row[$i] == 1) {
        $isCheck = "checked";
      }
      echo "<td scope='row'><input type='checkbox' name='check' " . $isCheck . " ></td>";
    }
    echo "<td>" . $row[1] . "</td>";
    echo "</tr>";
}
 ?>
