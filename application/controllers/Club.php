<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Club extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this->load->database();
        $this->load->model('club_m');
        $this->load->model('admin_m');
        $this ->load->helper(array('url','date','form','alert','password'));
        $this->load->library("pagination");
    } 
    public function index() {
        $this->main();
        
    }
   public function main() {
       $this->evaluation();
    }
   function view() {
    $config = array();
    $id= $this->uri->segment(3);
    $config['base_url']="/club/view/$id";
    $config['total_rows']=$this->club_m->record_count($this->uri->segment(3));
    $config['per_page'] = 5;
    $config['uri_segment']=4;
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
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(4,0));
    $data['lists'] = $this->club_m->getview($this->uri->segment(3),'clubinfo');
    $data['file_list'] = $this->club_m->getfile($this->uri->segment(3));
    $data['reviews']=$this->club_m->getreview($this->uri->segment(3),$config['per_page'],$page);
    $data['links']=$this->pagination->create_links();
    $data['male_count'] = $this->club_m->getgendercount($id, 'M');
    $data['female_count'] = $this->club_m->getgendercount($id, 'F');
    $data['dept_count'] = $this->club_m->getdeptcount($id);
    $data['average']=$this->club_m->get_avg($this->uri->segment(3));
    $this->load->view("Clubs/View_v",$data);
    
} 
    function writercheck(){
        if(@$this->session->userdata('logged_in') == TRUE){
            $studentid = $this->input->GET('studentid', TRUE);
            $info_id = $this->input->GET('info_id',TRUE);
            $result = $this->club_m->membercheck($studentid,$info_id);
            if($result) echo "1000";
            else echo "3000";
        }
    }

   public function evaluation() {
    $dept = '';
    $search_word= '';
    $uri_array = $this -> segment_explode($this->uri->uri_string());
    if(in_array('q',$uri_array)){
        $dept = urldecode($this->url_explode($uri_array,'q'));
    }else if(in_array('s',$uri_array)){
        $search_word = urldecode($this->url_explode($uri_array,'s'));
    }
    $data['lists'] = $this->club_m->getclubname($dept,$search_word);
    $this->load->view("Clubs/Evaluate",$data);
   }

   function ranking(){
    $search_word = '';
    $uri_segment=3;
    $page_url = '';
    $uri_array = $this -> segment_explode($this->uri->uri_string());
    if(in_array('q',$uri_array)){
        $search_word = urldecode($this->url_explode($uri_array,'q'));
        $uri_segment=5;
        $page_url = '/q/' . $search_word;
    }
    $config = array();
    $page = ($this->uri->segment($uri_segment,0));
    $config['base_url']="/club/ranking".$page_url;
    $config['total_rows']=$this->club_m->get_all_count($search_word);
    $config['per_page'] = 10;
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
    $data['allcount'] = $config['total_rows'];
    $data['lists'] = $this->club_m->get_all_review($config['per_page'],$page,$search_word);
    $data['rank'] = $this->club_m->get_top6_avg();
    $data['allrank'] = $this->club_m->get_all_avg();
    $data['review_count']= $this->club_m->get_top6_review();
    $data['get_all_review_count'] = $this->club_m->get_all_review_count();
    $this->pagination->initialize($config);
    $data['links']=$this->pagination->create_links();
    $this->load->view("Clubs/Ranking", $data);
   }

   function insert_review(){
    $this->load->helper(array('password', 'alert'));
    $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
    $id = $this->input->post('id', TRUE);
    $write_data = array(
        'club_name' => $this->input->post('cname', TRUE),
        'score' => $this->input->post('score', TRUE),
        'review' => $this->input->post('review', TRUE),
        'username' => $this->input->post('username', TRUE),
        'info_id'=> $id,
        'password' => $hash,
        'ip_address' => $this->input->ip_address()
    );
    $result = $this->club_m->insert_review($write_data);
    if($result){
        alert("입력되었습니다",'/club/view/'.$id);
        exit;
    }else{
        var_dump($result);exit;
    }
   
}
    function delete_review(){
        $board_id = $this->input->post('board_id', TRUE);
        $id = $this->input->post('review_id', TRUE);
        $pw = $this->input->post('password', TRUE);
        $array = array(
            'id' => $id,
            'pw' => $pw
        );
        $result = $this->club_m->writer_check($array);
        if($result){
            $this->club_m->drop_id();
            $this->club_m->reset_id();
            alert("삭제되었습니다.", "/club/view/".$board_id);
            exit;
        }else{
            alert("삭제 실패하였습니다", "/club/view/".$board_id);
            exit;
        }
        
    }
    function comment_singo() {
        $singo_id = $this->input->post('review_id',TRUE);
        $singo_ip = $this->input->ip_address();
        $board_id = $this->input->post('board_id', TRUE);
        $result = $this->club_m->insert_singo($singo_id);
        if($result){
            alert("신고 접수되었습니다","/club/view/".$board_id);
        }else{
            alert("신고 접수되지않았습니다","/club/view/".$board_id);
        }

    }
    function comment_recommend() {
        $rec_id = $this->input->post('review_id',TRUE);
        $board_id = $this->input->post('board_id',TRUE);
        $result = $this->club_m->insert_recommend($rec_id);
        if($result) {
            alert("추천 완료", "/club/view/".$board_id);
        }else{
            alert("추천 불가","/club/view/".$board_id);
        }
    }
    function mypage(){
        if($this->session->userdata['status'] == "member"){
        $studentid = $this->session->userdata['studentid']; 
        $club_id = $this->uri->segment(3,0);
        $data['myinfo'] = $this->club_m->getmyinfo($studentid);
        $data['club'] = $this->club_m->getmyclub($studentid);
        $data['members'] = $this->admin_m->getmember($club_id);
        $data['allclub'] = $this->club_m->getclubname('no','');
        $this->load->view('Clubs/Mypage',$data);
        }else{
            alert('관리자 페이지를 이용해주세요', $_SERVER['HTTP_REFERER']);
        }
    }
    function delclub() {
        $c_name = $this->input->post('clubname',TRUE);
        $studentid = $this->session->userdata['studentid']; 
        $result = $this->club_m->delclub($c_name, $studentid);
        if($result){
            alert('탈퇴 성공', $_SERVER['HTTP_REFERER']);
        }else{
            alert('탈퇴 실패', $_SERVER['HTTP_REFERER']);
        }
    }
    function addclub() {
        $c_name=  $this->input->post('clubname', TRUE);
        $studentid = $this->session->userdata['studentid']; 
        $result = $this->club_m->addclub($c_name, $studentid);
        if($result){
            alert('추가 등록 성공', $_SERVER['HTTP_REFERER']);
        }else{
            alert('이미 가입된 동아리입니다.', $_SERVER['HTTP_REFERER']);
        }
    }
    function changepassword(){
        $password = password_hash($this->input->post('password', TRUE),PASSWORD_BCRYPT);
        $studentid = $this->session->userdata['studentid'];
        $this->db->where('studentid', $studentid);
        $data = array(
            'password' => $password
        );
        $result = $this->db->update('clubmember', $data); 
        if($result){
            alert('변경 성공', $_SERVER['HTTP_REFERER']);
        }else{
            alert('변경 실패', $_SERVER['HTTP_REFERER']);
        }
    }
    function showreview() {
        $review_id = $this->input->GET('review_id',TRUE);
        $info_id = $this->input->GET('info_id',TRUE);
        $this->db->select('*');
        $this->db->where('review_id', $review_id);
        $this->db->where('info_id', $info_id);
        $query = $this->db->get('comment');
        if($query->num_rows()>0) {
            ?>
            <table cellspacing="0" cellpadding="0" class="table">
            <tbody>
        <?php foreach($query -> result() as $lt){
            ?>
             <tr id="row_num_<?php echo $lt->id; ?>" style="border-bottom:1px solid #999;">
            <th scope="row">
                <?php echo $lt ->username;?>
            </th>
            <td>
                <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>">
                    <?php echo $lt -> reg_date;?>
                </time>
            </td>
            <td><?php echo $lt ->content;?></td>
            
            <td>
                <a href="#" class="comment_delete" vals="<?php echo $lt->id;?>">
                <i style="color: black;font-size:20px;border: 1px solid black;" class="material-icons">clear</i>
        </a>
            </td>
        </tr>
       <?php  }
        ?> </tbody>
        </table>
    <?php         
        }else{
            echo "2000";
        }
    }
    function comment_delete(){
        $review_id = $this->input->post('review_id', TRUE);
        $pw = $this->input->post('password', TRUE);
        $array = array(
            'id' => $review_id,
            'pw' => $pw
        );
        $result = $this->club_m->comment_writer_check($array);
        if($result){
            alert("삭제되었습니다.", $_SERVER['HTTP_REFERER']);
            exit;
        }else{
            alert("비밀번호가 일치하지 않습니다.", $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    function addreview(){
        $insert_data=array(
            'info_id' => $this->input->post('info_id', TRUE),
            'review_id' => $this->input->post('review_id',TRUE),
            'username' => $this->input->post('name', TRUE),
            'password' => password_hash($this->input->post('password',TRUE), PASSWORD_BCRYPT),
            'content'=> $this->input->post('content',TRUE),
        );
        $result = $this->club_m->insert_comment($insert_data);
        if($result){
            redirect('/club/view/'.$this->input->post('info_id', TRUE));
        }else{
            alert("실패");
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