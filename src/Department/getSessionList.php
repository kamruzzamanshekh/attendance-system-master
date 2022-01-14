<?php
include_once('checkdepartment.php');

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
