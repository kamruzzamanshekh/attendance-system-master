<?php
include('../variables.php');
$page = 'department';
 ?>

<html>
<head>
  <title>Sign In Department</title>
  <?php include('../headData.php') ?>
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
          <label>Sign in department</label>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="department_id" name="department_id" placeholder="Enter Department ID" autofocus>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="department_pass" name="department_pass" placeholder="Enter Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
      </form>
    </div>
  </div>
  <?php include('../footer.php'); ?>
</body>

</html>
