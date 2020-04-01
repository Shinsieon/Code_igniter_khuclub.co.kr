<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mainpage extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this->load->database();
        $this ->load->model('board_m');
        $this ->load->helper(array('url','date','form','cookie'));
    } 
    public function index() {
        $this->load->library("crawler");
        $this->crawler->set_url('http://www.naver.com');
        $data['title']= $this->crawler->get_text();
        $this->load->view('board/mainpage', $data);
    }
}