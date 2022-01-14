<?php
  include_once('checkdepartment.php');

  $currYear = (new DateTime)->format("Y"); // date('Y');

  // From checkdepartment.php
  if ($batch_count > 9) {
    $batch_count = 8;
  }

  $baseyear = "2005";
  $rtn_data = '';
  for ($i=0; $i < $batch_count; $i++) {
    $num = ($currYear - $i - $baseyear);
    $suffix = " th";
    if ($num == 1) {
      $suffix = " st";
    } else if ($num == 2) {
      $suffix = " nd";
    } else if ($num == 3) {
      $suffix = " rd";
    }
    echo "<li class='nav-item'><a class='nav-link text-white' href='Batch.php?batch=" . ($num) . "'>" . $num . $suffix . "</a></li>";
  }

?>
