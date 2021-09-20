<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wa extends CI_Controller 
{

    function __construct() 
    {
        // parent::__construct($securePage=false);
        parent::__construct();
        header('Content-Type: application/json');
        $this->conf=json_decode(file_get_contents(base_url()."/waconf.json"));
        $this->BASE_URL=base64_decode($this->conf->BASE_URL);
        $this->ACCOUNT_KEY=base64_decode($this->conf->ACCOUNT_KEY);
        $this->API_KEY=base64_decode($this->conf->API_KEY);
        $this->ADIRA_NUMBER=base64_decode($this->conf->ADIRA_NUMBER);
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('M_wa');

    }

    function index(){
        echo 'This controller for WhatsApp usage';
    }
    public function formatingNumber($no){
        if(substr($no, 0, 2)=="62"){return $no;}
        else{return "62".substr($no, 1);}
    }
    public function sendingTextMsg($to,$text) {
        $ch = curl_init($this->BASE_URL.'whatsapp/1/message/text');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: App '.$this->API_KEY,
            'Content-Type: application/json'
        ));

        curl_setopt($ch, CURLOPT_POST ,TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS ,json_encode(["from"=>$this->ADIRA_NUMBER,"to"=>$this->formatingNumber($to),"content"=>["text"=>$text]]));
        try{
            $result=curl_exec($ch);
        }
        catch(Exception $e){
            // echo json_encode($e);
        }
    }
    public function tree($input,$no) {
        $input=strtolower(urldecode($input));
        $now=new DateTime('NOW');
        $arrGreet = array("hai", "halo","hallo","selamat pagi", "selamat siang","selamat sore","selamat malam","menu");
        $arrCall = array("call", "hubungi", "petugas", "hubungi petugas adira finance","chat","cs");
        $arrDoc = array("dok", "dokumen");

        if(in_array($input, $arrCall)) // Jika pesan berisi keyword seperti dalam array
        {
            $user=$this->M_wa->getLeads($no); // Check to database from leads
            if($user){  
                $msg=$this->M_wa->getMsg('call')->message;
                $msg=str_replace("... (Nama Konsumen)",$user->CRED_SID_NAME,$msg);
                // echo json_encode(["status"=>"sending","message"=>$msg]);
                $this->sendingTextMsg($no,$msg);
            }
            else{
                // echo json_encode(["status"=>"sending","message"=>$this->M_wa->getMsg('inputname')->message]);
                $this->sendingTextMsg($no,$this->M_wa->getMsg('inputname')->message);
            }
            if($this->M_wa->checkActiveConversation($no)==null)
            {
                $this->M_wa->insertConversation(["number"=>"0".substr($no, 2),"starttime"=>$now->format('c'),"keyword"=>"cs"]); // Save session of conversation
            }
            die();
        }
        else if(in_array($input, $arrGreet))
        {
            // echo json_encode(["status"=>"sending","message"=>$this->M_wa->getMsg('greet')->message]);
            $this->sendingTextMsg($no,$this->M_wa->getMsg('greet')->message);
        }
        else if(in_array($input, $arrDoc))
        {
            $user=$this->M_wa->getLeads($no); // Check to database from leads
            if($user){
                $msg=$this->M_wa->getMsg('dokumen')->message;
                $msg=str_replace("... (Nama Konsumen)",$user->CRED_SID_NAME,$msg); 
                // echo json_encode(["status"=>"sending","message"=>$msg]);
                $this->sendingTextMsg($no,$msg);
            }
            else{
                // echo json_encode(["status"=>"sending","message"=>$this->M_wa->getMsg('inputname')->message]);
                $this->sendingTextMsg($no,$this->M_wa->getMsg('inputname')->message);
            }
            if($this->M_wa->checkActiveConversation($val->from)==null)
            {$this->M_wa->insertConversation(["number"=>"0".substr($no, 2),"starttime"=>$now->format('c'),"keyword"=>"dokumen"]);}
        }
        else if($this->M_wa->getMsg($input)!=null)
        {
            $this->sendingTextMsg($no,$this->M_wa->getMsg($input)->message);
        }
        else {
            // Exception jika keyword tidak dikenali, akan memunculkan menu
            // echo json_encode(["status"=>"sending","message"=>$this->M_wa->getMsg('greet')->message]);
            $this->sendingTextMsg($no,$this->M_wa->getMsg('greet')->message);
        }
    }

    public function getMsg() {
        if(isset($_GET['keyword']) && isset($_GET['no'])){
            $keyword=strtolower(urldecode($_GET['keyword']));
            $this->tree($keyword,$_GET['no']);
        }
    }
    
    public function receivingInMsg() {
        if(json_decode(file_get_contents('php://input'))==null){die();}
        $data=json_decode(file_get_contents('php://input'))->results;
        foreach ($data as $val) {
            $msg= $val->message;
            $allowedType = array("TEXT","IMAGE","DOCUMENT");
            if(!in_array($msg->type, $allowedType))
            {
                $this->sendingTextMsg($val->from,"Sahabat Adira, \nMohon maaf, format pesan yang diperbolehkan hanya berupa Text, Image dan Document.");
            }
            else{
                if($msg->type=="TEXT")
                {
                    if($this->M_wa->checkActiveConversation($val->from)!=null) //Jika percakapan sudah aktif
                    {
                        $this->sendingTextMsg($val->from,"Percakapan telah dimulai, setelah tahap ini saya serahkan ke Intelix.");
                    }
                    else // Belum ada percakapan, masuk ke bot
                    {
                        $this->tree($msg->text,$val->from);
                    }
                }else if($msg->type=="IMAGE"){

                }
            }
        }
    }

    public function endConversation() {
        if(!isset($_GET['nikadm']) || !isset($_GET['no']) || isset($_GET['idadmin'])){echo json_encode(["status"=>"Bad request"])}
        else
        {
            $now=new DateTime('NOW');
        }
    }    
}