<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this->load->database();
        $this ->load->model('board_m');
        $this ->load->helper(array('url','file','date','form','cookie'));
        
    } 
    public function index() {
        $this->lists();
    }
    
   public function _remap($method){
       if(method_exists($this,$method)){
           $this->{"{$method}"}();
       }
   }
    public function lists(){
        //$this -> output -> enable_profiler(TRUE);
        $search_word = '';
        $page_url = '';
        $uri_segment=5;
        //주소 중에서 q 세그먼트가 있는 지 검사하기 위해 주소를 배열로 변환
        $uri_array = $this -> segment_explode($this->uri->uri_string());
        //$uri_array=array(5) { [0]=> string(5) "Board" [1]=> string(5) "lists" [2]=> string(5) "board" [3]=> string(4) "page" [4]=> string(2) "10" }
        if(in_array('q', $uri_array)){
            $search_word = urldecode($this->url_explode($uri_array,'q'));
            $page_url = '/q/' . $search_word;
            $uri_segment = 7;
        }
        //pagination 라이브러리 호출
        $this->load->library('pagination');
         
        $config['base_url']='/project2/board/lists/board'. $page_url . '/page/';
        $config['total_rows']=$this->board_m->get_list('board','count','','',$search_word);
        $config['per_page']=5;
        $config['uri_segment']=$uri_segment;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        //pagination 초기화
        $this ->pagination->initialize($config);
        //페이지 링크를 생성하여 view에서 사용할 변수에 할당.
        $data['pagination']=$this->pagination->create_links();
 
        $page = $this->uri->segment($uri_segment,1);
        if($page > 1)
        {
            $start=(($page/$config['per_page']))*$config['per_page'];
        }
        else {
            $start=($page-1)*$config['per_page'];
        }
        $limit = $config['per_page'];
        $data['list']=$this->board_m->get_list($this->uri->segment(3),'',$start,$limit,$search_word);
        $data['list_pic']=$this->board_m->get_list_with_pic();
        $this->load->view('/board/List_v', $data);
        }

    //보기 기능
    function view() {
        $table = $this->uri->segment(3);
        $board_id = $this->uri->segment(4);
        $data['views'] = $this -> board_m -> get_view($this->uri->segment(3),
            $this -> uri ->segment(4));
        $data['comment_list']=$this->board_m->get_comment('reviews',$board_id);
        $data['linkpath'] = $this->board_m->get_image($board_id);

        $this-> load -> view('/board/View_v',$data);
    }
    function do_upload(){
        $this->load->helper('alert');
        $config['upload_path'] = '/project2/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_filename']	= '255';
        $config['max_size']  = '1024';
        $config['encrypt_name']=FALSE;
        //alert(base_url() . "images/");
        
        //$this->load->library('upload',$config);
        if(isset($_FILES['file']['name'])){
            if( 0 < $_FILES['file']['error']){
                echo 'Error during file upload' . $_FILES['file']['error'];
            }else {
                if(file_exists('images/' . $_FILES['file']['name'])){
                    echo 'File already exists : images/' . $_FILES['file']['name'];
                }else{
                    $this->upload->initialize($config);
                    if( !$this->upload->do_upload('file')){
                        echo $this->upload->display_errors();
                    }else{
                        echo 'upload success : images/' . $_FILES['file']['name'];
                    }
                }
            }
        }else{
            echo 'Please choose a file';
        }
    }
    //쓰기 기능
    public function write() {
        //폼 검증하기
        $this->load->helper('alert');
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
        
        if(@$this ->session->userdata('logged_in')==TRUE){
            $this ->load-> library('form_validation');
            $this ->form_validation->set_rules('board_title', '제목', 'required');
            $this ->form_validation->set_rules('board_content','내용','required');
            if($this->form_validation->run() ==TRUE){
            $uri_array = $this ->segment_explode($this->uri->uri_string());
            if(in_array('page', $uri_array)){
                $pages= urldecode($this->url_explode($uri_array,'page'));
            }else {
                $pages=1;
            }
  
            $write_data = array(
            'board_title' => $this ->input -> post('board_title', TRUE),
            'board_content' => $this->input ->post('board_content', TRUE),
            'table' => $this -> uri -> segment(3),
            'username'=>$this->session->userdata('username')
            );
                    
                $result = $this -> board_m -> insert_board($write_data);
                if($result) {
                $board_id = $this->board_m->get_boardid();
                $write_img = array(
                        'bid' => $board_id,
                        'pic_path' => "/images/".$this->input->post('file_path', TRUE)
                        //'pic_path' => $_SERVER['DOCUMENT_ROOT']."/"."ci/upload/".$this->input->post('file_path', TRUE)
                    );
                    $this->board_m->insert_pic($write_img);
                    $this->upload->data(); 
                        alert("입력되었습니다",'/project2/board/lists/'.$this->uri->segment(3).'/page/'.$pages);
                        exit;
                        
                    }else {
                alert("다시 입력해주세요",'/project2/board/write/'.$this->uri->segment(3).'/page/');
                exit;
                }
            }else if (! $this->upload->do_upload()){
                $error = array('error' => $this->upload->display_errors());
			    $this->load->view('/board/Write_v', $error);
		        }	
            }else {
        alert('로그인 후 작성하세요', '/project2/auth/login');
          }
        }
    function delete(){
        $this->load->helper('alert');
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

        if(@$this->session->userdata('logged_in')==TRUE){
            $writer_id=$this->board_m->writer_check();
            //alert($writer_id->username . "and" . $this->session->userdata('username'));

            if($writer_id->username != $this->session->userdata('username')){
                alert('본인이 작성한 글이 아닙니다.', '/project2/board/view/'.$this->uri->segment(3).'/'.$this->uri->segment(5).'/page/'.$pages);
                exit;
            }
        
        $return = $this->board_m->delete_content($this->uri->segment(3), $this->uri->segment(5));
        
        if ( $return ) {
            alert('삭제되었습니다.', '/project2/board/lists/'.$this->uri->segment(3).'/page/'.$this->uri->segment(7));
            exit;
        } else {
            alert('삭제 실패하였습니다.', '/project2/board/view/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$this->uri->segment(7));
            exit;
        }
    }else{
        alert('로그인 후 삭제하세요.', '/project2/auth/login/');
        exit;
    }
}
    function modify() {
        $this->load->helper('alert');
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        if(@$this->session->userdata['logged_in']==TRUE){
            $write_name=$this->board_m->writer_check();
            if($write_name->username != $this->session->userdata('username')){
                alert('본인이 작성한 글이 아닙니다.','/project2/board/view/'.$this->uri->segment(3).'/'.$this->uri->segment(5).'/page/'.$pages);
                exit;
            }
            $this->load->library('form_validation');
            $this -> form_validation -> set_rules('board_title', '제목', 'required');
            $this -> form_validation -> set_rules('board_content', '내용', 'required');
        
            if($this->form_validation->run() ==TRUE){

                if(!$this->input->post('board_title',TRUE) AND !$this->input->post('board_content',TRUE)){
                alert("비정상 작동",'/project2/board/lists/'.$this->uri->segment(3). '/page/' . $pages);
                exit;
                }

                $modify_data = array (
                'table' => $this->uri->segment(3),
                'board_id'=>$this->uri->segment(5),
                'board_title'=>$this->input->post('board_title', TRUE),
                'board_content'=>$this->input->post('board_content', TRUE)
                );
                
                $result = $this->board_m->modify_board($modify_data);
                if ($result) {
                    alert('수정되었습니다.', '/project2/board/view/'.$this->uri->segment(3).'/'.$this->uri->segment(5));
                    exit;
                } else {
                    alert('다시 수정해주세요.', '/project2/board/modify/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$pages);
                    exit;
                }
                }else {
            $data['views'] = $this->board_m->get_view($this->uri->segment(3), $this->uri->segment(5));
            $this->load->view('/board/Modify_v',$data);
        }
    }else {
        alert('로그인 후 수정하세요', '/project2/auth/login/');
        exit;
    }
}
    function segment_explode($seg) {
        $len = strlen($seg);
        if(substr($seg, 0, 1)== '/'){
            $seg = substr($seg, 1, $len);
        }
        $len = strlen($seg);
        if(substr($seg,-1)=='/'){
            $seg = substr($seg, 0, $len - 1);
        }
        $seg_exp = explode("/", $seg);
        return $seg_exp;
    }
    function url_explode($url, $key){
        $cnt = count($url);
        for($i=0; $cnt > $i; $i++){
            if($url[$i] == $key){
                $k = $i+1;
                return $url[$k];
                 }
                }
            }
            
        }
        
    
