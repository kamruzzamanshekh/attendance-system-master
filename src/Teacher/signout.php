<?php
session_start();

if (isset($_SESSION['teacher_id'])) {
  session_destroy();
  header("Location: signin.php");
} else {
  header("Location: signin.php");
}

 ?>
