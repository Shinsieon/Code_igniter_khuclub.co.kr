<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Club_m extends CI_Model {
    function __construct(){
        parent::__construct(); 
    } 
    function getclubname($dept, $search_word) {
        if($search_word!= ''){
            $this->db->select("*");
            $this->db->like('c_name',$search_word);
            $this->db->or_like('c_cont', $search_word);
            $query = $this->db->get('clubinfo');
            $result = $query->result();
            return $result;
        }
        if($dept!=''){
            if($dept == 'no'){
                $this->db->select("*");
                $this->db->order_by('id','DESC');
                $query = $this->db->get('clubinfo');
                $result = $query->result();
                return $result;
            }else{
            $this->db->select("*");
            $this->db->where('c_dept', $dept);
            $query= $this->db->get('clubinfo');
            $result = $query->result();
            return $result;
            }
        }else{
        $this->db->select("*");
        $this->db->order_by('rand()');
        $query = $this->db->get('clubinfo');
        $result = $query->result();
        return $result;
    }
}
    function getgendercount($club_id,$gender){
        if($gender == 'M'){
            $this->db->where('info_id', $club_id);
            $this->db->where('gender','1');
            $this->db->from('clubmember');
            return $this->db->count_all_results();
        }else if($gender == 'F'){
            $this->db->where('info_id', $club_id);
            $this->db->where('gender','0');
            $this->db->from('clubmember');
            return $this->db->count_all_results();
        }
    }
    function getdeptcount($id){
        $sql = "SELECT department, round(count(department)/(SELECT count(*) as total from clubmember where info_id= '" . $id . "'),1) AS ct from clubmember where info_id = '". $id . "' group by department order by ct DESC LIMIT 10;"; 
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function delclub($name, $stid){
        $this->db->where('clubname', $name);
        $this->db->where('studentid', $stid);
        $result = $this->db->delete('clubbymember');
        return $result;
    }
    function addclub($name, $stid){
        $this->db->select("id");
        $this->db->where('c_name', $name);
        $query = $this->db->get('clubinfo');
        $row = $query->row();

        $insert_data = array(
            'clubname' => $name,
            'studentid' => $stid,
            'info_id' =>$row->id
        );
        $this->db->select("*");
        $this->db->where('clubname', $name);
        $this->db->where('studentid', $stid);
        $query2 = $this->db->get('clubbymember');
        if($query2->num_rows()> 0){
        return false;
        }else{
        $result = $this->db->insert('clubbymember', $insert_data);
        return $result;
        }
    }
    function insert_comment($array){
        $insert_data = array(
            'info_id' => $array['info_id'],
            'review_id' => $array['review_id'],
            'username' => $array['username'],
            'password' => $array['password'],
            'content'=> $array['content'],
            'reg_date' => date("Y-m-d H:i:s")
        );
        $result = $this->db->insert('comment', $insert_data);
        return $result;

    }
    function membercheck($_id, $info_id){
        $this->db->select('c_name');
        $this->db->where('id', $info_id);
        $query2= $this->db->get('clubinfo');
        $row = $query2 -> row();
        $this->db->select("*");
        $this->db->where('studentid', $_id);
        $this->db->where('clubname', $row->c_name);
        $query = $this->db->get('clubbymember');
        if($query->num_rows()>0){
            return TRUE;
        }else return FALSE;
    }
    function getmyclub($_id){
        $this->db->select("*");
        $this->db->from('clubbymember');
        $this->db->join('clubinfo', 'clubbymember.clubname = clubinfo.c_name and clubbymember.studentid='.$_id);
        $query= $this->db->get();
        $result = $query->result();
        return $result;
    }
    function getmyinfo($_id){
        $this->db->select("*");
        $this->db->where('studentid', $_id);
        $query = $this->db->get('clubmember');
        $result = $query ->result();
        return $result;
    }
    function getview($_id,$table) {
        $this->db->select("*");
        if($table=='clubreview'){
        $this->db->where('info_id', $_id);
        $this->db->order_by('info_id','DESC');
        }
        else if($table=='clubinfo'){
        $this->db->where('id', $_id);
        $this->db->order_by('id','DESC');    
    }
        $query= $this->db->get($table);
        $result= $query->result();
        return $result;
    }

    function get_dept_list($dept) {
        $this->db->select("*");
        $this->db->where('c_dept', $dept);
        $query = $this->db->get('clubinfo');
        $result = $query->result();
        return $result;

    }
    
    function get_all_review($limit, $start,$search_word){
        if($search_word!=''){
            $this->db->select("*");
            $this->db->like('c_review',$search_word);
            $this->db->or_like('r_name',$search_word);
            $this->db->limit($limit, $start);
            
            $this->db->order_by('c_dt', 'DESC');
            $query = $this->db->get('clubreview');
            $result = $query->result();
            return $result;
            
        }else{
        $this->db->select("*");
        $this->db->limit($limit, $start);
        $this->db->order_by('c_dt', 'DESC');
        $query = $this->db->get('clubreview');
        $result = $query->result();
        return $result;
    }
}
    function get_all_count($search_word){
        if($search_word!=''){
            $this->db->select("*");
            $this->db->like('c_review',$search_word);
            $this->db->or_like('r_name',$search_word);
            $this->db->from('clubreview');
            return $this->db->count_all_results();
        }else
        return $this->db->count_all('clubreview');
    }

    function record_count($_id) {
        $this->db->select("*");
        $this->db->where('info_id', $_id);
        return $this->db->count_all_results('clubreview');
    }
    function getreview($_id,$limit,$start) {
        $this->db->select("*");
        $this->db->where('info_id', $_id);
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'DESC');
        $query=$this->db->get('clubreview');
        $result=$query->result();
        return $result;

    }
    function getfile($_id){
        $this->db->select("*");
        $this->db->where('info_id', $_id);
        $query = $this->db->get('clubpicture');
        $result = $query->result_array();
        return $result;
    }

    function get_avg($_id){
        $this->db->select("avg(c_score) as average");
        $this->db->where('info_id', $_id);
        $this->db->group_by('r_name');
        $query=$this->db->get('clubreview');
        $result=$query->result();
        return $result;
    }
    function get_all_avg(){
        $sql = "SELECT c_name,info_id, pic_path, avg(c_score) as average from clubreview left join clubinfo on info_id=clubinfo.id group by info_id order by average DESC limit 6,60;";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function get_top6_avg(){
        $table='clubreview';
        $sql = "SELECT c_name,info_id, pic_path, avg(c_score) as average from clubreview left join clubinfo on info_id=clubinfo.id group by info_id order by average DESC limit 6;";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    function get_top6_review() {
        $sql = "SELECT c_name,info_id, pic_path, count(c_score) as ct from clubreview left join clubinfo on info_id=clubinfo.id group by info_id order by ct DESC limit 6;";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function get_all_review_count(){
        $sql="SELECT c_name,info_id, pic_path, count(c_score) as ct from clubreview left join clubinfo on info_id=clubinfo.id group by info_id order by ct DESC limit 0,60;";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function writer_check($array){
        $this->load->helper(array('password','alert'));
        $sql = "SELECT * from clubreview where id= '".$this->db->escape_str($array['id']). "'";
        $query = $this->db->query($sql);
        $result = $query->row();
        $hash = $result->password;
        
            if(password_verify($array['pw'], $hash))
            {
                // 맞는 데이터가 있다면 해당 내용 반환
                $this->db->where('id', $array['id']);
                $result = $this->db->delete('clubreview');
                return $result;
            }
            else
            {
                // 맞는 데이터가 없을 경우
                return FALSE;
            }
        }
    function comment_writer_check($array){
        $this->load->helper(array('password','alert'));
        $sql = "SELECT * from comment where id= '".$this->db->escape_str($array['id']). "'";
        $query = $this->db->query($sql);
        $result = $query->row();
        $hash = $result->password;
        if(password_verify($array['pw'], $hash))
        {
            // 맞는 데이터가 있다면 해당 내용 반환
            $this->db->where('id', $array['id']);
            $result = $this->db->delete('comment');
            return $result;
        }
        else
        {
            return FALSE;
        }
    }
    function delete_reviews($_id){
        $this->db->where('id', $_id);
        $result = $this->db->delete('clubreview');
        return $result;

    }
    function drop_id() {
        $sql = "ALTER TABLE clubreview DROP id;";
        $this->db->query($sql);
    }
    function reset_id() {
        $sql = "ALTER TABLE clubreview ADD id int not null auto_increment first, ADD PRIMARY KEY(id), AUTO_INCREMENT =1;";
        return $this->db->query($sql);
    }

    function insert_review($arrays){
        $data = array(
            'r_name' => $arrays['club_name'],
            'c_score' => $arrays['score'],
            'c_review' => $arrays['review'],
            'username' => $arrays['username'],
            'password' => $arrays['password'],
            'info_id' => $arrays['info_id'],
            'c_dt' => date("Y-m-d H:i:s"),
            'ip_address' => $arrays['ip_address']
        );
        $result = $this->db->insert('clubreview', $data);
        return $result;

    }
    
    function insert_singo($singo){
        $result= $this->db->set('blame', 'blame+1',FALSE)->where('id',$singo)->update('clubreview');
        return $result;
    }
    function insert_recommend($rec_id){
        
        $result= $this->db->set('recommend', 'recommend+1',FALSE)->where('id',$rec_id)->update('clubreview');
        return $result;
        
    }
    function getdeptname(){
        $this->db->select('*');
        $query = $this->db->get('department');
        $result = $query->result();
        return $result;
    }

}
