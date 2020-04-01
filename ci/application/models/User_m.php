
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

function get_user_list() {
		return $this->db->query("SELECT * FROM users")->result();
	}
	function get_user_info($option){
		$result = $this->db->get_where('users',array('email'=>$option['email'])) ->row();
		var_dump($this->db->last_query());
		return $result;
	}
	function add_user($options) {
		$sql = "SELECT * from users where username = '" . $options['username'] ."'";
		$query = $this->db->query($sql);
		$affectedRows = $this->db->affected_rows();
		if($affectedRows == 1){
			return false;
		}else{
		$this -> db -> set('username', $options['username']);
        $this -> db -> set('email', $options['email']);
        $this -> db -> set('password', $options['password']);
        $this -> db -> set('reg_date', 'NOW()', false);
        $this -> db -> insert('users');
        $result = $this -> db -> insert_id();
        return true;
	}
}
}?>
