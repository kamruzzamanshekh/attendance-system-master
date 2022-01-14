<?php
include('DBConnector.php');
$teacherID = $_REQUEST['teacher_id'];
$teacherPassword = $_REQUEST['teacher_pass'];

session_start();

if (isset($_SESSION['teacher_id'])) {
  header("Location: index.php");
  exit;
} else {
  $query = "SELECT teacher_id, teacher_password FROM teacher_info WHERE teacher_id = '" . $teacherID . "'";
  $data = mysqli_query($conn, $query);

  if (mysqli_num_rows($data) > 0) {
    while($row = $data->fetch_row()) {
      if(md5($teacherPassword) == $row[1]){
        $_SESSION['teacher_id'] = $teacherID;
          header("Location: index.php");
          exit;
      } else {
        header("Location: signin.php");
        exit;
      }
    }
  } else {
    header("Location: signin.php");
    exit;
  }
}

 ?>
