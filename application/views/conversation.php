<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<style>
  body{
    background-color: #f4f7f6;
    margin-top:20px;
}
.card {
    background: #fff;
    transition: .5s;
    border: 0;
    margin-bottom: 30px;
    border-radius: .55rem;
    position: relative;
    width: 100%;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
}
.chat-app .people-list {
    width: 280px;
    position: absolute;
    left: 0;
    top: 0;
    padding: 20px;
    z-index: 7
}

.chat-app .chat {
    margin-left: 280px;
    border-left: 1px solid #eaeaea
}

.people-list {
    -moz-transition: .5s;
    -o-transition: .5s;
    -webkit-transition: .5s;
    transition: .5s
}

.people-list .chat-list li {
    padding: 10px 15px;
    list-style: none;
    border-radius: 3px
}

.people-list .chat-list li:hover {
    background: #efefef;
    cursor: pointer
}

.people-list .chat-list li.active {
    background: #efefef
}

.people-list .chat-list li .name {
    font-size: 15px
}

.people-list .chat-list img {
    width: 45px;
    border-radius: 50%
}

.people-list img {
    float: left;
    border-radius: 50%
}

.people-list .about {
    float: left;
    padding-left: 8px
}

.people-list .status {
    color: #999;
    font-size: 13px
}

.chat .chat-header {
    padding: 15px 20px;
    border-bottom: 2px solid #f4f7f6
}

.chat .chat-header img {
    float: left;
    border-radius: 40px;
    width: 40px
}

.chat .chat-header .chat-about {
    float: left;
    padding-left: 10px
}

.chat .chat-history {
    padding: 20px;
    border-bottom: 2px solid #fff
}

.chat .chat-history ul {
    padding: 0
}

.chat .chat-history ul li {
    list-style: none;
    margin-bottom: 30px
}

.chat .chat-history ul li:last-child {
    margin-bottom: 0px
}

.chat .chat-history .message-data {
    margin-bottom: 15px
}

.chat .chat-history .message-data img {
    border-radius: 40px;
    width: 40px
}

.chat .chat-history .message-data-time {
    color: #434651;
    padding-left: 6px
}

.chat .chat-history .message {
    color: #444;
    padding: 18px 20px;
    line-height: 26px;
    font-size: 16px;
    border-radius: 7px;
    display: inline-block;
    position: relative
}

.chat .chat-history .message:after {
    bottom: 100%;
    left: 7%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #fff;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .my-message {
    background: #efefef
}

.chat .chat-history .my-message:after {
    bottom: 100%;
    left: 30px;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #efefef;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .other-message {
    background: #e8f1f3;
    text-align: right
}

.chat .chat-history .other-message:after {
    border-bottom-color: #e8f1f3;
    left: 93%
}

.chat .chat-message {
    padding: 20px
}

.online,
.offline,
.me {
    margin-right: 2px;
    font-size: 8px;
    vertical-align: middle
}

.online {
    color: #86c541
}

.offline {
    color: #e47297
}

.me {
    color: #1d8ecd
}

.float-right {
    float: right
}

.clearfix:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0
}

@media only screen and (max-width: 767px) {
    .chat-app .people-list {
        height: 465px;
        width: 100%;
        overflow-x: auto;
        background: #fff;
        left: -400px;
        display: none
    }
    .chat-app .people-list.open {
        left: 0
    }
    .chat-app .chat {
        margin: 0
    }
    .chat-app .chat .chat-header {
        border-radius: 0.55rem 0.55rem 0 0
    }
    .chat-app .chat-history {
        height: 300px;
        overflow-x: auto
    }
}

@media only screen and (min-width: 768px) and (max-width: 992px) {
    .chat-app .chat-list {
        height: 650px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: 600px;
        overflow-x: auto
    }
}

@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
    .chat-app .chat-list {
        height: 480px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: calc(100vh - 350px);
        overflow-x: auto
    }
}
</style>
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

