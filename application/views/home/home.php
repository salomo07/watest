<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= web_name ?></title>
  <link rel="stylesheet" href="assets/css/sourcesanspro.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>
<body class="layout-footer-fixed layout-fixed layout-navbar-fixed sidebar-collapse">
  <div class="wrapper">


    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="assets/img/logoPSG.ico" alt="logo" height="60" width="60">
    </div>
    <?= $this->session->userdata('dataMenubar'); ?>
    <?= $this->session->userdata('dataSidebar'); ?>


    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <?php $this->load->view('template/breadcrumb'); ?>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
          </div>
        </div>  
      </section>
    </div>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> <?= app_version ?>
      </div>
      <center>Copyright &copy; 2021 <a href="<?= base_url() ?>"><?= web_name ?></a>.</center>
    </footer>

    <?php $this->load->view('template/sidebarright'); ?>
  </div>
</body>
<script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery-ui.min.js"></script>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/adminlte.js"></script>
</html>
