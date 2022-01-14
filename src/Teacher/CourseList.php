<?php
include_once('checkteacher.php');

$batch = $_POST['batch'];
if (!$batch) {
  echo "<option selected disabled>No course found</option>";
  exit;
}

$query = "SELECT course_code from course_info ci, course_assign ca WHERE ci.idcourse_info=ca.course_info_idcourse_info AND ca.teacher_info_idteacher_info=" . $id_teacher . " AND ca.ca_batch='" . $batch . "'";
$data = mysqli_query($conn, $query);
if ($data) {
  $count = 0;
  while ($row = $data->fetch_row()) {
    echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
    $count++;
  }

  if ($count == 0) {
    echo "<option selected disabled>No course found</option>";
  }
} else {
  echo "<option selected disabled>No course found</option>";
}


 ?>
