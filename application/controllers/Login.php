<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller 
{
    function __construct() {
        parent::__construct();
        // print_r($this->session->userdata('dataUser'));
        // unset($_SESSION['dataUser']);
        // echo base64_decode("QXNveQ==");

        if ($this->session->userdata('dataUser')) {
            redirect('Home');
        }
        date_default_timezone_set("Asia/Jakarta");
        // $this->load->model('m_login');
    }
    public function index() {
        $productData=[["productId"=>1000,"productName"=>'Product 1000'],["productId"=>1001,"productName"=>'Product 1001']];
        $stockData=[["productId"=>1000,"locationId"=>1,"stock"=>21],["productId"=>1000,"locationId"=>2,"stock"=>8],["productId"=>1001,"locationId"=>1,"stock"=>4],["productId"=>1001,"locationId"=>2,"stock"=>10]];
        $locationData=[["locationId"=>1,"locationName"=>'Location 1'],["locationId"=>2,"locationName"=>'Location 2']];

        $resultData=[];
        foreach ($productData as $vProduct) {
            $stock=[];$totStock=0;$detail=[];
            foreach ($stockData as $vStok) {
                if($vProduct['productId']==$vStok['productId'])
                {
                    $totStock=$totStock+$vStok['stock'];$loc="";
                    foreach ($locationData as $vLoc) {
                        if($vLoc['locationId']==$vStok['locationId'])
                        $loc= $vLoc['locationName'];
                        break;
                    }
                    array_push($detail, ["locationName"=>$loc,"stock"=>$vStok['stock']]);
                }
            }
            $stock=["total"=>$totStock,"detail"=>$detail];
            array_push($resultData, ["productName"=>$vProduct['productName'],"stock"=>$stock]);
        }
        // echo "<pre>";print_r($resultData);"</pre>";
		$this->load->view('login/index');
    }
    public function checkAccess1()
    {
        
    }
    public function sign_in()
    {
        $data=$this->m_login->verifikasi($_POST['username'],base64_encode($_POST['password']));
        if(isset($data))
        {
            $this->session->set_userdata('dataUser', $data);
            //echo base64_encode($password)."\n".'||';echo base64_decode('cmVqb2ljZQ==');
            $menu['menu1']=$this->m_login->getmenu1($data->idrole);
            $menu['menu2']=$this->m_login->getmenu2($data->idrole);

            // $menubar=$this->load->view('template/menubar',$data,true);
            $this->session->set_userdata('dataMenu', $menu);

            $sidebar=$this->load->view('template/sidebar',$menu,true);
            $menubar=$this->load->view('template/menubar',$menu,true);    
            $this->session->set_userdata('dataSidebar', $sidebar);
            $this->session->set_userdata('dataMenubar', $menubar);
            redirect('Home');
        }
        else{redirect('Login');}
    }
    
}
