<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mutasi extends CI_Controller {
    function __construct() {
        parent::__construct();
        // unset($_SESSION['dataUser']);
        // $this->load->model('m_storage');
        $this->load->model('M_mutasi');
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
        $access=false;

        foreach ($this->session->userdata('dataMenu')['menu1'] as $val) {
            if($val->label==$this->uri->segment(1)){$access=true;}
        }
        if(!$access){redirect('/Home/notfound?reason=noaccess');}
    }
    public function index() {
        $data['norek']=['1389','2199','5456','5464','5481','5677','5693','8625','8633','8641'];
		$this->load->view('mutasi/mutasi',$data);
    }
    public function showMutasi() {
        // print_r($_GET['search']['value']);
        $mutasi=$this->M_mutasi->showMutasi($_GET['start'],$_GET['length'],$_GET['search']['value']);
        $jumlah=$this->M_mutasi->countMutasi();
        $data=[];
        foreach ($mutasi as $val) {
            array_push($data, array_values((array)$val));
        }
        $json=["recordsTotal"=>$jumlah->jumlah,"recordsFiltered"=> $jumlah->jumlah,"data"=>$data];
        echo json_encode($json);
    }
    public function uploading() {
        // if($_POST['selectNorek']==0){echo 'Please select No Rek...';die();}
        // else{            
            $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            if(isset($_FILES['inputFile']['name']) && in_array($_FILES['inputFile']['type'], $file_mimes)) 
            {
                $arr_file = explode('.', $_FILES['inputFile']['name']);
                $extension = end($arr_file);
             
                if('csv' == $extension) {$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();} 
                else {$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();}
             
                $spreadsheet = $reader->load($_FILES['inputFile']['tmp_name']);
                 
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                $noexist=$this->M_mutasi->getNoExist();
                $alldata=[];
                for($i = 1;$i < count($sheetData);$i++)
                {
                    $exist=false;
                    foreach ($noexist as $val) {
                        if((int)$val->no==(int)$sheetData[$i][0]){$exist=true;}
                    }
                    if(!$exist)
                    {
                        $data=['no'=>(int)$sheetData[$i][0],'tglmutasi'=>$sheetData[$i][1],'keterangan'=>$sheetData[$i][2],'kodebank'=>$sheetData[$i][3],'nominal'=>floatval($sheetData[$i][4]),'tipe'=>$sheetData[$i][5],'saldo'=>floatval ($sheetData[$i][6]),'norek'=>$sheetData[$i][7],'tgwa'=>$sheetData[$i][8],'area'=>$sheetData[$i][9],'customer'=>$sheetData[$i][10],'bulan'=>$sheetData[$i][11],'nosi'=>$sheetData[$i][12],'nopayment'=>$sheetData[$i][13],'nobuku'=>$sheetData[$i][14],'norp'=>$sheetData[$i][15],'nocf'=>$sheetData[$i][16],'check1'=>(isset($sheetData[$i][17]))?boolval($sheetData[$i][17]):false,'check2'=>(isset($sheetData[$i][18]))?boolval($sheetData[$i][18]):false,'check3'=>(isset($sheetData[$i][19]))?boolval($sheetData[$i][19]):false,'check4'=>(isset($sheetData[$i][20]))?boolval($sheetData[$i][20]):false,'keterangancs'=>$sheetData[$i][21],'createdtime'=>date('Y-m-d H:i:s'),'createdby'=>$this->session->userdata('dataUser')->iduser];
                        $this->M_mutasi->insertMutasi($data);
                    }
                }
                redirect('Mutasi');
                // header("Location: form_upload.html"); 
            }
            else{echo 'Select file...';die();}
        // }
    }
    public function signout()
    {
        unset($_SESSION['dataUser']);
        redirect('Login');             
    }
}
