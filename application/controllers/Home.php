<?php
use Spatie\Async\Pool;
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

        // $this->load->model('m_home');
        if (!$this->session->userdata('dataUser')) {
            redirect('Login');
        }
    }
    public function index() {
        // $binding = 'localhost:9092';
        // $server = stream_socket_server($binding);

        // if (false === $server) {
        //     throw new Exception('Could not listen');
        // }

        // while (true) {
        //     $client = stream_socket_accept($server);

        //     if (false !== $client) {
        //         stream_copy_to_stream($client, $client);
        //     }
        // }
        
        // while (true) {
        //     $message = $topic->consume(0, 120*10000);
        //     switch ($message->err) {
        //         case RD_KAFKA_RESP_ERR_NO_ERROR:
        //             var_dump($message);
        //             break;
        //         case RD_KAFKA_RESP_ERR__PARTITION_EOF:
        //             echo "No more messages; will wait for more\n";
        //             break;
        //         case RD_KAFKA_RESP_ERR__TIMED_OUT:
        //             echo "Timed out\n";
        //             break;
        //         default:
        //             throw new \Exception($message->errstr(), $message->err);
        //             break;
        //     }
        // }
		$this->load->view('home/home');
    }
    public function notfound() {
        $this->load->view('home/404');
    }
    public function signout()
    {
        unset($_SESSION['dataUser']);
        redirect('Login');             
    }
}
