<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel= "stylesheet" href="/assets/bootstrap.min.css" type="text/css">
    <link rel= "stylesheet" href="/assets/bootstrap.min.js" type="text/css">
    <link rel= "stylesheet" href="/assets/admin.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="/assets/jquery-3.4.1.min.js" type="text/javascript"></script>
    <title>Admin</title>
</head>
<body>
<div id="wrap">
    <div id="container">
        <div class="nav">
            <ul class="list-group">
                <?php foreach($lists as $ls){ ?>
                <li class="list-group-item"><a href="/admin/admain/<?=$ls->id?>"><?=$ls->c_name?></a></li>
                <?php }?>
            </ul>
        </div>
        <div id="content">
    <div class="object_box">
        <?php foreach($clubinfo as $ci){
        }?>
         <h4><?=$ci->c_name?></h4>
         <h5><?=$ci->c_dept?></h5>
         <p><?=$ci->c_cont?></p>
         <a class="btn btn-primary"
         href="/admin/modify/<?=$ci->id?>"
         id="change" style="font-size:15px;">정보 변경</a>
     
    </div>
    <div class="object_box">
        <table id= "member_table" cellspacing="0" class="table table-bordered">
            <thead>
                <tr>
                    <th>이름</th>
                    <th>학번</th>
                    <th>학과</th>
                    <th>학년</th>
                    <th>성별</th>
                </tr>
            </thead>
            <tbody>
                <?php if($members != ''){
                    if($members == 'none'){ ?>
                        <tr><td colspan="5"> <?php echo "멤버가 없습니다";?></td>
                        </tr> <?php 
                    }else{
                        echo form_open('admin/delete_member', 'id="del_com"');
                        foreach($members as $mb){?>
                         <tr>
                            <td><?=$mb->username?></td>
                            <td><?=$mb->studentid?></td>
                            <td><?=$mb->department?></td>
                            <td><?=$mb->grade?></td>
                            <td><?php if($mb->gender == 1) echo "M"; else echo "F";?></td>
                            <input type="hidden" name="mem_id" value="<?=$mb->studentid?>">
                            <input type="hidden" name="board_id" value="<?php echo $this->uri->segment(3);?>">
                            <td style="width:10px;"><a style="cursor:pointer;color:red;
                            font-size:10px;" class="cancel_btn">삭제</a></td>
                        </tr>
                        <?php } } }else{ echo "멤버가 없습니다"; } ?>
                        </form>
            </tbody>
        </table>
    </div>
    <div class="object_box">
        <h3>리뷰</h3>
        <table cellspacing="0" class="table table-bordered" style="font-size:12px;">
            <thead>   
                <tr>
                    <th>번호</th>
                    <th>리뷰</th>
                    <th>점수</th>
                    <th>날짜</th>
                    <th>작성자</th>
                    <th>신고</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reviews as $rv){ ?>
                    <tr>
                        <td><?=$rv->id?></td>
                        <td class="ac_num"><?=$rv->c_review?></td>
                        <td class="score"><?=$rv->c_score?></td>
                        <td class="date"><?=$rv->c_dt?></td>
                        <td class="user"><?=$rv->username?>
                        <td><?=$rv->blame?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="object_box">
        <?php $i = 0; echo form_open('/admin/delete_picture','id = "del"'); foreach($file_list as $fs){
        $file_path[$i] = $fs['path'];
        ?>
        <img style="width:100px;height:100px;cursor:pointer;"class="mySlides" 
        src="<?php echo $file_path[$i];$i++;?>">
        <input type="hidden" name="pic_info" value="<?=$fs['pic_id']?>"/>
        <input type="hidden" name="board_id" value="<?php echo $this->uri->segment(3,0);?>"/><?php }?>
        </form>
        <br></br>

        <div class="upload">
        <button class="btn btn-primary" id="upbtn">사진 업로드</button><br></br>
        <?php echo form_open_multipart('Admin/do_upload');?>    
            <div class="cont_form" style="display:none;">
                <input type="hidden" name="club_id" value="<?php echo $this->uri->segment(3,0);?>"/>
                <input type="file" multiple name="userfile[]" size="20"/>
                <textarea style="width:100%;"class="file_area" rows="5"></textarea>
                <br /><br />
                <input style="font-size:10px;padding:15px 30px;margin:0;"type="submit" value="upload"/>
           
            </div> 
            </form>
        </div>
    </div>
</div>
</div>
</div>
<script>
    $(document).ready(function() {
       
    $('.cancel_btn').click(function() {
            var con = confirm('멤버를 지우시겠습니까?');
            if(con){
                $('#del_com').submit();
            }else{
            }
        });
        $('.mySlides').click(function() {
            var result = confirm("사진을 삭제하시겠습니까?");
            if(result) {
                $('#del').submit();
            }else{
            }
        });
        $('#upbtn').click(function(){
                $('.cont_form').toggle(function(){
                });
            });
    var userid = '<?php echo $this->session->userdata('headid');?>';
    var dongcode = '<?php echo $this->session->userdata('dongcode');?>';
    var code = '<?php echo $this->uri->segment(3);?>';
    
    if(userid != 'admin'){
        $('ul').remove('.list-group');
        if(dongcode != code){
            alert('해당 동아리 장이 아닙니다');
            $('#wrap').empty();
        }
    }else{
    }
    
});
    </script>
</body>

</html>