<?php
include_once('checkdepartment.php');

$year = $_POST['year'];
$term = $_POST['term'];

$cols = "idcourse_info, course_code, course_title";
$query = "SELECT " . $cols . " from course_info where department_info_iddepartment_info=" . $id_department . " and course_level='" . $year . "-" . $term ."'";
$data = mysqli_query($connection, $query);

if ($data) {
  $count = mysqli_num_rows($data);
  if ($count <= 0) {
    echo "<option disabled selected>Select course</option>";
  } else {
    while ($row = $data->fetch_row()) {
      echo "<option value='" . $row[0] . "-" . $row[1] . "-" . $row[2] . "'>" . $row[1] . "-" . $row[2] . "</option>";
    }
  }
} else {
  echo "<option disabled selected>Select course</option>";
}

?>
