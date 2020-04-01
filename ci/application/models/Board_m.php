<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Board_m extends CI_Model {
    function __construct(){
        parent::__construct(); 
        $this->load->helper('url');
    } 
    
    function get_list($table='board', $type='',$offset='',$limit,$search_word) {
        $sword = '';
        if($search_word!=''){
            $sword = ' WHERE board_title like "%'.$search_word.'%" or board_content like "%'.$search_word. '%" ';
        }
        $limit_query='';
        if($limit != '' OR $offset !=''){
            $limit_query='LIMIT '. $offset .', ' .$limit;
        }
        $sql = "SELECT b.board_id, b.board_content,b.board_date,b.board_title,p.pic_path FROM ". $table . " as b LEFT JOIN picture as p on b.board_id=p.board_id " .$sword. " ORDER BY board_id DESC ". $limit_query;
        $query=$this->db->query($sql);
        if($type == 'count')
        {
            //리스트를 반환하지 않고 전체 게시물의 개수를 반환
            $result = $query->num_rows();
        }
        else {
            $result = $query->result();
        }
        return $result;
    }
    function get_list_with_pic(){
        $sql = "SELECT b.board_id, b.board_content,b.board_date,b.board_title,p.pic_path FROM board as b
        LEFT JOIN picture as p
        on b.board_id = p.board_id;";
        $query= $this->db->query($sql);
        $result=$query->result();
        return $result;

    }
    
    function get_boardid(){
        $this->db->select_max('board_id');
        $query = $this->db->get('board');
        $result = $query->row_array();
        return $result['board_id'];
    }
    public function insert_pic($arrays) {
        $insert_array = array(
            'board_id' => $arrays['bid'],
            'pic_path' => $arrays['pic_path']
        );
        $this->db->insert('picture', $insert_array);
    }

    function get_image($id){
        $this->db->where('board_id', $id);
        $query = $this->db->get('picture');
        if($query->num_rows() >0){
            return $query->result();
        }
        header("Content-type: image/jpg");
        return false;
    }

    function get_view($table, $id) {
        $sql = "SELECT * FROM ".$table . " WHERE board_id= '". $id . "'";
        $query = $this->db->query($sql);
        $result = $query-> row();
        return $result;
    }
    function insert_board($arrays){
        $insert_array = array(
            'username' => $arrays['username'],
            'board_title' => $arrays['board_title'],
            'board_content' => $arrays['board_content'],
            'board_date' => date("Y-m-d H:i:s")
        );
        $result = $this->db->insert($arrays['table'], $insert_array);
        return $result;
    }
    function delete_content($table, $no){
        $delete_array = array(
            'board_id' => $no
        );
        $result = $this->db->delete($table, $delete_array);
        return $result;
    }
    function writer_check() {
        $table = "board";
        $board_id = $this->uri->segment(5);
        $sql = "SELECT username from ".$table." WHERE board_id= $board_id LIMIT 1";
        $query=$this->db->query($sql);
    
        return $query->row();
        
    }
    function delete_comment($table, $no){
        $delete_array = array(
            'comment_id' => $no
        );
        $result = $this->db->delete($table, $delete_array);
        return $result;

    }
    function writer_check2($comment_id) {
        $table = "reviews";
        $sql = "SELECT username from ".$table." WHERE comment_id= $comment_id LIMIT 1";
        $query=$this->db->query($sql);
        return $query->row();
    }
    function modify_board($arrays){
        $modify_array = array(
            'board_title' => $arrays['board_title'],
            'board_content' => $arrays['board_content']
        );
        $where = array(
            'board_id' => $arrays['board_id']
        );
        $result=$this->db->update($arrays['table'], $modify_array,$where);
        return $result;
    }
    function insert_comment($arrays){
        $insert_array=array(
            'board_id' => $arrays['board_id'],
            'username' => $arrays['username'],
            'comment_txt' => $arrays['comment_txt'],
            'reg_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert($arrays['table'], $insert_array);
        $board_id=$this->db->insert_id();
        return $board_id;
    }
    function get_comment($table, $id) {
        $sql = "SELECT * from $table WHERE board_id = $id ORDER BY board_id DESC";
        $query = $this->db->query($sql);
        $data = array();
        if($query != FALSE && $query ->num_rows() >0){
            foreach ($query -> result_array() as $row){
                $data[] = $row;
            }
        }
        return $data;
    }
}