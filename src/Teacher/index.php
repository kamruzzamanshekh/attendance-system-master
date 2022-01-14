<?php
include('header.php');
$page = "teacher";
?>

<body>
  <?php include('navbar.php'); ?>
  <header class="bg-primary text-white">
    <div class="container text-center">
      <?php
        $query = "SELECT teacher_name, teacher_designation FROM teacher_info WHERE idteacher_info=" . $id_teacher;
        $data = mysqli_query($conn, $query);
        $row = $data->fetch_assoc();
        $teacher_name = $row["teacher_name"];
        $teacher_designation = $row["teacher_designation"];
         ?>
      <h1><?php echo $teacher_name; ?></h1>
      <p><?php echo $teacher_designation; ?></p>
      <h1 id="attentdance"></h1>
    </div>
  </header>

  <?php include('../footer.php'); ?>
</body>

</html>
