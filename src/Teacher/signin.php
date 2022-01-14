<?php
include('../variables.php');
$page = 'teacher';
?>

<html lang="en">
<head>
  <title>Sign In Teacher</title>
  <?php include('../headData.php'); ?>
  <style>
    .form-container {
      background: : #fff;
      border-radius: 0.625rem;
      position: absolute;
      top: 20vh;
    }
  </style>
</head>

<body>
  <?php include('../mainnavbar.php'); ?>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <form class="form-container shadow mt-3 p-5" action="welcome.php" method="POST">
        <div class="col-form-label text-center pb-4">
          <label>Sign in teacher</label>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="teacher_id" name="teacher_id" placeholder="Enter Teacher ID" autofocus>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="teacher_pass" name="teacher_pass" placeholder="Enter Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
      </form>
    </div>
  </div>
  <?php include('../footer.php'); ?>
</body>

</html>
