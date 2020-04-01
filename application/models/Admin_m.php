<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*

 사용자 인증 모델

*/
class Admin_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	//아이디 비빌번호 체크
	function login($auth,$user)
	{
		$table = '';
		if($user == 'clubmember'){
		$table=$user;
		$this->db->select('*');
		$this->db->where('studentid', $auth['studentid']);
		$query = $this->db->get($table);
		$row = $query->row();
		if($query->num_rows()>0){
		$hash = $row->password;
		if(password_verify($auth['password'], $hash)){
			return $row;
		}else{
			return false;
		}
	}else return false;

	}else if($user=='clubhead'){
		$table = $user;
		$this->db->select('*');
		$this->db->where('headid', $auth['headid']);
		$query = $this->db->get($table);
		$row = $query -> row();
		if($query->num_rows()>0){
			$hash = $row->password;
			if(password_verify($auth['password'], $hash)){
				return $row;
			}else{
				return false;
			}
		}else return false;
	}
}
	function modify($array){
		$modify_array = array(
            'c_cont' => $array['club_content'],
            'pic_path' => $array['club_picpath']
        );
        $this->db->where('id', $array['club_id']);
		$result=$this->db->update('clubinfo', $modify_array);
        return $result;

	}
	function insert_pic($id, $data){
		$this->db->select('c_name');
		$this->db->where('id', $id);
		$query = $this->db->get('clubinfo');
		$row = $query->row();
			$cn = $row->c_name;
		for($i = 0;$i<count($data['file_list']);$i++){
			$object = array(
				'path' => '/images/'.$data['file_list'][$i],
				'club_name'=>$cn,
				'info_id' => $id
			);
			$this->db->insert('clubpicture',$object);
			
		}
		return TRUE;
		}
	function del_pic($id){
		$this->db->where('pic_id', $id);
		$result = $this->db->delete('clubpicture');
		return $result;
	}
	function del_mem($id){
		$this->db->where('studentid', $id);
		$result = $this->db->delete('clubbymember');
 		return $result;
	}
	function head_check($username){
		$this->db->select('*');
		$this->db->where('headid', $username);
		$query = $this->db->get('clubhead');
		if($query ->num_rows()>0)
		{
			return true;
		}else {
			return false;
		}
	}
	function student_check($stid){
		$this->db->select('*');
		$this->db->where('studentid', $stid);
		$query = $this->db->get('clubmember');
		if($query ->num_rows()>0)
		{
			return true;
		}else {
			return false;
		}
	}
	function insert_mem($array){
		$this->db->select('*');
		$this->db->where('clubname', $array['clubname'][0]);
		$this->db->where('studentid', $array['studentid']);
		$query = $this->db->get('clubmember');
		if($query->num_rows()>0){	return false;
		}else{
		$this->db->select('id');
		$this->db->where('c_name', $array['clubname'][0]);
		$query = $this->db->get('clubinfo');
		$row = $query->row();
		$insert_data = array(
			'info_id' =>$row->id,
			'clubname' =>$array['clubname'][0],
            'studentid' =>$array['studentid'],
            'username' => $array['username'],
			'password' => $array['password'],
            'department' => $array['department'],
            'grade' => $array['grade'],
            'gender' => $array['gender']
		);
		$i = count($array['clubname']);
		for($p=0; $p<$i; $p++){
		$this->db->select('id');
		$this->db->where('c_name', $array['clubname'][$p]);
		$query = $this->db->get('clubinfo');
		$row = $query->row();
		$insert_data2 = array(
			'info_id' => $row->id,
			'studentid' =>$array['studentid'],
			'clubname' => $array['clubname'][$p]
		);
		$this->db->insert('clubbymember', $insert_data2);
	}
	
		$result =$this->db->insert('clubmember', $insert_data);
		return $result;
		
	}
}
	function insert_head($array){
		$this->db->select('*');
		$this->db->where('info_id', $array['info_id']);
		$query = $this->db->get('clubhead');
		if($query->num_rows()>0) return false;
		else{
			$insert_data = array(
				'info_id' => $array['info_id'],
				'headid' => $array['headid'],
				'password'=> $array['password'],
				'email' => $array['email'],
				'headname' => $array['headname'],
				'department' => $array['department']
			);
			$result = $this->db->insert('clubhead', $insert_data);
			return $result;
		}
	}
	function getmember($id) {
		if($id == 0){
			return "";
		}else{
		$this->db->select('*');
		$this->db->where('info_id', $id);
		$query = $this->db->get('clubbymember');
		$result = $query->result();
		if(count($result)>0){
		$sql = "SELECT cb.info_id, cm.username, cm.studentid, cm.department, cm.grade, cm.gender from clubbymember as cb left join clubmember as cm on (cm.studentid=cb.studentid)
		where not cm.username is null and cb.info_id='".$id."';";
		$query = $this->db->query($sql);
		$result = $query->result();
			return $result;
		}
		else return "none";
		}
	}
	}
