<?php
include('checkteacher.php');
$idteacher_info = $id_teacher;
$cols = "course_code";
$query = "SELECT " . $cols . " FROM course_info ci, course_assign ca WHERE ci.idcourse_info=ca.course_info_idcourse_info AND teacher_info_idteacher_info=" . $idteacher_info;
$data = mysqli_query($conn, $query);

while ($row = $data->fetch_row()) {
    echo "<option value='" .$row[0] . "'>" . $row[0] . "</option>";
}

?>
