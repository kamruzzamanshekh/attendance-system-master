<?php include('dbconnection.php'); ?>

<?php

$departmentID = $_REQUEST['department_id'];
$departmentPassword = $_REQUEST['department_pass'];

session_start();

if (isset($_SESSION['department_id'])) {
  header("Location: index.php");
  exit;
} else {
  $query = "SELECT iddepartment_info, department_password FROM department_info WHERE iddepartment_info = " . $departmentID;
  $data = mysqli_query($connection, $query);

  if (mysqli_num_rows($data) > 0) {
    while($row = $data->fetch_row()) {
      if(md5($departmentPassword) == $row[1]){
        $_SESSION['department_id'] = $departmentID;
          header("Location: index.php");
          exit;
      } else {
        header("Location: signin.php");
        alert("Invalid ID or Password");
        exit;
      }
    }
  } else {
    header("Location: signin.php");
    exit;
  }
}

 ?>
