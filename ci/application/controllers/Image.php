<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        //$host=$_SERVER['HTTP_HOST'];
        //$domain = $host;
        //define("BASE_URL", $host);
        //echo base_url("upload_success");
        $this->load->helper(array('form','url'));
    } 
    public function index() {
        if($this->input->post('upload') != NULL) {
            $data = array();
            $countfiles = count($_FILES['files']['name']);
            for($i=0;$i<$countfiles;$i++){
                if(!empty($_FILES['files']['name'][$i])){
        $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];

          // Set preference
          $config['upload_path'] = './upload/'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['files']['name'][$i];
          $this->load->library('upload', $config);
          if($this->upload->do_upload('file')){
              $uploadData = $this->upload->data();
              $filename = $uploadData['file_name'];
              $data['filename'][] = $filename;
                      }
                }
            }$this->load->view("views/board/upload_form",$data);
        }else{
            //$this->load->view(base_url(upload_success));
              }
            }
        }   