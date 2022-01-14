<?php
include('header.php');
$page = 'student';
?>

<body>
  <?php include('navbar.php'); ?>

  <section>
    <div class="container">
      <form class="" action="#show_students" method="POST">
        <div class="row">
          <div class="form-group col">
            <label>Select Session</label>
            <select class="custom-select" id="session" name="session">
              <option selected disabled>Select Session</option>
              <?php

              $query = "SELECT batch_count FROM department_info where iddepartment_info=" . $id_department;
              $data = mysqli_query($connection, $query);
              if ($data) {
                $row = $data->fetch_row();
                $currYear = date('Y');
                $prevYear = $currYear - 1;

                if ($row) {
                  $count = $row[0];
                  for ($i=0; $i < $count; $i++) {
                      $session = ($prevYear - $i) . "-" . ($currYear - $i);
                      echo "<option value='" . $session . "'>" . $session . "</option>";
                  }
                } else {
                  echo "<option selected disabled>No session found</option>";
                }
              } else {
                echo "<option selected disabled>No session found</option>";
              }

               ?>
            </select>
          </div>
        </div>

        <div align="center" class="row">
          <div class="form-group col">
            <button type="submit" class="btn btn-primary mt-5" id="go_get_student_list">Get student list</button>
          </div>
        </div>
      </form>

      <div class="row" id="show_students" style="display: <?php echo $show_students_display; ?>">
        <div class="col-lg-8 mx-auto">
          <?php
            if (isset($_POST['session'])) {
              echo "<h2>Student Information</h2>";
              echo "<h3>";
              $session = $_POST['session'];
              $batch = explode("-", $session)[1] - 2005;
              echo "Batch " . $batch;
              echo "</h3>";
            }
             ?>
          <table class="table table-stripped table-bordered">
            <thead class="thead-dark">
              <?php
              if (isset($_POST['session'])) {
                echo "<tr>
                  <th>Student ID</th>
                  <th>Student Name</th>
                  <th>Contact Number</th>
                  <th>Email</th>
                </tr>";
              }
               ?>
            </thead>
            <tbody id="student_list">
              <?php
              if (isset($_POST['session'])) {
                $cols = "student_roll, student_name, student_mobile, student_email";
                $query = "SELECT " . $cols . " from student_info where student_session='" . $session . "' AND department_info_iddepartment_info=" . $id_department . " ORDER BY CAST(SUBSTRING(student_roll, 4, 2) AS INT) DESC, CAST(SUBSTRING(student_roll, 6, 5) AS INT)";
                $data = mysqli_query($connection, $query);

                while ($row = $data->fetch_row()) {
                    echo '<tr>
                    <td>' . $row[0] . '</td>
                    <td>' . ucwords(strtolower($row[1])) . '</td>
                    <td>' . $row[2] . '</td>
                    <td>' . $row[3] . '</td>
                  </tr>';
                }
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
