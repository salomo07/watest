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
        echo substr("Namanya juga usaha",0,150).' ';
        echo 'This controller for WhatsApp usage';
        
    }
    function conversation(){
        header('Content-Type: html');
        $data['listcustomer']=$this->M_wa->getCustomerOnline();
        if(isset($_GET['nik'])){
            $this->load->view('conversation',$data);   
        }
        // echo 'This controller for WhatsApp usage';
        
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
        $arrGreet = array("hai", "halo","hallo","selamat pagi", "selamat siang","selamat sore","selamat malam","menu","hi");
        $arrCall = array("call", "hubungi", "petugas", "hubungi petugas adira finance","chat","cs","tanya");
        $arrDoc = array("dok", "dokumen");
        if(in_array($input, $arrCall)) // Jika pesan berisi keyword seperti dalam array
        {
            if($this->M_wa->checkActiveConversation($no)==null)
            {$this->M_wa->insertConversation(["number"=>$no,"starttime"=>$now->format('c'),"keyword"=>"cs"]);}

            $user=$this->M_wa->getLeads($no); // Check to database from leads
            if($user){  
                $msg=$this->M_wa->getKeyword('call')->message;
                $msg=str_replace("... (Nama Konsumen)",$user->CRED_SID_NAME,$msg);
                $this->M_wa->updateConversation(["username"=>$user->CRED_SID_NAME,"number"=>$this->formatingNumber($no)]);
                $this->sendingTextMsg($no,$msg);
            }
            else{
                $this->sendingTextMsg($no,$this->M_wa->getKeyword('inputname')->message);
            }
            
            die();
        }
        else if(in_array($input, $arrGreet))
        {
            // echo json_encode(["status"=>"sending","message"=>$this->M_wa->getKeyword('greet')->message]);
            $arrButton=[["type"=>"REPLY","title"=>"Dokumen","id"=>1],["type"=>"REPLY","title"=>"Tanya","id"=>2]];
            $this->sendInteractiveBtn($no,$this->M_wa->getKeyword('greet')->message,$arrButton);
        }
        else if(in_array($input, $arrDoc))
        {
            if($this->M_wa->checkActiveConversation($no)==null)
            {$this->M_wa->insertConversation(["number"=>$no,"starttime"=>$now->format('c'),"keyword"=>"dokumen"]);}

            $user=$this->M_wa->getLeads($no); // Check to database from leads
            if($user){
                $msg=$this->M_wa->getKeyword('dokumen')->message;
                $msg=str_replace("... (Nama Konsumen)",$user->CRED_SID_NAME,$msg); 
                // echo json_encode(["status"=>"sending","message"=>$msg]);
                $this->sendingTextMsg($no,$msg);
                $this->M_wa->updateConversation(["username"=>$user->CRED_SID_NAME,"number"=>$this->formatingNumber($no)]);
            }
            else{
                // echo json_encode(["status"=>"sending","message"=>$this->M_wa->getKeyword('inputname')->message]);
                $this->sendingTextMsg($no,$this->M_wa->getKeyword('inputname')->message);
            }
        }
        else if($this->M_wa->getKeyword($input)!=null)
        {
            $this->sendingTextMsg($no,$this->M_wa->getKeyword($input)->message);
        }
        else {
            // Exception jika keyword tidak dikenali, akan memunculkan menu

            $arrButton=[["type"=>"REPLY","title"=>"Dokumen","id"=>1],["type"=>"REPLY","title"=>"Tanya","id"=>2]];
            $this->sendInteractiveBtn($no,$this->M_wa->getKeyword('greet')->message,$arrButton);
        }
    }
    public function adminSend() {
        if(!isset($_GET['no']) || !isset($_GET['text'])){echo json_encode(["status"=>"Bad request"]);die();}
        $to=$_GET['no'];
        $text=$_GET['text'];
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
    // public function getKeyword() {
    //     if(isset($_GET['keyword']) && isset($_GET['no'])){
    //         $keyword=strtolower(urldecode($_GET['keyword']));
    //         $this->tree($keyword,$_GET['no']);
    //     }
    // }
    public function getMessages() {
        if(isset($_GET['no'])){
            echo json_encode($this->M_wa->getMessages($_GET['no']));
        }
    }
    public function sendInteractiveBtn($to,$text,$arrButton) {
        $ch = curl_init($this->BASE_URL.'whatsapp/1/message/interactive/buttons');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: App '.$this->API_KEY,
            'Content-Type: application/json'
        ));
        $fields=json_encode(["from"=>$this->ADIRA_NUMBER,"to"=>$this->formatingNumber($to),"content"=>["body"=>["text"=>$text],"action"=>["buttons"=>$arrButton]]]);
        curl_setopt($ch, CURLOPT_POST ,TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS ,$fields);
        try{
            $result=curl_exec($ch);
        }
        catch(Exception $e){
            // echo json_encode($e);
        }
    }
    public function receivingInMsg() {
        if(json_decode(file_get_contents('php://input'))==null){die();}
        else{
            $now=new DateTime('NOW');
            $now=$now->format('c');
            $data=json_decode(file_get_contents('php://input'))->results;
            foreach ($data as $val) {
                $msg= $val->message;
                $allowedType = array("TEXT","IMAGE","DOCUMENT","INTERACTIVE_BUTTON_REPLY");
                
                if(!in_array($msg->type, $allowedType))
                {
                    $this->sendingTextMsg($val->from,"Sahabat Adira, \nMohon maaf, format pesan yang diperbolehkan hanya berupa Text, Image dan Document.");
                }
                else{
                    $username="";
                    $session=$this->M_wa->checkActiveConversation($val->from);
                    if($msg->type=="INTERACTIVE_BUTTON_REPLY"){
                        $this->tree($msg->title,$val->from);
                    }
                    else if($msg->type=="TEXT")
                    {                        
                        if($msg->text=="#out")
                        {
                            $this->sendingTextMsg($this->formatingNumber($val->from),"End by client");
                            $this->M_wa->updateConversation(["number"=>$val->from,"nik"=>"Ended by user","endtime"=>$now]);
                        }
                        else if($session!=null) //Jika percakapan sudah dimulai
                        {
                            
                            if($session->username || $session->username=="")
                            {
                                $this->M_wa->updateConversation(["number"=>$val->from,"username"=>substr($msg->text,0,50)]);
                                $username=substr($msg->text,0,50);
                            }
                            $username=$session!=null?$session->username:$val->contact->name;
                            $arrMsg=["sender"=>$val->from,"receiver"=>$this->ADIRA_NUMBER,"receivedAt"=>$now,"name"=>$username,"type"=>"TEXT","text"=>$msg->text];
                            $this->M_wa->insertMessage($arrMsg);
                            $this->sendingTextMsg($val->from,"TEXT tersimpan ".json_encode($arrMsg));
                        }
                        else // Belum ada percakapan, masuk ke bot
                        {
                            $this->tree($msg->text,$val->from);
                        }
                    }else if($msg->type=="IMAGE"){
                        $username=$session!=null?$session->username:$val->contact->name;
                        $arrMsg=["sender"=>$val->from,"receiver"=>$this->ADIRA_NUMBER,"receivedAt"=>$now,"name"=>$username,"type"=>"IMAGE","text"=>$msg->caption,"url"=>$msg->url];
                            $this->M_wa->insertMessage($arrMsg);
                            $this->sendingTextMsg($val->from,"IMAGE tersimpan ".json_encode($arrMsg));

                    }
                    else if($msg->type=="DOCUMENT"){
                        $username=$session!=null?$session->username:$val->contact->name;
                        $arrMsg=["sender"=>$val->from,"receiver"=>$this->ADIRA_NUMBER,"receivedAt"=>$now,"name"=>$username,"type"=>"IMAGE","text"=>$msg->caption,"url"=>$msg->url];
                            $this->M_wa->insertMessage($arrMsg);
                            $this->sendingTextMsg($val->from,"DOCUMENT tersimpan ".json_encode($arrMsg));
                    }
                }
            }
        }
    }

    public function endConversation() {
        if(!isset($_GET['no'])&&!isset($_GET['nik'])){die();}
        $now=new DateTime('NOW');
        $this->M_wa->updateConversation(["number"=>$_GET['no'],"nik"=>$_GET['nik'],"endtime"=>$now->format('c')]);
        $this->sendingTextMsg($this->formatingNumber($_GET['no']),$this->M_wa->getKeyword('end')->message);
    }    
}