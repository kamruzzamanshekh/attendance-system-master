<?php
include('header.php');

$page = 'batch';
$batch = $_GET['batch'];
 ?>

<body>
  <?php include('navbar.php'); ?>

  <?php
  echo "Batch" . $batch;
  $cols = "*";
  $table_name = "attendance_" . $department_short_name . "_b" . $batch;
  $query = "SELECT " . $cols . " from " . $table_name;
  $data = mysqli_query($connection, $query);
  while ($row = $data->fetch_row()) {
    $col_count = mysqli_num_fields($data);
    echo "<tr>";
    for ($i=1; $i < $col_count; $i++) {
      echo "<td>" . $row[$i] . "</td>";
    }
    echo "</tr>";
  }
  ?>

  <section>
    <div class="container">
      <div class="row">
        <h1>Student Attendance Report </h1>
        <table class="table table-stripped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>Student ID</th>
              <th>Name</th>
              <th>Course</th>
              <th>Total Class</th>
              <th>Percentage</th>
              <th>Marks</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </section>

  <?php include('../footer.php'); ?>
</body>

</html>
