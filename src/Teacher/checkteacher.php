<?php
include('DBConnector.php');
session_start();

$id_teacher = -1;
$teacher_id_val = "";

if (!isset($_SESSION['teacher_id'])) {
  header("Location: signin.php");
  exit;
} else {
  if ($id_teacher < 0) {
    $teacher_id_val = $_SESSION['teacher_id'];
    $query = "SELECT idteacher_info FROM teacher_info WHERE teacher_id='" . $teacher_id_val . "'";
    $data = mysqli_query($conn, $query);
    $row = $data->fetch_row();

    $id_teacher = $row[0];
  }
}

 ?>
