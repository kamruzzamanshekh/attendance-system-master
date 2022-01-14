<nav class="navbar navbar-expand-lg navbar-dark fixed-top header-color" id="mainNav">
  <div class="container">
    <a class="navbar-brand js-scroll-trigger" href="#page-top"><img width="30px" height="35px" src="../nstulogo.gif" alt=""> NSTU</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="nav navbar-nav ml-auto text-white">
        <li class="nav-item <?php if ($page == 'teacher') {echo 'active';} ?>"><a class="nav-link text-white" href="index.php">Home</a></li>
        <li class="nav-item <?php if ($page == 'attendance') {echo 'active';} ?>"><a class="nav-link text-white" href="attendance.php">Attendance</a></li>
        <li class="nav-item <?php if ($page == 'report') {echo 'active';} ?>"><a class="nav-link text-white" href="report.php">Report</a></li>
        <li class="nav-item <?php if ($page == 'editattendance') {echo 'active';} ?>"><a class="nav-link text-white" href="editAttendance.php">Edit</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="signout.php">Sign Out</a></li>
      </ul>
    </div>
  </div>
</nav>
