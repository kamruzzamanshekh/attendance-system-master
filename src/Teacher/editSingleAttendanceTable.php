<?php
include_once('checkteacher.php');

$atten_id=$_POST['attendance_id'];
$dept_sname_batch=$_POST['department_sname_batch'];

$for_check_col = "*";
$for_check_table = "attendance_" .$dept_sname_batch;
$for_check_condition = "idattendance_" .$dept_sname_batch. "=".$atten_id;
$for_check_query = "SELECT " .$for_check_col. " from " .$for_check_table. " where ".$for_check_condition;
$for_check_data = mysqli_query($conn,$for_check_query);
$for_check_col_count = mysqli_num_fields($for_check_data);

$for_ca_col = "ca.course_info_idcourse_info, ca.ca_batch";
$for_ca_table = "course_assign ca, attendance_" .$dept_sname_batch. " atten";
$for_ca_condition = "ca.idcourse_assign = atten.course_assign_idcourse_assign";
$for_ca_query = "SELECT " . $for_ca_col . " from " . $for_ca_table . " WHERE " . $for_ca_condition;
$for_ca_data = mysqli_query($conn,$for_ca_query)->fetch_row();
$course_id = $for_ca_data[0];
$course_batch = $for_ca_data[1];

$for_stduent_col = "s.student_roll, s.student_name, s.student_index";
$for_stduent_table = "student_info s, course_info c";
$for_stduent_condition = "s.department_info_iddepartment_info = c.department_info_iddepartment_info and c.idcourse_info = " .$course_id. " and s.student_current_batch = '" . $course_batch . "'";
$for_stduent_additional_condition = "ORDER by CAST(substring(student_roll,4,2) as INT ) DESC, CAST(substring(student_roll,6,5) as INT)";
$for_stduent_query = "SELECT " . $for_stduent_col . " from " . $for_stduent_table . " WHERE " . $for_stduent_condition. " ".$for_stduent_additional_condition;
$student_data = mysqli_query($conn,$for_stduent_query);
echo $for_stduent_query;

$for_check_data_val = $for_check_data->fetch_assoc();
// $for_check_data_val = $for_check_data->fetch_row();
// $check_data_array = array("");
// for ($i=3; $i < $for_check_col_count - 2; $i++) {
//   array_push($check_data_array, $for_check_data_val[$i]);
// }
// print_r($check_data_array);

$check_index=1;
while ($row=$student_data->fetch_row()) {
  $isCheck = "";

  $index = $row[2];
  if ($for_check_data_val[$index] == 1) {
    $isCheck = "checked";
  }
  // if ($check_data_array[$check_index] == 1) {
  //   $isCheck = "checked";
  // }
  $check_index++;
  $serial_no = substr($row[0],8,2);
  echo "<tr>";
  echo "<td scope='row'><input type='checkbox' name='check' " . $isCheck . " ></td>";
  echo "<td>".$serial_no."</td>";
  echo "<td hidden>" . $row[2] . "</td>";
  echo "<td>".$row[0]."</td>";
  echo "<td>".ucwords(strtolower($row[1]))."</td>";
  echo "</tr>";
}

// while ($row=$for_check_data->fetch_row()) {
//     //echo "<td scope='row'><input type='checkbox' name='check'></td>";
//     // echo "<td>" . $row[0] . "</td>";
//     for ($i=3; $i < $for_check_col_count - 2; $i++) {
//       $isCheck = "";
//       if ($row[$i] == 1) {
//         $isCheck = "checked";
//       }
//       echo "<tr>";
//       echo "<td scope='row'><input type='checkbox' name='check' " . $isCheck . " ></td>";
//       echo "<td scope='row'>01</td>";
//       echo "<td scope='row'>01M</td>";
//       echo "<td scope='row'>SADI</td>";
//       echo "</tr>";
//
//     }
//     //echo "<td>" . $row[1] . "</td>";
//
// }

 ?>
