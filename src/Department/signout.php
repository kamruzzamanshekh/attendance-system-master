<?php
session_start();

if (isset($_SESSION['department_id'])) {
  session_destroy();
  header("Location: signin.php");
} else {
  header("Location: signin.php");
}

 ?>
