<?php defined('BASEPATH') OR exit('No direct script access allowed');

class FTPex extends CI_Controller {
    function __construct(){
        parent::__construct(); 
    } 
    public function index() {
        $this->load->library('ftp');
        $config['hostname'] = 'sionsion.dothome.co.kr';
        $config['username'] = 'sionsion';
        $config['password'] = 'su970728!';
        $config['debug'] = TRUE;
        $this->ftp->connect($config);
        //$this->ftp->upload('/ci','/html','ascii', 0775);
        $list = $this->ftp->list_files('/html');
        print_r($list);
    
        $this->ftp->mirror('/ci','/html');
        $this->ftp->close();

      
    }
}
?>