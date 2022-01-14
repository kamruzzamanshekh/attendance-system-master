<?php
include('header.php');
$page = 'teacher';
 ?>

<body>
  <?php include('navbar.php'); ?>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Teacher List</h2>
          <h4>
            <?php
              $query = "SELECT department_name from department_info where iddepartment_info=" . $id_department;
              $data = mysqli_query($connection, $query);
              $row = $data->fetch_row();
              if (!$row) {
                echo "Unable to find deparment name.";
              } else {
                echo $row[0];
              }
             ?>
          </h4>
          <table class="table table-stripped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>Teacher Name</th>
                <th>Designation</th>
                <th>Contact Number</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody id="teacher_list">
              <?php

              $cols = "teacher_id, teacher_name, teacher_designation, teacher_mobile, teacher_email";
              $query = "SELECT " . $cols . " from teacher_info where department_info_iddepartment_info=" . $id_department;
              $data = mysqli_query($connection, $query);

              if ($data) {
                while ($row = $data->fetch_row()) {
                    echo '<tr>
                    <td>' . $row[1] . '</td>
                    <td>' . $row[2] . '</td>
                    <td>' . $row[3] . '</td>
                    <td>' . $row[4] . '</td>
                  </tr>';
                }
              } else {
                // Do nothing
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <?php include('../footer.php'); ?>
</body>

</html>
