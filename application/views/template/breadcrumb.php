<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if ($this->uri->segment(1)!='Home'): ?>
  
<?php endif ?>
<div class="col-sm-6">
  <?php if ($this->uri->segment(1)!='Home'): ?>
  <h1><?= $this->uri->segment(1); ?></h1>
  <?php endif ?>
</div>

<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <?php if ($this->uri->segment(1)!='Home'): ?>
    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
    <?php if ($this->uri->segment(2)!=null){ ?>
    <li class="breadcrumb-item"><a href="<?= base_url($this->uri->segment(1)) ?>"><?= $this->uri->segment(1); ?></a></li>
    <li class="breadcrumb-item active"><?= $this->uri->segment(2) ?></li>
    <?php }else{ ?>
    <li class="breadcrumb-item active"><?= $this->uri->segment(1) ?></li>
    <?php } ?>
    <?php endif ?>
  </ol>
</div>