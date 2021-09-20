<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= web_name ?></title>
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/sourcesanspro.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css">
</head>
<body class="layout-footer-fixed layout-fixed layout-navbar-fixed sidebar-collapse">
  <div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= base_url(); ?>assets/img/logoPSG.ico" alt="logo" height="60" width="60">
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
          <div class="row" style="display: flex;align-items: center;">
            <div class="error-page">
              <h2 class="headline text-warning">404</h2>
              <div class="error-content">
                <h2>You are have no power here !!!</h2>
                <label>
                  Call <a href="https://www.linkedin.com/in/salomo07/">Iron Man</a> or <a href="https://web.facebook.com/Salomo07">Thor<a> to help you find a way.<br>
                  Or, <a href="<?= base_url() ?>">go home</a>, play with your sister.
                </label>
              </div>
            </div>
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

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
</body>
<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/js/jquery-ui.min.js"></script>

  <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/js/adminlte.js"></script>
</html>
