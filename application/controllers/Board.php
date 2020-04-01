<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this->load->database();
        $this ->load->model('board_m');
        $this ->load->helper(array('url','date','form'));
    } 
    public function index() {
        $this->lists();
    }
   public function _remap($method){
       $this->load->view('board/header_v');
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
         
        $config['base_url']='/ci/index.php/Board/lists/board'. $page_url . '/page/';
        $config['total_rows']=$this->board_m->get_list($this->uri->segment(3),'count','','',$search_word);
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

        $this->load->view('/board/list_v', $data);
        }

    //보기 기능
    function view() {
        $data['views'] = $this -> board_m -> get_view($this->uri->segment(3),
            $this -> uri ->segment(4));
        $this-> load -> view('board/View_v',$data);
    }
    //쓰기 기능
    function write() {
        //폼 검증하기
        $this -> load -> library('form_validation');
        $this ->form_validation->set_rules('board_title', '제목', 'required');
        $this ->form_validation->set_rules('board_content','내용','required');

        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
        
        if($this->form_validation->run() ==TRUE){
            $this ->load->helper('alert');
            $uri_array = $this ->segment_explode($this->uri->uri_string());
            
            if(in_array('page', $uri_array)){
                $pages= urldecode($this->url_explode($uri_array,'page'));
            }else {
                $pages=1;
            }
            
            if(!$this->input->post('board_title',TRUE) AND !$this->input->post('board_content',TRUE)){
                alert("비정상 작동",'/ci/index.php/board/lists/'.$this->uri->segment(3). '/page/' . $pages);
                exit;
            }
            $write_data = array(
                'board_title' => $this ->input -> post('board_title', TRUE),
                'board_content' => $this->input ->post('board_content', TRUE),
                'table' => $this -> uri -> segment(3)
            );
            $result = $this -> board_m -> insert_board($write_data);
            if($result) {
                alert("입력되었습니다",'/ci/index.php/board/lists/'.$this->uri->segment(3).'/page/'.$pages);
                exit;
            }else {
                alert("다시 입력해주세요",'/ci/index.php/board/write/'.$this->uri->segment(3).'/page/');
                exit;
            }
        }else {
            $this->load->view('board/write_v');
        }
    }

    function delete(){
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 
        $this->load->helper('alert');
        
        $return = $this->board_m->delete_content($this->uri->segment(3), $this->uri->segment(5));
        
        if ( $return ) {
            alert('삭제되었습니다.', '/ci/index.php/board/lists/'.$this->uri->segment(3).'/page/'.$this->uri->segment(7));
            exit;
        } else {
            alert('삭제 실패하였습니다.', '/ci/index.php/board/view/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$this->uri->segment(7));
            exit;
        }
        
    }
    function modify() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        
        if($_POST) {
            //var_dump($_POST);
            $this ->load->helper('alert');
            $uri_array = $this ->segment_explode($this->uri->uri_string());
    
            if(in_array('page', $uri_array)){
                $pages= urldecode($this->url_explode($uri_array,'page'));
            }else {
                $pages=1;
            }
            
            if(!$this->input->post('board_title',TRUE) AND !$this->input->post('board_content',TRUE)){
                alert("비정상 작동",'/ci/index.php/board/lists/'.$this->uri->segment(3). '/page/' . $pages);
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
                alert('수정되었습니다.', '/ci/index.php/board/view/'.$this->uri->segment(3).'/'.$this->uri->segment(5));
                exit;
            } else {
                alert('다시 수정해주세요.', '/ci/index.php/board/modify/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$pages);
                exit;
            }
        }else {
            $data['views'] = $this->board_m->get_view($this->uri->segment(3), $this->uri->segment(5));
            $this->load->view('board/modify_v',$data);
        }
    }
    function segment_explode($seg) {
        $len = strlen($seg);
        //var_dump($seg); $seg = Board/lists/board/page/10
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
    
