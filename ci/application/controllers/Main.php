<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('alert');
        echo "jiji";
        }
    
    public function index(){
        log_message("error", "Error Message");
        log_message("debug", "Debug Message");
        log_message("info", "Informational Message");
    }
    public function lists() {
    }
    function view() {
    }
}
