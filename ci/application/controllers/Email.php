<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this->load->library('email');
    } 
    public function index() {
        $this->emailsend();
       
    }
    function emailsend(){
        phpinfo();
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 587,
            'smtp_user' => 'coolguysiun@Naver.com',
            'smtp_pass' => 'asd970728',
            'charset' => 'iso-8859-1',
            'mail-type' => 'html',
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('coolguysiun@google.com','test');

        $this->email->to('coolguysiun@naver.com');
        $this->email->subject('test');
        $this->email->message("안녕");

        if(! $this->email->send()){
            echo "ERROR";
        }
        else {
            echo "success";
        }
        echo $this->email->print_debugger();
    }
}