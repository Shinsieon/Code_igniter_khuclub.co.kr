<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_m extends CI_model {

	function __construct(){ 
		parent::__construct(); 
	} 
    
    function get_list() {
        $sql = "SELECT * FROM items";
        $query = $this->db->query($sql);
        $result = $query-> result();
        return $result;    
    }
    function get_view($id) {
        $sql = "SELECT * from items WHERE id = '" .$id. "'";
        $query = $this->db->query($sql);
        $result = $query -> row();
        return $result;
    }
}