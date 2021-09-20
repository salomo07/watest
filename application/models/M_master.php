<?php

class M_master extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function showUser(){
        $query = $this->db->query("SELECT * FROM user u inner join role r on u.idrole=r.idrole"); 
        return $query->result();
    }
    function showRole(){
        $query = $this->db->query("SELECT * FROM role"); 
        return $query->result();
    }
    function showMenu1(){
        $query = $this->db->query("SELECT * FROM menu1"); 
        return $query->result();
    }
    function showMenu2(){
        $query = $this->db->query("SELECT * FROM menu2"); 
        return $query->result();
    }
    function showMenu2ByIdmenu($id){
        $query = $this->db->query("SELECT * FROM menu2 where idmenu1=$id"); 
        return $query->result();
    }
    function showAccess1($idrole){
        $query = $this->db->query("SELECT * FROM accessmenu1 a inner join menu1 m on a.idmenu1=m.id inner join role r on r.idrole=a.idrole where a.idrole=$idrole"); 
        return $query->result();
    }
    function showAccessMutasi($idrole){
        $query = $this->db->query("SELECT * FROM `accessmutasi` where a.idrole=$idrole"); 
        return $query->result();
    }
    function showAccess2($idmenu1,$idrole){
        $query = $this->db->query("SELECT * FROM accessmenu2 a inner join menu2 m on a.idmenu2=m.id inner join role r on r.idrole=a.idrole where idmenu1=$idmenu1 and a.idrole=$idrole"); 
        return $query->result();
    }
    function changePassword($data){
        $this->db->where('iduser', $data['iduser']);
        $this->db->update('user', $data);
    }
    function updateUser($data){
        if($data['idrole']==0)
        {unset($data['idrole']);}
    	if($data['iduser']==0)
        {$data['password']=base64_encode("1234");$this->db->insert('user', $data);}
        $this->db->where('iduser', $data['iduser']);
        $this->db->update('user', $data);
    }
    function updateRole($data){
    	if($data['role']==""){}
    	else{
    		if($data['idrole']==0)
	    	{$this->db->insert('role', $data);}
	        $this->db->where('idrole', $data['idrole']);
	        $this->db->update('role', $data);
    	}
    }
    function updateMenu1($data){
    	if($data['label']==""){}
    	else{
    		if($data['id']==0)
	    	{$this->db->insert('menu1', $data);}
	        $this->db->where('id', $data['id']);
	        $this->db->update('menu1', $data);
    	}
    }
    function updateMenu2($data){
        if($data['label']==""){}
        else{
            if($data['id']==0)
            {$this->db->insert('menu2', $data);}
            $this->db->where('id', $data['id']);
            $this->db->update('menu2', $data);
        }
    }
    function updateAccess1($data){
    	if($data['idaccess1']==0)
    	{$this->db->insert('accessmenu1', $data);}
        $this->db->where('idaccess1', $data['idaccess1']);
        $this->db->update('accessmenu1', $data);
    }
    function updateAccess2($data){
        unset($data['idmenu1']);
        if($data['idaccess2']==0)
        {$this->db->insert('accessmenu2', $data);}
        $this->db->where('idaccess2', $data['idaccess2']);
        $this->db->update('accessmenu2', $data);
    }
}
