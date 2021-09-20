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
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/fixedHeader.dataTables.min.css">
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
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Mutasi Table</h3>
                </div>
                
                  <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="<?= base_url('/Mutasi/uploading') ?>">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Nomor Rekening</label>
                          <select id="selectNorek" name="selectNorek" onchange="" class="form-control select2" style="width: 100%;">
                            <option value=0>--Select No Rek--</option>
                            <?php foreach ($norek as $val): ?>
                              <option value=<?= $val ?>><?= $val ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>File input</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="inputFile" id="inputFile">
                              <label class="custom-file-label" id="lblFile" name="lblFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-primary col start">
                                <i class="fas fa-upload"></i>
                                <span>Upload</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </form>
                    <div class="row">
                      <div class="col-md-12" style="overflow: scroll;">
                        <table id="tblMutasi" class="display table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th class="dt-head-center">Id</th>
                              <th class="dt-head-center">No Mutasi</th>
                              <th class="dt-head-center">Tanggal Mutasi</th>
                              <th class="dt-head-center">Keterangan</th>
                              <th class="dt-head-center">Kode Bank</th>
                              <th class="dt-head-center">Nominal</th>
                              <th class="dt-head-center">Tipe</th>
                              <th class="dt-head-center">Saldo</th>
                              <th class="dt-head-center">No Rek</th>
                              <th class="dt-head-center">Tanggal WA</th>
                              <th class="dt-head-center">Area</th>
                              <th class="dt-head-center">Customer</th>
                              <th class="dt-head-center">Bulan</th>
                              <th class="dt-head-center">No SI</th>
                              <th class="dt-head-center">No Payment</th>
                              <th class="dt-head-center">No Buku</th>
                              <th class="dt-head-center">No RP</th>
                              <th class="dt-head-center">No CF</th>
                              <th class="dt-head-center">Check 1</th>
                              <th class="dt-head-center">Check 2</th>
                              <th class="dt-head-center">Check 3</th>
                              <th class="dt-head-center">Check 4</th>
                              <th class="dt-head-center">Keterangan CS</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ([] as $val):?>
                            <tr>
                              <td class="dt-body-center"><?= $val->idrole ?></td>
                              <td class="dt-body-center"><?= $val->role ?></td>
                              <td class="dt-body-center"><?= $val->description ?></td>
                            </tr>
                          <?php endforeach ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th class="dt-head-center">Id</th>
                              <th class="dt-head-center">No Mutasi</th>
                              <th class="dt-head-center">Tanggal Mutasi</th>
                              <th class="dt-head-center">Keterangan</th>
                              <th class="dt-head-center">Kode Bank</th>
                              <th class="dt-head-center">Nominal</th>
                              <th class="dt-head-center">Tipe</th>
                              <th class="dt-head-center">Saldo</th>
                              <th class="dt-head-center">No Rek</th>
                              <th class="dt-head-center">Tanggal WA</th>
                              <th class="dt-head-center">Area</th>
                              <th class="dt-head-center">Customer</th>
                              <th class="dt-head-center">Bulan</th>
                              <th class="dt-head-center">No SI</th>
                              <th class="dt-head-center">No Payment</th>
                              <th class="dt-head-center">No Buku</th>
                              <th class="dt-head-center">No RP</th>
                              <th class="dt-head-center">No CF</th>
                              <th class="dt-head-center">Check 1</th>
                              <th class="dt-head-center">Check 2</th>
                              <th class="dt-head-center">Check 3</th>
                              <th class="dt-head-center">Check 4</th>
                              <th class="dt-head-center">Keterangan CS</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
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

    <?php $this->load->view('template/sidebarright'); ?>
  </div>
</body>
<script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery-ui.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/adminlte.js"></script>
  <script src="<?= base_url() ?>assets/js/datatables.min.js"></script>
  <script src="<?= base_url() ?>assets/js/dataTables.fixedHeader.min.js"></script>
  <script src="<?= base_url() ?>assets/js/dataTables.cellEdit.js"></script>
</html>
<script>
  // $("#selectNorek").closest('.card-body').dropzone({ url: "/uploads" });
</script>
<script>
  $('#inputFile').on('change',function(){
      var fileName = $(this).val();
      $(this).next('.custom-file-label').html(fileName);
  });
  $('#selectNorek').on('change',function(){
      console.log($(this).val());
  });
  
  // $('.preloader').children().show();
  var mutasiUpdate=()=>{

  }
  var initTableMutasi=()=>{
    $("#tblMutasi").DataTable({"scrollX": true,"ordering":false,"processing": true,"serverSide": true,"paging":   true,"pagingType":'simple_numbers',fixedHeader: {header: true,headerOffset: $('.main-header').outerHeight()},"ajax": "<?= base_url('Mutasi/showMutasi') ?>"}).MakeCellsEditable({"onUpdate": mutasiUpdate,columns:[1,2]});  
  };
  console.log($("#tblMutasi").find('tbody').find('td'));

  $("#tblMutasi").ready(function() {
    setTimeout(()=>{$("#tblMutasi").find('tbody').find('td').addClass("dt-body-center");},1000);
  });
  
  initTableMutasi();
</script>