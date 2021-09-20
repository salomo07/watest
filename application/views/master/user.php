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
          <div class="col-md-5">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Tabel Role</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <button type="button" onclick={$("#tblRole").DataTable().row.add([0,'','','',1]).draw().node();} class="btn btn-danger nav-link"><i class="far fa-list-alt"></i> Add Role</button>
                </div>
                <table id="tblRole" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Role</th>
                      <th class="dt-head-center">Description</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($roles as $val):?>
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
                      <th class="dt-head-center">Role</th>
                      <th class="dt-head-center">Description</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Tabel User</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="button" onclick={$("#tblUser").DataTable().row.add([0,'','','',1]).draw().node();} class="btn btn-danger float-right"><i class="fas fa-users"></i> Add User</button>
                    </div>
                    
                  </div>
                </div>
                <br>
                <table id="tblUser" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Username</th>
                      <th class="dt-head-center">Password</th>
                      <th class="dt-head-center">Nama</th>
                      <th class="dt-head-center">Role</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($users as $val):?>
                    <tr>
                      <td class="dt-body-center"><?= $val->iduser ?></td>
                      <td class="dt-body-center"><?= $val->username ?></td>
                      <td class="dt-body-center"><a href="#" onclick={changePassword(<?= $val->iduser ?>)}><center>Reset Password</center></a></td>
                      <td class="dt-body-center"><?= $val->name ?></td>
                      <td class="dt-body-center"><?= $val->role ?></td>
                    </tr>
                  <?php endforeach ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Username</th>
                      <th class="dt-head-center">Password</th>
                      <th class="dt-head-center">Nama</th>
                      <th class="dt-head-center">Role</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Tabel Menu</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="button" onclick={{$("#tblMenu1").DataTable().row.add([0,'','','']).draw().node();}} class="btn btn-warning"><i class="fas fa-th"></i> Add Menu 1</button>
                    </div>
                  </div>
                </div>
                <br>
                <table id="tblMenu1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Label</th>
                      <th class="dt-head-center">URL</th>
                      <th class="dt-head-center">Class</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($menu1 as $val):?>
                    <tr>
                      <td class="dt-body-center"><?= $val->id ?></td>
                      <td class="dt-body-center"><?= $val->label ?></td>
                      <td class="dt-body-center"><?= $val->url ?></td>
                      <td class="dt-body-center"><?= $val->class ?></td>
                    </tr>
                  <?php endforeach ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Label</th>
                      <th class="dt-head-center">URL</th>
                      <th class="dt-head-center">Class</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Tabel Menu 2</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="button" onclick={btnAddMenu2()} class="btn btn-warning float-right"><i class="fas fa-th"></i> Add Menu 2</button>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Menu 1</label>
                      <select id="selectMenu2" onchange="selectMenu2(this)" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value=0>--Select Menu 1--</option>
                        <?php foreach ($menu1 as $val): ?>
                          <option value=<?= $val->id ?>><?= $val->label ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                </div>
                <br>
                <table id="tblMenu2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Menu 1</th>
                      <th class="dt-head-center">Label</th>
                      <th class="dt-head-center">URL</th>
                      <th class="dt-head-center">Class</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ([] as $val):?>
                  <?php endforeach ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Menu 1</th>
                      <th class="dt-head-center">Label</th>
                      <th class="dt-head-center">URL</th>
                      <th class="dt-head-center">Class</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Tabel Access 1</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="button" onclick={btnAddAccess1()} class="btn btn-success"><i class="fas fa-sitemap"></i> Add Access 1</button>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Role</label>
                      <select id="selectAccess1" onchange="selectAccess1(this)" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value=0>--Select Role--</option>
                        <?php foreach ($roles as $val): ?>
                          <option value=<?= $val->idrole ?>><?= $val->role ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                </div>
                <br>
                <table id="tblAccess1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Role</th>
                      <th class="dt-head-center">Menu</th>
                      <th class="dt-head-center">Action</th>
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
                      <th class="dt-head-center">Menu</th>
                      <th class="dt-head-center">Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Tabel Access 2</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="button" onclick={btnAddAccess2()} class="btn btn-success float-right"><i class="fas fa-sitemap"></i> Add Access 2</button>
                    </div>
                  </div>
                  <div class="col-sm-6">                    
                    <div class="form-group">
                      <label>Role</label>
                      <select id="selectAccess2" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value=0>--Select Role--</option>
                        <?php foreach ($roles as $val): ?>
                          <option value=<?= $val->idrole ?>><?= $val->role ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">                    
                    <div class="form-group">
                      <label>Menu 1</label>
                      <select id="selectAccessMenu1" onchange="selectMenuChange(this)" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value=0>--Select Menu 1--</option>
                        <?php foreach ($menu1 as $val): ?>
                          <option value=<?= $val->id ?>><?= $val->label ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                </div>
                <br>
                <table id="tblAccess2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="dt-head-center">Id</th>
                      <th class="dt-head-center">Role</th>
                      <th class="dt-head-center">Menu 1</th>
                      <th class="dt-head-center">Menu 2</th>
                      <th class="dt-head-center">Action</th>
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
                      <th class="dt-head-center">Menu 1</th>
                      <th class="dt-head-center">Menu 2</th>
                      <th class="dt-head-center">Action</th>
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
  var initTableUser=()=>{
    $("#tblUser").DataTable().MakeCellsEditable({"onUpdate": userUpdate,columns:[1,3,4],"inputTypes": [{"column":4,"type": "list","options":roles}]});
  };
  var initTableRole=()=>{
    $("#tblRole").DataTable().MakeCellsEditable({"onUpdate": roleUpdate,columns:[1,2]});
  };
  var initTableMenu1=()=>{
    $("#tblMenu1").DataTable().MakeCellsEditable({"onUpdate": menu1Update,columns:[1,2,3]});
  };
  var initTableMenu2=()=>{
    $("#tblMenu2").DataTable().MakeCellsEditable({"onUpdate": menu2Update,columns:[2,3,4]});
  };
  var initTableAccess1=()=>{
    $("#tblAccess1").DataTable().MakeCellsEditable({"onUpdate": access1Update,columns:[2],"inputTypes":[{"column":2,"type": "list","options":menu1}]});
  };
  var initTableAccess2=()=>{
    $("#tblAccess2").DataTable().MakeCellsEditable({"onUpdate": access2Update,columns:[3],"inputTypes":[{"column":3,"type": "list","options":menu2}]});
  };
  var userUpdate= (updatedCell, updatedRow, oldValue) =>{
    sendAjax("<?= base_url("/master/updateUser"); ?>",{iduser:parseInt(updatedRow.data()[0]),username:updatedRow.data()[1],name:updatedRow.data()[3],idrole:parseInt(updatedRow.data()[4])},()=>{location.reload()});
  }
  var roleUpdate= (updatedCell, updatedRow, oldValue) =>{
    sendAjax("<?= base_url("/Master/updateRole"); ?>",{idrole:parseInt(updatedRow.data()[0]),role:updatedRow.data()[1],description:updatedRow.data()[2]},()=>{location.reload()});
  }
  var menu1Update= (updatedCell, updatedRow, oldValue) =>{
    sendAjax("<?= base_url("/Master/updateMenu1"); ?>",{id:parseInt(updatedRow.data()[0]),label:updatedRow.data()[1],url:updatedRow.data()[2],class:updatedRow.data()[3]},()=>{location.reload()});
  }
  var menu2Update= (updatedCell, updatedRow, oldValue) =>{
    sendAjax("<?= base_url("/Master/updateMenu2"); ?>",{id:parseInt(updatedRow.data()[0]),idmenu1:parseInt($('#selectMenu2 :selected').val()),label:updatedRow.data()[2],url:updatedRow.data()[3],class:updatedRow.data()[4]},()=>{});
  }
  var access1Update= (updatedCell, updatedRow, oldValue) =>{
    sendAjax("<?= base_url("/Master/updateAccess1"); ?>",{ idaccess1:parseInt(updatedRow.data()[0]),idrole:parseInt($('#selectAccess1 :selected').val()),idmenu1:parseInt(updatedRow.data()[2])},(result)=>{
      reinitAccess1(result);
    });
  }
  var reinitAccess1=(result)=>{
    var html="";
    result.map((val,index)=> {
      html+='<tr><td class="dt-body-center">'+val.idaccess1+'</td><td class="dt-body-center">'+val.role+'</td><td class="dt-body-center">'+val.label+'</td><td class="dt-body-center"><a href="#" onclick={{console.log("rrr")}} class="btn btn-danger"><i class="fas fa-trash"></i></a></td></tr>';
    })
    $('#tblAccess1').DataTable().destroy();
    $('#tblAccess1 > tbody').html(html);
    $('#tblAccess1').DataTable().MakeCellsEditable("destroy");
    initTableAccess1();
  }
  var reinitAccess2=(result)=>{
    var html="";
    result.map((val,index)=> { console.log(val)
      html+='<tr><td class="dt-body-center">'+val.idaccess2+'</td><td class="dt-body-center">'+val.role+'</td><td class="dt-body-center">'+$('#selectAccessMenu1 :selected').text()+'</td><td class="dt-body-center">'+val.label+'</td><td class="dt-body-center"><a href="#" onclick={{console.log("rrr")}} class="btn btn-danger"><i class="fas fa-trash"></i></a></td></tr>';
    })
    $('#tblAccess2').DataTable().destroy();
    $('#tblAccess2 > tbody').html(html);
    $('#tblAccess2').DataTable().MakeCellsEditable("destroy");
    initTableAccess2();
  }
  var access2Update= (updatedCell, updatedRow, oldValue) =>{console.log(updatedCell, updatedRow, oldValue);
    sendAjax("<?= base_url("/Master/updateAccess2"); ?>",{ idaccess2:parseInt(updatedRow.data()[0]),idrole:parseInt($('#selectAccess2 :selected').val()),idmenu2:parseInt(updatedRow.data()[3]),idmenu1:$('#selectAccessMenu1 :selected').val()},(result)=>{
      reinitAccess2(result);
    });
  }
  var roles=<?= json_encode($roles); ?>;
  var menu1=<?= json_encode($menu1); ?>;
  var menu2=<?= json_encode($menu2); ?>;
  roles=roles.map((val,i)=> {return {"value": parseInt(val.idrole), "display": val.role }}); roles.unshift({"value": 0, "display": "---Select---"});
  menu1=menu1.map((val,i)=> {return {"value": parseInt(val.id), "display": val.label }}); menu1.unshift({"value": 0, "display": "---Select---"});
  menu2=menu2.map((val,i)=> {return {"value": parseInt(val.id), "display": val.label }}); menu2.unshift({"value": 0, "display": "---Select---"});

  $('tbody > tr').hover((handlerIn, handlerOut) =>{ 
    var table=$(handlerIn.target).closest("table");
    $('.table').map((idx, elem) =>{
      $(elem).DataTable().MakeCellsEditable("destroy");
    })
    switch ($(table).attr('id')) {      
      case 'tblRole': {initTableRole();break;}
      case 'tblUser': {initTableUser();break;}
      case 'tblAccess1': {initTableAccess1();break;}
      case 'tblAccess2': {initTableAccess2();break;}
      case 'tblMenu1': {initTableMenu1();break;}
      case 'tblMenu2': {initTableMenu2();break;}
    }
  });
  initTableRole();initTableUser();initTableAccess1();initTableAccess2();initTableMenu1();initTableMenu2()
</script>
</body>
</html>
