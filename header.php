<?php
if (!defined('permit')) {
  exit('<br><br><br><h1>Error 404</h1><h2>Object not found!</h2>');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo root; ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo root; ?>assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    EXAM CARD QRcode GENERATOR
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo root; ?>font_awesome/fontawesome-4.3.0.min.css">
  <!-- CSS Files -->
  <link href="<?php echo root; ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo root; ?>assets/bootstrap-select-1.13.14/dist/css/bootstrap-select.css" rel="stylesheet" />
  <link href="<?php echo root; ?>assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo root; ?>assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <?php if (@$_GET['req'] != 'lgn') { ?>
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="<?php echo root; ?>rec" class="simple-text logo-mini">
          <img src="<?php echo root; ?>assets/img/favicon.png" width="60px" alt="">
        </a>
        <a href="<?php echo root; ?>rec" class="simple-text logo-normal">
          FPTB EXAM CARD
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <?php if (@$_SESSION['admin'] != "") { ?>
          <li <?php if (@$_GET['req'] == 'rec' || @$_GET['req'] == '') { echo 'class="active"'; } ?>>
            <a href="<?php echo root; ?>rec">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Add Records</p>
            </a>
          </li>

          <li <?php if (@$_GET['req'] == 'vrec') { echo 'class="active"'; } ?>>
            <a href="<?php echo root; ?>vrec">
              <i class="fa fa-database"></i>
              <p>View Records</p>
            </a>
          </li>

          <li <?php if (@$_GET['req'] == 'adms') { echo 'class="active"'; } ?>>
            <a href="<?php echo root; ?>adms">
              <i class="fa fa-users"></i>
              <p>Admin</p>
            </a>
          </li>

          <li <?php if (@$_GET['req'] == 'dcrs') { echo 'class="active"'; } ?>>
            <a href="<?php echo root; ?>dcrs">
              <i class="fa fa-book"></i>
              <p>Courses</p>
            </a>
          </li>
          <?php } ?>

          <?php if (@$_SESSION['inviglator'] != "") { ?>
          <li <?php if (@$_GET['req'] == 'ams') { echo 'class="active"'; } ?>>
            <a href="<?php echo root; ?>ams">
              <i class="fa fa-users"></i>
              <p>Attendance</p>
            </a>
          </li>
          <?php } ?>

          <li <?php if (@$_GET['req'] == 'fps') { echo 'class="active"'; } ?>>
            <a href="<?php echo root; ?>fps">
              <i class="fa fa-cogs"></i>
              <p>Settings</p>
            </a>
          </li>
          
          <li class="active-pro">
            <a href="<?php echo root; ?>out">
              <i class="fa fa-sign-out"></i>
              <p>Log Out</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <?php } ?>