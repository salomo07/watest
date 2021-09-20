<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= web_name ?></title>
  <link rel="stylesheet" href="../assets/css/sourcesanspro.css">
  <link rel="stylesheet" href="../assets/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/css/datatables.min.css">
</head>
<body class="layout-footer-fixed layout-fixed layout-navbar-fixed sidebar-collapse">
<div class="wrapper">


  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= web_logo ?>" alt="logo" height="60" width="60">
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
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Tabel Access Mutasi</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <button type="button" onclick={$("#tblRole").DataTable().row.add([0,'','','',1]).draw().node();} class="btn btn-danger nav-link"><i class="far fa-list-alt"></i> Add Access</button>
                    </div>
                  </div>
                  <div class="col-md-6">

                  </div>
                </div>
                <table id="tblAccessMutasi" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Role</th>
                      <th class="dt-head-center">Column</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ([] as $val):?>
                  <?php endforeach ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Role</th>
                      <th class="dt-head-center">Column</th>
                    </tr>
                  </tfoot>
                </table>
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

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery-ui.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/adminlte.js"></script>
<script src="../assets/js/datatables.min.js"></script>
<script src="../assets/js/dataTables.cellEdit.js"></script>
<script>
  var warning=false;
  var sendAjax = (url,data,callback)=>{ console.log("Data input:",data);
    $.ajax({
       url: url,method:"POST",data:data,dataType:"json",
       success: function(result){ 
        console.log("Result",result);
        callback(result);
       },
       error:(error)=>{
        console.log('Error : ',error)
       }
    });
  }
  var selectAccess1=(ele)=>{
    sendAjax("<?= base_url("/master/getAccess1"); ?>",{idrole:$(ele).find(':selected').val()},(result)=>{
      reinitAccess1(result);
    })
  }
  var selectMenuChange=(ele)=>{
    if($('#selectAccess2 :selected').val()==0||$('#selectAccessMenu1 :selected').val()==0)
    {alert('Please select Role & Menu 1');}
    else{
      sendAjax("<?= base_url('/master/getAccess2') ?>",{idrole:$('#selectAccess2 :selected').val(),idmenu1:$(ele).find(':selected').val()},(result)=>{
        reinitAccess2(result);
      })
    }
  }
  var selectMenu2=(ele)=>{
    if($('#selectMenu2 :selected').val()==0){}
    else{
      sendAjax("<?= base_url('/master/getMenu2') ?>",{id:$('#selectMenu2 :selected').val()},(result)=>{
        var html="";
        result.map((val,index)=> {
          html+='<tr><td class="dt-body-center">'+val.id+'</td><td class="dt-body-center">'+$('#selectMenu2 :selected').text()+'</td><td class="dt-body-center">'+val.label+'</td><td class="dt-body-center">'+val.url+'</td><td class="dt-body-center">'+val.class+'</td></tr>';
        })
        $('#tblMenu2').DataTable().destroy();
        $('#tblMenu2 > tbody').html(html);
        $('#tblMenu2').DataTable().MakeCellsEditable("destroy");
        initTableMenu2();
      })
    }
  }
  var btnAddMenu2=(ele)=>{
    if($('#selectMenu2 :selected').val()==0){alert('Please select Menu 1')}
    else $("#tblMenu2").DataTable().row.add([0,$('#selectMenu2 :selected').val(),'','','']).draw().node();
  }
  var btnAddAccess1=()=>{
    if($('#selectAccess1 :selected').val()==0){alert('Please select Access 1')}
    else $("#tblAccess1").DataTable().row.add([0,0,'','']).draw().node();
  }
  var btnAddAccess2=()=>{
    if($('#selectAccess2 :selected').val()!=0&&$('#selectAccessMenu1 :selected').val()!=0)
    {$("#tblAccess2").DataTable().row.add([0,$('#selectAccess2 :selected').val(),$('#selectAccessMenu1 :selected').val(),'','']).draw().node();}
    else{alert('Please select Role & Menu 1');}
  }
  var changePassword=(id)=>{
    sendAjax("<?= base_url("/master/changePassword"); ?>",{iduser:id,password:"1234"},()=>{alert("Password now is : 1234")});
  }
</script>
<script>
  var initTableAccess=()=>{
    $("#tblAccessMutasi").DataTable().MakeCellsEditable({"onUpdate": accessMutasiUpdate,columns:[1,3,4],"inputTypes": [{"column":4,"type": "list","options":roles}]});
  };
  var userUpdate= (updatedCell, updatedRow, oldValue) =>{
    sendAjax("<?= base_url("/master/updateUser"); ?>",{iduser:parseInt(updatedRow.data()[0]),username:updatedRow.data()[1],name:updatedRow.data()[3],idrole:parseInt(updatedRow.data()[4])},()=>{location.reload()});
  }
  var roles=<?= json_encode($roles); ?>;
  roles=roles.map((val,i)=> {return {"value": parseInt(val.idrole), "display": val.role }}); roles.unshift({"value": 0, "display": "---Select---"});
  var column=[{id:2,column:'Tanggal Mutasi'},{id:3,column:'Keterangan'},{id:4,column:'Kode Bank'},{id:5,column:'Nominal'},{id:6,column:'Tipe'},{id:7,column:'Saldo'},{id:8,column:'No Rek'}, {id:9,column:'Tanggal WA'},{id:10,column:'Area'},{id:11,column:'Customer'},{id:12,column:'Bulan'},{id:13,column:'No SI'},{id:14,column:'No Payment'},{id:15,column:'No Buku'},{id:16,column:'No RP'},{id:17,column:'No CF'},{id:18,column:'Check 1'},{id:19,column:'Check 2'},{id:20,column:'Check 3'},{id:21,column:'Check 4'},{id:22,column:'Keterangan CS'}];
  column=column.map((val,i)=> {return {"value": parseInt(val.id), "display": val.column }}); column.unshift({"value": 0, "display": "---Select---"});

  $('tbody > tr').hover((handlerIn, handlerOut) =>{ 
    var table=$(handlerIn.target).closest("table");
    $('.table').map((idx, elem) =>{
      $(elem).DataTable().MakeCellsEditable("destroy");
    })
    switch ($(table).attr('id')) {      
      case 'tblRole': {initTableAccess();break;}
    }
  });
  initTableAccess();
</script>
</body>
</html>
