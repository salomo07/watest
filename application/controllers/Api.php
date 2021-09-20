<?php
use Dotenv\Dotenv;
use Firebase\JWT\JWT;

use Kafka\Consumer;
use Kafka\ConsumerConfig;
use Monolog\Handler\StdoutHandler;
use Monolog\Logger;
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller 
{
    function __construct() {
        parent::__construct();
        header('Content-Type: application/json');
        $dotenv = Dotenv::createImmutable(FCPATH);
        $dotenv->load();
        $this->conf= json_decode(file_get_contents(base_url()."/conf.json"));
        $this->nameTopic=$this->conf->TOPIC_NAME1;
        $this->serverName=$this->conf->SERVER_ADD;
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('M_api');
    }
    public function getToken() {
        if(isset($_GET['username']) && isset($_GET['platform'])){
            $secretKey  = $this->conf->ACCESS_TOKEN_SECRET;
            $issuedAt   = new DateTimeImmutable();
            $expire     = time() + (30*60);                  // Expire = 30 minutes
            $serverName = $_GET['platform'];
            $username   = $_GET['username'];

            $data = [
                'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
                'iss'  => $serverName,                       // Issuer
                'nbf'  => $issuedAt->getTimestamp(),         // Not before
                'exp'  => $expire,                           // Expire
                'username' => $username,                     // User name
            ];
            echo json_encode(["token"=>\Firebase\JWT\JWT::encode($data, $secretKey, 'HS512'),"exp"=>date("d-m-Y h:i:s A",$expire)]);
        }
        else http_response_code(400);;
    }
    public function updateLeads() {
        // if($this->checkToken())
        // {	
        	$json = json_decode(file_get_contents('php://input'));

            if(isset($json))
            {
                $this->producingKafka($json);
                
            }
        // }
    }
    public function checkToken() {
        if(isset(getallheaders()['Authorization'])){
            $secretKey= $_ENV['ACCESS_TOKEN_SECRET'];
            $token=str_replace('Bearer ', '', getallheaders()['Authorization']);
            try{
                $decoded = \Firebase\JWT\JWT::decode($token, $secretKey, array('HS512'));
                if(strtotime("now")>=$decoded->exp)
                {
                    echo json_encode(["code"=>403,"status"=>"Your session is expired, please relogin"]); return false;
                }
                else return true;
            }catch(\Exception $e){
                echo json_encode(["code"=>500,"status"=>$e->getMessage()]); return false;
            }
            
        }else return false;
    }
    public function producingKafka($data) {
    	// using POST request
    	// Required : topic, body : 
    	// Offset is stored in database
    	$conf = new RdKafka\Conf();
		$conf->set('metadata.broker.list', $this->serverName);
        $producer = new RdKafka\Producer($conf);
		$topic = $producer->newTopic($this->nameTopic);
		$data=json_decode(json_encode($data));
		foreach ($data as $val) {
			// $this->M_api->insertLeads($val);
			// $topic->produce(RD_KAFKA_PARTITION_UA, 0,json_encode($val));
			// $producer->poll(0);
		}
		for ($flushRetries = 0; $flushRetries < 10; $flushRetries++) {
		    $result = $producer->flush(10000);
		    if (RD_KAFKA_RESP_ERR_NO_ERROR === $result) {
		        break;
		    }
		}

		if (RD_KAFKA_RESP_ERR_NO_ERROR !== $result) {
		    throw new \RuntimeException('Was unable to flush, messages might be lost!');
		}
		echo json_encode(["code"=>200,"status"=>count($json)." data inserted"]);
    }
    public function consumingOffsetStored() {
    	$limit=50;
    	// using GET request
    	// Required : topic
    	// Optional : limit
    	// Offset is stored in database

        if(!isset($_GET['topic'])){echo json_encode(["code"=>"401","desc"=>"Bad request or Bad Attitude"]);die();}
        if(isset($_GET['limit'])){$limit=$_GET['limit'];}
        // if(isset($_GET['offset'])){$lastoffset=$_GET['offset'];}
        $lastoffset=(int) $this->M_api->getLastOffset($_GET['topic'])->offset;
        $rk = new RdKafka\Consumer();
        $rk->addBrokers($this->serverName);

        
        $nextoffset=$lastoffset>0?$lastoffset+1:0;
        $topic = $rk->newTopic($_GET['topic']);

        $topic->consumeStart(0, $nextoffset);
        // $topic->consumeStart(0, RD_KAFKA_OFFSET_BEGINNING);

        $arrResult=[];
        while (true) {
            $msg = $topic->consume(0, 2000);
            if (null === $msg || $msg->err === RD_KAFKA_RESP_ERR__PARTITION_EOF) {
                break;
            } 
            elseif ($msg->err) {
                echo $msg->errstr(), "\n";
                break;
            } else {
            	if(count($arrResult)==$limit){break;}
                else{
                	array_push($arrResult, json_decode($msg->payload));
            		$lastoffset=(int) $msg->offset;
            	} 
            }
            // var_dump($arrResult);
        }
        $data=["topicname"=>$_GET['topic'],"lastoffset"=>$lastoffset];
        $this->M_api->insertOffset($data);
        echo json_encode($arrResult);
    }

    public function consumingOffsetLimit() {
    	$limit=50;
    	// using GET request
    	// Required : topic, offset
    	// Optional : limit

        if(!isset($_GET['topic']) || !isset($_GET['offset'])){echo json_encode(["code"=>"401","desc"=>"Bad request or Bad Attitude"]);die();}
        $lastoffset=$_GET['offset'];;
        if(isset($_GET['limit'])){$limit=$_GET['limit'];}

        $rk = new RdKafka\Consumer();
        $rk->addBrokers($this->serverName);

        
        $topic = $rk->newTopic($_GET['topic']);
        $topic->consumeStart(0, $lastoffset);

        $arrResult=[];
        while (true) {
            $msg = $topic->consume(0, 2000);
            if (null === $msg || $msg->err === RD_KAFKA_RESP_ERR__PARTITION_EOF) {
                break;
            } 
            elseif ($msg->err) {
                echo $msg->errstr(), "\n";
                break;
            } else {
            	if(count($arrResult)==$limit){break;}
                else{
                	array_push($arrResult, json_decode($msg->payload));
            		$lastoffset=(int) $msg->offset;
            	} 
            }
        }
        echo json_encode($arrResult);
    }
    public function getTotalRecords() {
    	$limit=50;
    	// using Get request
    	// Required : topic

        if(!isset($_GET['topic'])){echo json_encode(["code"=>"401","desc"=>"Bad request or Bad Attitude"]);die();}

        $rk = new RdKafka\Consumer();
        $rk->addBrokers($this->serverName);

        $topic = $rk->newTopic($_GET['topic']);

        $topic->consumeStart(0,0);

        $arrResult=[];
        while (true) {
            $msg = $topic->consume(0, 2000);
            if (null === $msg || $msg->err === RD_KAFKA_RESP_ERR__PARTITION_EOF) {
                break;
            } 
            elseif ($msg->err) {
                echo $msg->errstr(), "\n";
                break;
            } else {
            	array_push($arrResult, json_decode($msg->payload));
            }
        }
        $data=["totalrecords"=>count($arrResult)];
        echo json_encode($data);
    }
}
