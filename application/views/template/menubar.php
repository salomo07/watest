<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="main-header navbar navbar-expand navbar-primary navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <?php foreach ($menu1 as $val): $submenu=false;$tag='<div class="dropdown-menu dropdown-menu-lg">';?>
      <?php foreach ($menu2 as $val2): ?>
        <div class="dropdown-divider"></div>
        <?php if ($val->id==$val2->idmenu1):$submenu=true;$tag.='<a href="'.base_url().$val2->url.'" class="dropdown-item">
          <i style="width:20px" class="'.$val2->class.' mr-2"></i> '.$val2->label.'
        </a>'?>
        <?php endif ?>
        <div class="dropdown-divider"></div>
      <?php endforeach?>
      <?= $tag.='</div>' ?>
      <li class="nav-item <?= ($submenu==true)? "dropdown":"" ?>">
        <a href="<?= ($submenu==true)? "#": base_url().$val->url ?>" <?= ($submenu==true)? 'role="button" data-toggle="dropdown"' : '' ?>  class="nav-link <?= ($submenu==true)? 'dropdown-toggle':"" ?>"><i class="nav-icon <?= $val->class?>"></i> <?= $val->label ?></a>
        <?= $tag ?>
      </li>
    <?php endforeach ?>
  </ul>

  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>


    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>