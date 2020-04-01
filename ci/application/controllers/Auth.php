<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this ->load->model('auth_m');
        $this ->load->helper('form');
    } 
    public function index() {
    $this->login();
    }
    public function _remap($method) {
        $this->load->view('/board/Header_v');
        if(method_exists($this,$method)){
            $this->{"{$method}"}();
        }
    }
    public function login() {
        
        $this->load->library('form_validation');
        $this->load->helper('alert');
        $this->form_validation->set_rules('username', '아이디', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', '비밀번호', 'required');

        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

        if($this->form_validation->run()==TRUE)
        {
            $auth_data=array(
                'username' => $this->input->post('username', TRUE), 
                'password' =>$this->input->post('password', TRUE)
            );
            $result =$this->auth_m->login($auth_data);
            
            if($result)
            {
                //세션 생성
                $newdata = array(
                    'username' => $result->username, 
                     'email' =>$result->email,
                     'logged_in'=>TRUE		
                );

                $this->session->set_userdata($newdata);

                alert('로그인 되었습니다.', '/project2/board/lists/board/page/1');
                exit;
            }
            else
            {
                //실패 시
                alert('아이디나 비밀번호를  확인해 주세요.', '/project2/auth/login');
            }
        }
        else
        {
            //쓰기 폼 view 호출
            $this->load->view('/Auth/Login_v');
        }
    }
    public function logout() {
        $this->load->helper('alert');
        $this->session->sess_destroy();

        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 		alert('로그아웃 되었습니다', '/project2/board/lists/board/page/1');	
    }
    public function signup() {
   
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', '아이디', 'callback_username_check');
        $this->form_validation->set_rules('password', '비밀번호', 'required|matches[re_password]');
        $this->form_validation->set_rules('re_password', '비밀번호 확인', 'required');
        $this->form_validation->set_rules('email', '이메일 주소', 'required|valid_email');
        $this->load->helper('alert');
     
        if($this->form_validation->run() == false){
            
            $this->load->view('/Auth/Signup_v');  
        } else {
            if(! function_exists('password_hash')){
                $this->load->helper('password');
            }
            $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

            $this->load->model('user_m');
            $result = $this->user_m->add_user(array(
                'email' =>$this->input->post('email'),
                'password' => $hash,
                'username' => $this->input->post('username')
            ));
            if($result){
                alert("회원가입 성공", '/project2/auth/Login');

            }else{
                alert("중복된 아이디입니다.", '/project2/auth/signup');
            }
        }
    }
    public function username_check($username){
        $this->load->database();
        if($username){
            $result=array();
            $sql="SELECT * from users WHERE username = $username";
            $query=$this->db->query($sql);
            $affectedrows = $this->db->affected_rows();
            if($affectedrows == 1) {
                $this->form_validation->set_message('username_check', $username .'은 중복된 아이디입니다.');
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    function authentication() {
        $this->load->model('user_m');
        $user=$this->user_m->get_user_info(array('email'=>$this->input->post('username')));
        if(!function_exists('password_hash')){
            $this->load->helper('password');
        }
        if($this->input->post('email')==$user->email && password_verify($this -> input -> post('password'), $user -> pwd)){
            $this -> session -> set_userdata('is_login', true);
            $this -> load -> helper('url');
            redirect('/board/lists/board');    
        } else {
            
            $this -> session -> set_flashdata('message', 'failure to login');
            $this -> load -> helper('url');
            redirect('/auth/login');    
        }
    }
}