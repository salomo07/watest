<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url() ?>" class="brand-link">
      <img src="<?= base_url() ?>assets/img/logoPSG.ico" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= web_name ?></span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php foreach ($menu1 as $val1): $submenu=false;$tag='';?>
            <?php foreach ($menu2 as $val2): ?>
              <?php if ($val2->idmenu1==$val1->id){$submenu=true;$tag.='<li style="padding-left:10px" class="nav-item"><a href="'.base_url().$val2->url.'" class="nav-link"><i class="'.$val2->class.' nav-icon"></i><p>'.$val2->label.'</p></a>';}?>
            <?php endforeach ?>
            <li class="nav-item">
              <a href="<?= ($submenu)? '#': base_url().$val1->url ?>" class="nav-link">
                <i class="nav-icon <?= $val1->class ?>"></i>
                <p><?= $val1->label ?><?= ($submenu)? '<i class="fas fa-angle-left right"></i>' : '' ?></p>
              </a>
              <?php if ($submenu): ?>
                <ul class="nav nav-treeview">
                  <?= $tag ?>
                </ul>
              <?php endif ?>
            </li>
          <?php endforeach ?>
          <li class="nav-item">
            <a href="<?= base_url() ?>Home/signout" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>Sign Out</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
</aside>