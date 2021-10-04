<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<html>
<head>
  <title><?= isset($_GET['nik'])?$_GET['nik']:""?></title>
  <link href="<?= base_url() ?>assets/css/chatbox.css" type="text/css" rel="stylesheet">
</head>
<body style="background-image: url('https://www.adira.co.id/wp-content/themes/adirafinance2018/karir/img/banner_intern_rev.jpg');">
  <div id="snippetContent">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script> 
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
   <div class="row clearfix" style="margin-top: 50px">
      <div class="col-lg-12">
         <div class="card chat-app">
            <div id="plist" class="people-list">
               <div class="input-group">
                  <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-search"></i></span></div>
                  <input type="text" class="form-control" placeholder="Search...">
               </div>
               <ul class="list-unstyled chat-list mt-2 mb-0">
                  <?php foreach ($listcustomer as $val): ?>
                    <li class="clearfix" onclick="getChat(<?= $val->number ?>,this)">
                       <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                       <div class="about">
                          <div class="name"><?= $val->username ?></div>
                          <div class="status"> <i class="fa fa-circle online"></i> online</div>
                       </div>
                    </li>
                  <?php endforeach ?>
               </ul>
            </div>
            <div class="chat">
               <div class="chat-header clearfix">
                  <div class="row">
                     <div class="col-lg-6">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info"> <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar"> </a>
                        <div class="chat-about">
                           <h6 class="m-b-0"><?= isset($_GET['nik'])?$_GET['nik']:""?></h6>
                           <small>Last seen: 2 hours ago</small>
                        </div>
                     </div>
                     <div class="col-lg-6 hidden-sm text-right"> <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a> <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a> <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a></div>
                  </div>
               </div>
               <div class="chat-history" style="max-height: 450px;height: 400px; overflow-y: scroll;">
                  <ul class="m-b-0">
                  </ul>
               </div>
               <div class="chat-message clearfix">
                  <div class="input-group mb-0">
                     <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-send"></i></span></div>
                     <input id="inputText" type="text" class="form-control" placeholder="Enter text here...">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="chatCustomer" style="display: none">
  <li class="clearfix">
    <div class="message-data text-right"> <span class="message-data-time" id="chatTime"></span> <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar"></div>
    <div class="message other-message float-right" id="message"> Hi Aiden, how are you? How is the project coming along?</div>
  </li>
</div>
<div id="chatAdmin" style="display: none">
  <li class="clearfix">
    <div class="message-data"> <span class="message-data-time" id="chatTime">10:12 AM, Today</span></div>
    <div class="message my-message" id="message">Are we meeting today?</div>
  </li>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</div>
</div>
</body>
</html>

<script>
  var noSelected;
  function getChat(no,ele){noSelected=no;
    $(ele).attr('class', 'clearfix active');
    $('.chat-history>ul').html("<center><h2>Please wait...</h2></center>");
    $.ajax({url: "<?= base_url() ?>wa/getMessages?no="+no,dataType:'json', success: function(res){
      var chat=[];
      res.forEach( function(val, index) {
        if(val.sender==no)
        {
          $("#chatCustomer").find("#chatTime").text(val.receivedAt);
          $("#chatCustomer").find("#message").text(val.text);
          chat.push($("#chatCustomer").html());
        }
        else{
          $("#chatAdmin").find("#chatTime").text("Admin (<?= $_GET['nik'] ?>)  "+val.receivedAt);
          $("#chatAdmin").find("#message").text(val.text);
          chat.push($("#chatAdmin").html());
        }
      });
      $('.chat-history>ul').html(chat);
    }});
  }
  $("#inputText").on('keypress',function(e) {
      var chatAdm=[];
      if(e.which == 13) {
        var time=new Date();
        $("#chatAdmin").find("#chatTime").text("Admin (<?= $_GET['nik'] ?>)  "+time.getDate()+"/"+time.getMonth()+"/"+time.getFullYear()+" "+time.getHours()+":"+time.getMinutes());
        $("#chatAdmin").find("#message").text($("#inputText").val());
        
        chatAdm.push($("#chatAdmin").html());
        $('.chat-history>ul').append(chatAdm);
        var text=$("#inputText").val();
        $.ajax({url: "<?= base_url() ?>wa/saveMessages?no="+noSelected+"&text="+text+"&nik=<?= $_GET['nik'] ?>",dataType:'json', success: function(res){
          console.log(res);
        }});
        $("#inputText").val("");
      }
  });
</script>

