<?php
include_once('checkteacher.php');
$course_code=$_POST['course_code'];
$dept_id_query="SELECT department_info_iddepartment_info from teacher_info where idteacher_info=".$id_teacher;
$dept_id=mysqli_query($conn, $dept_id_query)->fetch_row();

$dept_snam_query="SELECT department_shortname from department_info where iddepartment_info=".$dept_id[0];
$batch_query="SELECT ca_batch from course_assign where teacher_info_idteacher_info=".$id_teacher;

$dept_snam=mysqli_query($conn, $dept_snam_query)->fetch_row();
$batch=mysqli_query($conn, $batch_query)->fetch_row();
$dept_sname_batch=$dept_snam[0]."_b".$batch[0];

$col="idattendance_".$dept_sname_batch. ", attendance_date, present_count";
$table="course_assign ca, attendance_".$dept_sname_batch." adnb";
$condition="ca.idcourse_assign=adnb.course_assign_idcourse_assign";
$query="SELECT " .$col. " FROM " .$table. " WHERE " .$condition . " ORDER BY adnb.attendance_date DESC";
$data=mysqli_query($conn, $query);

if ($data) {
    echo "<thead class=\"thead-dark\">";
    echo "<tr>";
    echo "<th>Date</th>";
    echo "<th>Present</th>";
    echo "<th>Edit</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    $count = mysqli_num_rows($data);
    if (!$count) {
        echo "<tr><td>No Attendance given</td></tr>";
    } else {
        while ($row=$data->fetch_row()) {
            $vals = array($row[0], $dept_sname_batch);
            echo "<tr>";
            echo "<td>" . date("d-m-Y", strtotime($row[1])) . "</td>";
            echo "<td>".$row[2]."</td>";
            echo "<td><button type=\"button\" id=\"edit_single_attendance\" class=\"btn btn-outline-primary\" onclick=\"viewSingle('" . $row[0] . "', '" . $dept_sname_batch . "')\">Edit</button></td>";
            echo "</tr>";
        }
    }
    echo "</tbody>";
} else {
    echo "<tr><td>No Attendance given</td></tr>";
}
?>
