<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Board_m extends CI_Model {
    function __construct(){
        parent::__construct(); 
	} 
    function get_list($table='board', $type='',$offset='',$limit,$search_word) {
        $sword = '';
        if($search_word!=''){
            $sword = ' WHERE board_title like "%'.$search_word.'%" or board_content like "%'.$search_word. '$" ';
        }
        $limit_query='';
        if($limit != '' OR $offset !=''){
            $limit_query='LIMIT '. $offset .', ' .$limit;
        }
        //var_dump($limit_query);
        $sql = "SELECT * FROM ". $table . $sword. " ORDER BY board_id DESC ". $limit_query;
        //echo $sql;
        $query=$this->db->query($sql);
       // var_dump($sql);
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
    
    function get_view($table, $id) {
        $sql = "SELECT * FROM ".$table . " WHERE board_id= '". $id . "'";
        $query = $this->db->query($sql);
        $result = $query-> row();
        return $result;
    }
    function insert_board($arrays){
        $insert_array = array(
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
}