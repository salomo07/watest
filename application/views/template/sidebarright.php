<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<aside class="control-sidebar control-sidebar-dark">
  <div class="p-3 control-sidebar-content" style="">
    <a href="<?= base_url('/Login/userDetail?id=').$this->session->userdata('dataUser')->iduser ?>"><h5><center><?= $this->session->userdata('dataUser')->name ?></center></h5></a>
    <hr class="mb-2">
  </div>
</aside>