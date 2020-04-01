
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model
{
    private $_ID;
    private $_url;

    public function setID($ID){
        $this->_ID = $ID;
    }
    public function setURL($url){
        $this->url = $url;
    }
    public function getPicture() {
        $this->db->select(array('p.id','p.url'));
        $this->db->from('picture p');
        $this->db->where('p.id', $this->_ID);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function create() {
        $data = array(
            'url' => $this->_url,
        );
        $this->db->insert('picture', $data);
        return $this->db->insert_id();

    }
}
?>