<?php include('dbconnection.php'); ?>

<?php
$test_query = $_POST['test_query'];
$val = $_POST['vals'];

$query = "SELECT * FROM course_assign WHERE " . $test_query;
$data = mysqli_query($connection, $query);
if ($data) {
  if ($row = $data->fetch_row()) {
    // echo "Already have";
    exit;
  }
}
$query = "INSERT into course_assign values (NULL, " . $val . ")";
$data = mysqli_query($connection, $query);

if ($data) {
  echo "Successfully assigned the course.";
} else {
  echo "Unsuccessful for assigning course.";
}

 ?>
