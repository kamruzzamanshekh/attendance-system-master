<?php

// Create connection
$connection = mysqli_connect("localhost", "root", "", "attendance_management");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
