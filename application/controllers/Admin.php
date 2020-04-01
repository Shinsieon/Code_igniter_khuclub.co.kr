<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this ->load->model('admin_m');
        $this->load->model('club_m');
        $this ->load->helper(array('form','alert','password_helper','url'));
        $this->load->library('form_validation');

    } 
    public function index() {
    $this->login();
    }
    public function _remap($method) {
        $this -> load -> view('Admin/Header_v');
 
        if (method_exists($this, $method)) {
            $this -> {"{$method}"}();
        } 
    }
    public function login() {
        $this->load->helper('alert');
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $this->form_validation->set_rules('username', '아이디', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', '비밀번호', 'required');
        $user = $this->input->post('cradio',TRUE);
        if($this->form_validation->run()==TRUE)
        {
            if($user =="clubhead"){
            $auth_data=array(
                'headid' => $this->input->post('username', TRUE), 
                'password' =>$this->input->post('password', TRUE)
            );
            $result =$this->admin_m->login($auth_data,$user);
            if($result)
            {
                $newdata = array(
                    'username' => $result->headname,
                    'headid' => $result->headid, 
                    'dongcode' => $result->info_id,
                    'status' => "head",
                    'logged_in'=>TRUE		
                );
                $this->session->set_userdata($newdata);
                alert('로그인 되었습니다.', '/Admin/admain/'.$result->info_id);
                exit;
            }else{
                alert('아이디나 비밀번호를  확인해 주세요.', '/club');
            }
        }else if($user=="clubmember"){
            $auth_data=array(
                'studentid' => $this->input->post('username', TRUE), 
                'password' =>$this->input->post('password', TRUE)
            );
            $result =$this->admin_m->login($auth_data,$user);
            if($result)
            {
                $newdata = array(
                    'username' => $result->username, 
                    'dongcode' => $result->info_id,
                    'studentid' => $result->studentid,
                    'status' => "member",
                    'logged_in'=>TRUE		
                );
                $this->session->set_userdata($newdata);
                alert('로그인 되었습니다.', '/club');
                exit;
            }else{
                alert('아이디나 비밀번호를  확인해 주세요.',$_SERVER['HTTP_REFERER']);
            }

        }else{
            alert("정보가 없습니다");exit;
        }
    }else
            redirect('/');
        }
    public function logout() {
        
        $this->session->sess_destroy();
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 		alert('로그아웃 되었습니다', $_SERVER['HTTP_REFERER']);	
    }
    function admain(){
        if(@$this ->session->userdata('logged_in')==TRUE){
            $user = $this->session->userdata('headid');
            $result = $this->admin_m->head_check($user);
            if($result){
                $club_id = $this->uri->segment(3,1);
                $data['lists'] = $this->club_m->getclubname('no','');
                $data['clubinfo'] = $this->club_m->getview($club_id,'clubinfo');
                $data['reviews'] =$this->club_m->getview($club_id,'clubreview');
                $data['members'] = $this->admin_m->getmember($club_id);
                $data['file_list'] = $this->club_m->getfile($this->uri->segment(3,1));
                $this->load->view('Admin/Admin_main', $data);
                }else{
                    alert('권한이 없습니다.', $_SERVER['HTTP_REFERER']);
                }
        }else{
            alert('로그인 후 이용하세요', '/admin/login');
        }
    }
    function modify() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        if(@$this->session->userdata['logged_in']==TRUE && $this->session->userdata['dongcode']==$this->uri->segment(3)){
            $this -> form_validation -> set_rules('club_content', '내용', 'required');
            $this -> form_validation -> set_rules('club_picpath', '경로' ,'required');
            $club_id = $this->uri->segment(3,0);
            if($this->form_validation->run() ==TRUE){
                $modify_data = array (
                    'club_id'=>$club_id,
                    'club_content'=>$this->input->post('club_content', TRUE),
                    'club_picpath'=>$this->input->post('club_picpath',TRUE)
                    );
                    $result = $this->admin_m->modify($modify_data);
                    if($result){
                        alert("수정완료",'/admin/admain/'.$club_id);
                        exit;
                    }else{
                        alert("수정실패", '/admin/modify/'.$club_id);
                        exit;
                    }

            }else{
                $data['views'] = $this->club_m->getview($club_id,'clubinfo');
                $this->load->view('Admin/Modify_v',$data);
            }
        }else if($this->session->userdata['dongcode']!=$this->uri->segment(3)){
            alert('해당 동아리 장이 아닙니다', $_SERVER['HTTP_REFERER']);
        }else{
            alert('로그인 후 작성하세요', '/admin/login');
        }
    }
    function delete_picture() {
        $id = $this->input->post('pic_info',TRUE);
        $board_id = $this->input->post('board_id',TRUE);
        $result = $this->admin_m->del_pic($id);
        if($result){
        alert("삭제되었습니다.",'/admin/admain/'.$board_id);
        }else{
            alert('삭제 실패했습니다.', $_SERVER['HTTP_REFERER']);
        }
    }
    function delete_member() {
        $id = $this->input->post('mem_id',TRUE);
        $board_id = $this->input->post('board_id',TRUE);
        $result = $this->admin_m->del_mem($id);
        if($result){
            alert("삭제되었습니다.",'/admin/admain/'.$board_id);
            }else{
                alert('삭제 실패했습니다.', $_SERVER['HTTP_REFERER']);
            }

    }
    function profile_upload(){
        $this->load->library('upload');
        $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
        $id = $this->input->post('club_id', TRUE);
        $files = $_FILES;
        $data['file'] = $files['profile']['name'];
        $this->load->library('upload', $config);
        $result= $this->upload->data();
        if($result) {
            $dt = array(
                'pic_path' => "/images/".$data['file']
            );
            $this->db->where('id', $id);
            $this->db->update('clubinfo',$dt);
            alert('등록 성공', '/admin/admain/'.$id);
        }else{
            alert("등록 실패", '/admin/admain/'.$id);
        }
        
    }
    function do_upload(){
        $this->load->library('upload');
        $id = $this->input->post('club_id', TRUE);
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for($i=0; $i<$cpt; $i++){
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $data['file_list'][$i] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];    
    
            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
        }
        $result = $this->admin_m->insert_pic($id,$data);
      if($result){
            alert('업로드 성공', '/admin/admain/'.$id);
        }else{
            alert("업로드 실패", '/admin/admain/'.$id);
        }
    }

    private function set_upload_options(){
        $config=array();
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }
    function register() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $this -> form_validation -> set_rules('club[]', '동아리' ,'required');
        $this -> form_validation -> set_rules('studentid', '학번', 'required|min_length[10]');
        $this -> form_validation -> set_rules('username', '이름' ,'required');
        $this -> form_validation -> set_rules('password', '비번' ,'required|matches[passconf]');
        $this -> form_validation -> set_rules('passconf', '비번확인' ,'required');
        $this -> form_validation -> set_rules('department', '학과' ,'required');
        $this -> form_validation -> set_rules('grade', '학년' ,'required');
        $this -> form_validation -> set_rules('gradio', '성별' ,'required');
        if($this->form_validation->run() == TRUE){
            foreach($_REQUEST['club'] as $selectedoption){
               $insert_data = array(
                    'clubname' =>$this->input->post('club', TRUE),
                    'studentid' =>$this->input->post('studentid', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
                    'department' => $this->input->post('department', TRUE),
                    'grade' => $this->input->post('grade', TRUE),
                    'gender' => $this->input->post('gradio', TRUE)
                
                );
            }
                $result = $this->admin_m->insert_mem($insert_data);
                if($result){
                    alert('계정 등록 완료되었습니다.','/admin/register');
                }else{
                    alert('중복된 계정입니다.');
                }
            }else{
                $data['dept'] = $this->club_m->getdeptname();
                $data['club'] = $this->club_m->getclubname('no','');
                $this->load->view('Admin/Register', $data);
            }
    
    }
    function adregister() {
         
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $this -> form_validation -> set_rules('club', '동아리' ,'required');
        $this -> form_validation -> set_rules('headid', '학번', 'required|min_length[10]');
        $this -> form_validation -> set_rules('password', '비번' ,'required');
        $this -> form_validation -> set_rules('email', '이메일' ,'required');
        $this -> form_validation -> set_rules('headname', '이름' ,'required');
        $this -> form_validation -> set_rules('department', '학과' ,'required');
        if($this->form_validation->run() == TRUE){
            $insert_data = array(
                'info_id' =>$this->input->post('club', TRUE),
                'headid' =>$this->input->post('headid', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
                'email' => $this->input->post('email', TRUE),
                'headname' => $this->input->post('headname', TRUE),
                'department' => $this->input->post('department', TRUE)
            );
            $result = $this->admin_m->insert_head($insert_data);
            if($result){
                alert('계정 등록 완료되었습니다.','/admin/register');
            }else{
                alert('동아리장이 이미 존재합니다.');
            }
        }else{
        $data['club'] = $this->club_m->getclubname('no','');
        $data['dept'] = $this->club_m->getdeptname();
        $this->load->view('Admin/Login_v',$data);
        }
    
    }
}