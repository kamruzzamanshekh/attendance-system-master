<?php
include_once("Department/dbconnection.php");
include('variables.php');

$page = 'index';
//
// $cols = array("idteacher_info", "iddepartment_info");
// $tables = array("teacher_info", "department_info");
// foreach ($tables as $key => $value) {
//   $query = "SELECT " . $cols[$key] . " FROM " . $value;
//   $count = mysqli_num_rows(mysqli_query($connection, $query));
//
//   echo "C " . $count;
// }

// error_reporting(0);
 ?>

<html>

<head>
  <title>Welcome to NSTU</title>
  <?php include('headData.php') ?>
</head>

<body>
  <?php include('mainnavbar.php'); ?>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Welcome to NSTU</h1>
    </div>
  </header>

  <section>
    <div class="container text-center">

      <div class="card-deck">
        <div class="card w-75 shadow rounded">
          <div class="card-header">
            <h5 class="card-title">Department</h5>
          </div>
          <div class="card-body">
            <p class="card-text">In department course will be assigned to specific teacher.</p>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col">
                <p class="card-text vertical-center">
                  <small id="department_count" class="text-muted">
                    <!-- # Departments -->
                    <?php
                        $query = "SELECT iddepartment_info FROM department_info";
                        $count = mysqli_num_rows(mysqli_query($connection, $query));
                        if ($count <= 0) {
                          echo "No departments yet.";
                        } else {
                          echo $count . " Deparment(s)";
                        }
                       ?>
                  </small>
                </p>
              </div>
              <div class="col text-right">
                <a href="Department/index.php" class="btn btn-primary">Go</a>
              </div>
            </div>
          </div>
        </div>

        <div class="card w-75 shadow rounded">
          <div class="card-header">
            <h5 class="card-title">Teacher</h5>
          </div>
          <div class="card-body">
            <p class="card-text">Teacher section where teacher can give attendance to his/her specific assigned course students.</p>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col">
                <p class="card-text vertical-center">
                  <small class="text-muted" id="teacher_count">
                    <!-- # Teachers -->
                    <?php
                        $query = "SELECT idteacher_info FROM teacher_info";
                        $count = mysqli_num_rows(mysqli_query($connection, $query));
                        if ($count <= 0) {
                          echo "No teachers yet.";
                        } else {
                          echo $count . " Teacher(s)";
                        }
                       ?>
                  </small>
                </p>
              </div>
              <div class="col text-right">
                <a href="Teacher/index.php" class="btn btn-primary">Go</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <?php include('footer.php'); ?>
</body>

</html>
