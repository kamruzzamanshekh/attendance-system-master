<?php
include('checkteacher.php');

$date = $_POST['date'];
$query = $_POST['query_val'];

$data = mysqli_multi_query($conn,$query);
if ($data) {
    echo "Attendance completed on " . $date;
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

 ?>
