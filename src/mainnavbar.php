<nav class="navbar navbar-expand-lg navbar-dark fixed-top header-color" id="mainNav">
  <div class="container">
    <a class="navbar-brand js-scroll-trigger" href="#page-top"><img width="30px" height="35px" src="<?php echo $basedir; ?>nstulogo.gif" alt=""> NSTU</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="nav navbar-nav ml-auto text-white">
        <li class="nav-item <?php if ($page == 'index') {echo 'active';} ?>"><a class="nav-link text-white" href="<?php echo $basedir; ?>index.php">Home</a></li>
        <li class="nav-item <?php if ($page == 'department') {echo 'active';} ?>"><a class="nav-link text-white" href="<?php echo $basedir; ?>Department/index.php">Department</a></li>
        <li class="nav-item <?php if ($page == 'teacher') {echo 'active';} ?>"><a class="nav-link text-white" href="<?php echo $basedir; ?>Teacher/index.php">Teacher</a></li>
        <li class="nav-item <?php if ($page == 'student') {echo 'active';} ?>"><a class="nav-link text-white" href="<?php echo $basedir; ?>studentreport.php">Student</a></li>
      </ul>
    </div>
  </div>
</nav>
