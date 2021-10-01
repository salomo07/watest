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
                  <li class="clearfix">
                     <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                     <div class="about">
                        <div class="name">Vincent Porter</div>
                        <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago</div>
                     </div>
                  </li>
                  <li class="clearfix active">
                     <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                     <div class="about">
                        <div class="name">Aiden Chavez</div>
                        <div class="status"> <i class="fa fa-circle online"></i> online</div>
                     </div>
                  </li>
                  <li class="clearfix">
                     <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                     <div class="about">
                        <div class="name">Mike Thomas</div>
                        <div class="status"> <i class="fa fa-circle online"></i> online</div>
                     </div>
                  </li>
                  <li class="clearfix">
                     <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                     <div class="about">
                        <div class="name">Christian Kelly</div>
                        <div class="status"> <i class="fa fa-circle offline"></i> left 10 hours ago</div>
                     </div>
                  </li>
                  <li class="clearfix">
                     <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="avatar">
                     <div class="about">
                        <div class="name">Monica Ward</div>
                        <div class="status"> <i class="fa fa-circle online"></i> online</div>
                     </div>
                  </li>
                  <li class="clearfix">
                     <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                     <div class="about">
                        <div class="name">Dean Henry</div>
                        <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28</div>
                     </div>
                  </li>
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
               <div class="chat-history">
                  <ul class="m-b-0">
                     <li class="clearfix">
                        <div class="message-data text-right"> <span class="message-data-time">10:10 AM, Today</span> <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"></div>
                        <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along?</div>
                     </li>
                     <li class="clearfix">
                        <div class="message-data"> <span class="message-data-time">10:12 AM, Today</span></div>
                        <div class="message my-message">Are we meeting today?</div>
                     </li>
                     <li class="clearfix">
                        <div class="message-data"> <span class="message-data-time">10:15 AM, Today</span></div>
                        <div class="message my-message">Project has been already finished and I have results to show you.</div>
                     </li>
                  </ul>
               </div>
               <div class="chat-message clearfix">
                  <div class="input-group mb-0">
                     <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-send"></i></span></div>
                     <input type="text" class="form-control" placeholder="Enter text here...">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript"></script> </div>
</div>
</body>
</html>

