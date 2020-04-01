<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainpage extends CI_Controller {
    
    public function index() {
        $this->load->helper(array('directory','url','file'));
        $this->load->view('Main');
        
    }
    function showpictures(){
        $this->load->helper('alert');
        $country = $this->input->get('value',TRUE);
        switch($country){
            case "india" :
                $ment = "대학 동기인 친구와 15일간 갔던 인도 배낭 여행, 가는 곳마다 사기를 당하고 한국인을 지갑처럼 대하는
                그들의 태도에 실망과 스트레스를 받았지만 힘든 여행이 기억에 남는다고, 다시 한번 가보고 싶은 그런 곳이다.";
                break;
            case "japan" :
                $ment = "가족들과 함께 훗카이도, 오사카를 갔다. 처음으로 가족들과 함께 한 해외여행은 친구들과 갈 때와는 달리 자유로움은
                없었지만, ";
            break;
            case "jeju" :
                $ment = "제주도";
            break;
            case "cambodia" :
                $ment = "캄보디어";
            break;
            case "philippines" :
                $ment = "필리핀";
            break;
            case "taiwan" :
                $ment = "대만";
            break;



        }
        ?>
        <link rel= "stylesheet" href="/portfolio/assets/mainpage.css" type="text/css">
    
        <div class="pop-header">
            <h4><?=$ment?></h4>
            
        </div>
        <div class="pop-content">
            <div id="img-wrap">
            <?php $dir = $_SERVER['DOCUMENT_ROOT']."/portfolio/images/$country";
            $handle = opendir($dir);
            $files=array();
            while(false !== ($filename =readdir($handle))){
                if($filename=="." || $filename==".."){
                    continue;
                }
                if(is_file($dir . "/" . $filename)){
                    $files[] = $filename;
                }
            }
            closedir($handle);
            foreach($files as $f){
                ?>
                <img style="width:200px;height: 200px;" src="/portfolio/images/<?=$country?>/<?=$f?>">
            <?php     
            }
                ?>
            </div>
        </div><?php 
    }
}
?>