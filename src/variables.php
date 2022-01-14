<?php
$basedir = getcwd();
$basedirname = basename($basedir);
$file = dirname(__FILE__);
if ($basedirname == 'Department' || $basedirname == 'Teacher') {
  $basedir = '../';
} else {
  $basedir = './';
}
 ?>
