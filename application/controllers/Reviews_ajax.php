<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews_ajax extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this->load->helper('url');
        $this->load->model('Club_m');
    } 
    function ajax_get_review() {
        
        //if (@$this -> session -> userdata('logged_in') == TRUE) {
        $table = $this -> input -> post('table', TRUE);
        $cl = $this-> input -> post('club_name', TRUE);
        $sql = "SELECT * FROM ". $table ." WHERE r_name = '". $cl . "' ORDER BY id DESC";
        $query = $this -> db -> query($sql);?>
        <table class="tabtype">
            <thead>
                <th class="th-1">점수</th>
                <th scope="cols">후기</th>
                <th scope="cols">날짜</th>
            </thead>
            <tbody>
            <?php
            if($query->num_rows()>0){
                    foreach ($query -> result() as $lt) {
            ?>
        <tr>
            <td><?php echo $lt -> c_score;?></td>
            <td><?php echo $lt -> c_review;?></td>
            <td><?php $st= $lt->c_dt;
                $datestring = date("Y-m-d", strtotime($st));
                echo $datestring;?></td>
        </tr>
        <?php
                    }
                }else{
                    echo "<tr>
                    <td colspan='3'>후기가 없습니다.</td>
                </tr>";
                }
        ?>
    </tbody>
</table>
<?php
        
    }
}
