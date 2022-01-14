<?php
include_once('dbconnection.php');
session_start();

$id_department = -1;
$department_short_name = "";
$batch_count = 0;

if (!isset($_SESSION['department_id'])) {
  header("Location: signin.php");
  exit;
} else {

  // Need to know the id so that we can understand which department info to collect
  if ($id_department < 0) {
    $id_department = $_SESSION['department_id'];
    $query = "SELECT department_shortname, batch_count FROM department_info WHERE iddepartment_info=" . $id_department;
    $data = mysqli_query($connection, $query);
    $row = $data->fetch_row();

    if ($row) {
      $department_short_name = $row[0];
      $batch_count = $row[1];
    }
  }
}

 ?>
