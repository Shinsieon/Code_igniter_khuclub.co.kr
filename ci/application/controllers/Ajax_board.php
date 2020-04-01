<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_board extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this->load->helper('url', 'alert','cookie');
    } 
    public function test() {
        $this -> load -> view('ajax/test_v');
    }
 
    public function ajax_action() {
        echo '<meta http-equiv="Content-Type" content="test/html; charset=utf-8" />';
 
        $name = $this -> input -> post("name");
 
        echo $name . "님 반갑습니다 !";
    }
    function ajax_get_comment() {
        if (@$this -> session -> userdata('logged_in') == TRUE) {
        $this -> load -> model('board_m');
        $table = $this -> input -> post('table', TRUE);
        $board_id = $this -> input -> post('board_id', TRUE);
        $sql = "SELECT * FROM ". $table ." WHERE board_pid = '". $board_id . "' ORDER BY board_id DESC";
        $query = $this -> db -> query($sql);?>
        <table cellspacing="0" cellpadding="0" class="table table-striped">
    <tbody>
<?php
                    foreach ($query -> result() as $lt) {
?>
        <tr>
            <th scope="row">
                <?php echo $lt -> username;?>
            </th>
            <td><?php echo $lt -> board_content;?></td>
            <td>
            <?php $st= $lt->board_date;
                $datestring = date("Y-m-d", strtotime($st));
                echo $datestring;?>
            </td>
            <td>
                <a href="#" class="comment_delete" vals="<?php echo $lt->board_id; ?>">
                </a>
            </td>
        </tr>
<?php
                    }
?>
    </tbody>
</table>
<?php
        
    }
}
    public function ajax_image_add() {
        $imgurl = $this->input->post('filename');
        echo $imgurl;;
    }
 
    public function ajax_comment_add() {
        if (@$this -> session -> userdata('logged_in') == TRUE) {
            $this -> load -> model('board_m');
            
            $table = $this -> input -> post('table', TRUE);
            $board_id = $this -> input -> post('board_id', TRUE);
            $comment_contents = $this -> input -> post('comment_contents', TRUE);
            if ($comment_contents != ''){
                $write_data = array(
                    "table" => $table,
                    "board_id"=>$board_id,
                    "comment_txt" => $comment_contents,
                    "username" => $this -> session -> userdata('username')
                );
                
                $result = $this -> board_m -> insert_comment($write_data);
                if ($result) {
                    $sql = "SELECT * FROM ". $table ." WHERE board_id = '". $board_id . "' ORDER BY board_id DESC";
                    $query = $this -> db -> query($sql);
                  ?>
      <table cellspacing="0" cellpadding="0" class="table table-striped">
    <tbody>
<?php
                    foreach ($query -> result() as $lt) {
?>
        <tr>
            <th scope="row">
                <?php echo $lt -> username;?>
            </th>
            <td><?php echo $lt -> comment_txt;?></td>
            <td>
            <?php $st= $lt->reg_date;
                $datestring = date("Y-m-d", strtotime($st));
                echo $datestring;?>
            </td>
            <td>
                <a href="#" class="comment_delete" vals="<?php echo $lt->board_id; ?>">
                </a>
            </td> 
        </tr>
<?php
                    }
?>
    </tbody>
</table>
<?php
                } else {
                    // 글 실패시
                    echo "2000";
                }
            } else {
                echo "1000";
            }
        } else {
            // 로그인 필요 에러
            echo "9000";
        }
    }
 
    function ajax_comment_delete() {
        if ( @$this -> session -> userdata('logged_in') == TRUE) {
            $this -> load -> model('board_m');
            $table = $this -> input -> post("table", TRUE);
            $comment_id = $this -> input -> post("comment_id", TRUE);
            $board_id = $this-> input->post("board_id", TRUE);
            $writer_id = $this -> board_m -> writer_check2($comment_id);
            if ( $writer_id->username != $this -> session -> userdata('username')) {
                echo "8000";
            } else {
                $result = $this -> board_m -> delete_comment($table, $comment_id);
                var_dump($result);
                if ($result) {
                    echo $board_id;
                } else {
                    echo "2000"; // 글 실패
                }
            }
        } else {
            echo "9000"; // 로그인 에러
        }
    }
 
}
?>
