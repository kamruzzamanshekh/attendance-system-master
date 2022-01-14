<!DOCTYPE html>
<?php
$basedir = getcwd();
$basedirname = basename($basedir);
$file = dirname(__FILE__);
if ($basedirname == 'Department' || $basedirname == 'Teacher') {
  $basedir = '../';
} else {
  $basedir = './';
}

$page = 'aboutus';
 ?>
<html>
<head>
  <title>About Us</title>
  <?php include($basedir . 'headData.php') ?>
  <link rel="stylesheet" href="<?php echo $basedir; ?>vendor/fontawesome/css/brands.min.css">
  <style>
    .google::before {
      display: inline-block;
      text-rendering: auto;
      font-family: "Font Awesome 5 Brands";
      font-style: normal;
      font-size: inherit;
      content: "\f1a0";
    }
  </style>
</head>

<body data-spy="scroll" data-target="#navbarResponsive">
  <?php include('mainnavbar.php'); ?>
  <header class="page-header bg-primary mb-4">
    <div class="text-center text-white">
      <h1>Our Team</h1>
    </div>
  </header>
  <div class="container text-center">
    <div class="row text-center">
      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-light rounded shadow py-5 px-4"><img src="../res/abrar.jpg" alt="" width="100" class="rounded-circle mb-3 img-thumbnail shadow-sm" height="100">
          <p class="mb-0">Abrar Hossain Asif</p>
          <!-- <span class="small text-uppercase text-muted"></span> -->
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="mailto:s96mini.cube@gmail.com" class="social-link"><i class="google"></i></a></li>
          </ul>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-light rounded shadow py-5 px-4"><img src="../res/shekh.jpg" alt="" width="100" class="rounded-circle mb-3 img-thumbnail shadow-sm" height="100">
          <p class="mb-0">Kamruzzaman Shekh</p>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="mailto:shekhnstuiit@gmail.com" class="social-link"><i class="google"></i></a></li>
          </ul>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-light rounded shadow py-5 px-4"><img src="../res/shuvra.jpg" alt="" width="100" class="rounded-circle mb-3 img-thumbnail shadow-sm" height="100">
          <p class="mb-0">Shuvra Adittya</p>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="mailto:sadihurayv@gmail.com" class="social-link"><i class="google"></i></a></li>
          </ul>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-light rounded shadow py-5 px-4"><img src="../res/tamanna.jpg" alt="" width="100" height="100" class="rounded-circle mb-3 img-thumbnail shadow-sm" height="100">
          <p class="mb-0">Nishat Tasnim Tamanna</p>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="mailto:tasnim1825006f@gmail.com" class="social-link"><i class="google"></i></a></li>
          </ul>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-light rounded shadow py-5 px-4"><img src="../res/rahat.jpg" alt="" width="100" class="rounded-circle mb-3 img-thumbnail shadow-sm" height="100">
          <p class="mb-0">Rahat Uddin Azad</p>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="mailto:rahatuddin786@gmail.com" class="social-link"><i class="google"></i></a></li>
          </ul>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-light rounded shadow py-5 px-4"><img src="../res/moon.jpg" alt="" width="100" class="rounded-circle mb-3 img-thumbnail shadow-sm" height="100">
          <p class="mb-0">Moonmoon Das</p>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="mailto:munmundas838@gmail.com" class="social-link"><i class="google"></i></a></li>
          </ul>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-5">
        <div class="bg-light rounded shadow py-5 px-4"><img src="../res/khair.jpg" alt="" width="100" class="rounded-circle mb-3 img-thumbnail shadow-sm" height="100">
          <p class="mb-0">Khair Ahammed</p>
          <ul class="social mb-0 list-inline mt-3">
            <li class="list-inline-item"><a href="mailto:khairahmad6@gmail.com" class="social-link"><i class="google"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <?php include('footer.php'); ?>

</body>

</html>
