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
        // echo substr("Namanya juga usaha",0,150).' ';
        echo 'This controller for WhatsApp usage';
        
    }
    function conversation(){
        header('Content-Type: html');
        $data['listcustomer']=$this->M_wa->getCustomerOnline();
        if(isset($_GET['nik'])){
            $this->load->view('conversation',$data);   
        }        
    }
    public function formatingNumber($no){
        if(substr($no, 0, 2)=="62"){return $no;}
        else{return "62".substr($no, 1);}
    }
    public function kirim() {
        $this->sendingTextMsg2($_GET['to'],$_GET['text']);
    }
    public function sendingTextMsg($to,$text) {
        // $ch = curl_init($this->BASE_URL.'whatsapp/1/message/text');
        $ch = curl_init('http://10.91.3.135:8000/api/i5/infobip/v1/sendwatext');

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
    public function sendingTextMsg2($to,$text) {
            $curl = curl_init();
            // echo bin2hex(openssl_random_pseudo_bytes(10));
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://10.91.3.135:8000/api/i5/infobip/v1/sendwatext',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "header": {
                    "requestId": "CC-20201215000000707900011",
                    "requestTimestamp": "'.date("Y-m-d H:i:s").'",
                    "costGrp": "CONTACTCENTER",
                    "appNo": "12345667890",
                    "channelId": "CONTACTCENTER"
                },
                "data": {
                    "from": "6281119308391",
                    "to": "'.$to.'",
                    "content": {
                        "text": "'.$text.'"
                    }
                }
            }',
              CURLOPT_HTTPHEADER => array(
                'AF-API-KEY: 4e8DKClsh4v0Q5jemKIP2eY8VI6Q2cf9',
                'Authorization: App 462b80fba7b8deef462d418ef369b16d-0c0b7b03-64a7-4b00-8688-49e0ae918928',
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
    }

    public function tree($input,$no) {
        $input=strtolower(urldecode($input));
        $now=new DateTime('NOW');
        $arrCall = array("call", "hubungi", "petugas", "hubungi petugas adira finance","chat","cs","tanya","tanya cs");
        $arrGreet = array("hai", "halo","hallo","selamat pagi", "selamat siang","selamat sore","selamat malam","menu","hi");
        $arrCall = array("call", "hubungi", "petugas", "hubungi petugas adira finance","chat","cs","tanya","tanya cs","info jadwal");
        $arrDoc = array("dok", "dokumen");
        $arrButton=[["type"=>"REPLY","title"=>"Dokumen","id"=>1],["type"=>"REPLY","title"=>"Tanya","id"=>2],["type"=>"REPLY","title"=>"Info Jadwal","id"=>3]];
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
            $this->sendInteractiveBtn($no,$this->M_wa->getKeyword('greet')->message,$arrButton);
        }
    }
    public function saveMessages() {
        if(!isset($_GET['no']) || !isset($_GET['text']) || !isset($_GET['nik'])){echo json_encode(["status"=>"Bad request"]);die();}
        $to=$_GET['no'];
        $text=$_GET['text'];
        $nik=$_GET['nik'];
        $now=new DateTime('NOW');
        $now=$now->format('c');
        $ch = curl_init($this->BASE_URL.'whatsapp/1/message/text');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: App '.$this->API_KEY,
            'Content-Type: application/json'
        ));

        curl_setopt($ch, CURLOPT_POST ,TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS ,json_encode(["from"=>$this->ADIRA_NUMBER,"to"=>$this->formatingNumber($to),"content"=>["text"=>$text]]));
        $arrMsg=["sender"=>$this->ADIRA_NUMBER,"receiver"=>$this->formatingNumber($to),"receivedAt"=>$now,"type"=>"TEXT","text"=>$text];
        $this->M_wa->insertMessage($arrMsg);
        try{
            $result=curl_exec($ch);
        }
        catch(Exception $e){
            // echo json_encode($e);
        }
    }
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
                $allowedType = array("TEXT","IMAGE","DOCUMENT","INTERACTIVE_BUTTON_REPLY","QUICK_REPLY");
                
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
                    if($msg->type=="QUICK_REPLY"){
                        $this->sendingTextMsg($this->formatingNumber($val->from),"Anda memilih menu : ".$val->message);
                    }
                    else if($msg->type=="TEXT")
                    {                        
                        if($msg->text=="#out")
                        {
                            $this->sendingTextMsg($this->formatingNumber($val->from),$this->M_wa->getKeyword('end')->message);
                            $this->M_wa->updateConversation(["number"=>$val->from,"nik"=>"Ended by user","endtime"=>$now]);
                        }
                        else if($session!=null) //Jika percakapan sudah dimulai
                        {                           
                            if($session->username=="")
                            {
                                $this->M_wa->updateConversation(["number"=>$val->from,"username"=>substr($msg->text,0,50)]);
                                $username=substr($msg->text,0,50);
                            }
                            $username=$session!=null?$session->username:$val->contact->name;
                            $arrMsg=["sender"=>$val->from,"receiver"=>$this->ADIRA_NUMBER,"receivedAt"=>$now,"type"=>"TEXT","text"=>$msg->text];
                            $this->M_wa->insertMessage($arrMsg);
                        }
                        else // Belum ada percakapan, masuk ke bot
                        {
                            $this->tree($msg->text,$val->from);
                        }
                    }else if($msg->type=="IMAGE"){
                        $username=$session!=null?$session->username:$val->contact->name;
                        $arrMsg=["sender"=>$val->from,"receiver"=>$this->ADIRA_NUMBER,"receivedAt"=>$now,"type"=>"IMAGE","text"=>$msg->caption,"url"=>$msg->url];
                        $this->M_wa->insertMessage($arrMsg);

                    }
                    else if($msg->type=="DOCUMENT"){
                        $username=$session!=null?$session->username:$val->contact->name;
                        $arrMsg=["sender"=>$val->from,"receiver"=>$this->ADIRA_NUMBER,"receivedAt"=>$now,"type"=>"IMAGE","text"=>$msg->caption,"url"=>$msg->url];
                            $this->M_wa->insertMessage($arrMsg);
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
    public function sendBlastKonfirmasiJadwal(){
        if(!isset($_GET['campaign'])){die();}
        $res=$this->M_wa->getAllBlast($_GET['campaign']);
        foreach ($res as $value) {
            if($value->destination_number!=null && $value->customer_name!=null)
            {
            // $this->sendTemplate($this->formatingNumber($value->destination_number),'telecenter_1',[$value->customer_name,$_GET['campaign']],"Konfirmasi Jadwal");
            // $this->M_wa->insertWASended(["campaign"=>$_GET['campaign'],"no"=>$value->destination_number,"status"=>"sending","time"=>date()]);
            }
        }
        $this->sendTemplate($this->formatingNumber('081288643757'),'telecenter_1',["Sule Prikitiwwww",$_GET['campaign']],"Konfirmasi Jadwal");
        $this->M_wa->insertWASended(["campaign"=>$_GET['campaign'],"no"=>'081288643757',"status"=>"sending","time"=>date("Y-m-d H:i:s")]);
    }
    
    public function sendTemplate($to,$templateName,$placeHolder,$parameterButton){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://10.91.3.135:8000/api/i5/infobip/v1/sendTemplateWa',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "header": {
                "requestId": "CC-20201215000000707900011",
                "requestTimestamp": "2021-10-05 17:09:14",
                "costGrp": "CONTACTCENTER",
                "appNo": "12345667890",
                "channelId": "CONTACTCENTER"
            },
            "data": {
                "messages": [
                    {
                        "from": "6281119308391",
                        "to":'.$to.',
                        "content": {
                            "templateName": "'.$templateName.'",
                            "templateData": {
                                "body": {
                                    "placeholders": '.json_encode($placeHolder).'
                                },
                                "buttons": [
                                {
                                "type": "QUICK_REPLY",
                                "parameter": "'.$parameterButton.'"
                                }
                                ]
                            },

                            "language": "id"
                        },
                        "callbackData": "Callback data"
                    }
                ]
            }
        }',
          CURLOPT_HTTPHEADER => array(
            'Authorization: App 462b80fba7b8deef462d418ef369b16d-0c0b7b03-64a7-4b00-8688-49e0ae918928',
            'AF-API-KEY: 4e8DKClsh4v0Q5jemKIP2eY8VI6Q2cf9',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}