<?php include('checkteacher.php'); ?>

<?php
// $batchCountQuery="select batch_count from department_info,teacher_info where" .  $id_teacher . =;
// $data=mysqli_query($conn, $query);
// $row = $data->fetch_row();
  $count = 4; // count will be get from database

  if ($count > 8) {
    $count = 8;
  }
  $currYear = date('Y');
  $prevYear = $currYear - 1;

  for ($i=0; $i < $count; $i++) {
    $session = ($prevYear - $i) . "-" . ($currYear - $i);
    echo "<option value='" . $session . "'>" . $session . "</option>";

  }
 ?>
