<?php

class M_login extends CI_Model {
    function __construct() {
        parent::__construct();
        // $this->dbMIS=$this->load->database('dbMIS', TRUE);
        // $this->tblLoginLog='tblLoginLog';
        $this->user='user';
    }

    function verifikasi($userid, $pass) {
        $query = $this->db->query("SELECT iduser,name,username,r.idrole,r.role FROM user u inner join role r on r.idrole =u.idrole where u.Username='$userid' and u.Password='$pass'"); 
        return $query->row();
    }
    function getmenu1($idrole) {
        $query = $this->db->query("SELECT m.id,label,class,url FROM accessmenu1 a inner join menu1 m on m.id=a.idmenu1 where a.idrole=".$idrole); 
        return $query->result();
    }
    function getmenu2($idrole) {
        $query = $this->db->query("SELECT m.id,label,class,url,idmenu1 FROM accessmenu2 a inner join menu2 m on m.id=a.idmenu2 where a.idrole=".$idrole); 
        return $query->result();
    }
    function showUserbyRole($role) {
        $query = $this->db->query("SELECT * FROM user where Role='$role'"); 
        return $query->result();
    }
}
