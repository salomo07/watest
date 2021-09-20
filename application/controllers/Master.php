<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master extends CI_Controller {

    function __construct() {
        parent::__construct();
        // unset($_SESSION['dataUser']);
        $this->load->model('m_master');
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
    }
    public function index() {
		$this->load->view('home/home');
    }
    public function updateUser() {
        $this->m_master->updateUser($_POST);
        echo json_encode(["status"=>"ok"]);
    }
    public function changePassword() {
        $_POST['password']=base64_encode($_POST['password']);
        $this->m_master->changePassword($_POST);
        echo json_encode(["status"=>"ok"]);
    }
    
    public function updateRole() {
        $this->m_master->updateRole($_POST);
        echo json_encode(["status"=>"ok"]);
    }
    public function updateAccess1() {
        $this->m_master->updateAccess1($_POST);
        $this->getAccess1();
    }
    public function updateAccess2() {
        $this->m_master->updateAccess2($_POST);
        $this->getAccess2();
    }
    public function updateMenu1() {
        $this->m_master->updateMenu1($_POST);
        echo json_encode(["status"=>"ok"]);
    }
    public function updateMenu2() {
        $this->m_master->updateMenu2($_POST);
        echo json_encode(["status"=>"ok"]);
    }
    public function getMenu2() {
        $menu2=$this->m_master->showMenu2ByIdmenu($_POST['id']);
        echo json_encode($menu2);
    }
    public function getAccess1() {
        $access1=$this->m_master->showAccess1($_POST['idrole']);
        echo json_encode($access1);
    }
    public function getAccess2() {
        $access2=$this->m_master->showAccess2($_POST['idmenu1'],$_POST['idrole']);
        echo json_encode($access2);
    }
    public function user() {
        $data['users']=$this->m_master->showUser();
        $data['roles']=$this->m_master->showRole();
        $data['menu1']=$this->m_master->showMenu1();
        $data['menu2']=$this->m_master->showMenu2();
        // print_r($data);
        $this->load->view('master/user',$data);
    }
    public function accessMutasi() {        
        $data['mutasicolumn']=$this->m_master->showUser(1);
        $data['roles']=$this->m_master->showRole();

        $this->load->view('master/accessmutasi',$data);
    }
}
