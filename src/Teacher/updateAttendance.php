<?php
include('checkteacher.php');
$query = $_POST['query_val'] ;
$data = mysqli_query($conn,$query);
if ($data) {
  echo "Successful";
} else {
  echo "Unsuccessful";
}

 ?>
