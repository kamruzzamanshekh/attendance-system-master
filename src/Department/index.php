<?php
include('header.php');
$page = 'department';
 ?>

<body>
  <?php include('navbar.php'); ?>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>
        <?php
          $query = "SELECT department_name from department_info where iddepartment_info=" . $id_department;
          $data = mysqli_query($connection, $query);
          $row = $data->fetch_row();
          if (!$row) {
            echo "Unable to find deparment name.";
          } else {
            echo "Welcome to " . $row[0];
          }
         ?>
      </h1>
      <p class="lead">Department info</p>
    </div>
  </header>

  <section id="Home">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <p>Department information</p>
          <div>
            <p>Help</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include('../footer.php'); ?>
</body>

</html>
