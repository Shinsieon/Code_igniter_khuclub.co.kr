<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="/assets/bootstrap.min.css" type="text/css">
    <link rel= "stylesheet" href="/assets/bootstrap.min.js" type="text/css">
    <link rel= "stylesheet" href="/assets/admin.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="/assets/jquery-3.4.1.min.js" type="text/javascript"></script>

    <title>Mypage</title>
</head>
<body>
<div id="wrap">
    <div id="container">
        <div class="nav">
        </div>
    <div id="content">
        <div class="object_box">
        <h3>내 정보</h3><a class="btn btn-info" href="/">홈으로</a>
        <?php foreach($myinfo as $mi){

        }?>
        <table cellspacing="0" class="table">
            <tr>
                <td>이름</td><td><?=$mi->username?></td>
    </tr>
    <tr>
                <td>학번</td><td><?=$mi->studentid?></td>
    </tr>
    <tr>
                <td>학년</td><td><?=$mi->grade?></td>
    </tr>
    <tr>
                <td>성별</td><td><?=$mi->gender?></td>
    </tr>
    </table>
    <input id="change" type="button" class="btn btn-danger" value="비밀번호 변경">
    <div id="pwfield" style="display: none;">
    <?php echo form_open('club/changepassword');?>
    <input type="password" style= "width: 200px;margin:0 auto;" name="password" class="form-control">
    <input type="submit" value="변경">
    </form>
    </div>


        
        </div>
        <div class="object_box">
            <?php echo form_open('club/delclub','id="del_club"');?> 
           <h3>내가 가입한 동아리</h3>
           <div class="card_layout">
           <?php foreach($club as $cl){ ?>
                <div class="item">
                    <img class="clubpic" style="cursor:pointer;width:100%;height:100%;"src="<?=$cl->pic_path?>"/></img>
                <input type="hidden" name="clubname" value="<?=$cl->c_name?>">
                <p><?=$cl->c_name?></p>   
                </div>

           <?php } ?></form>
           <?php echo form_open('club/addclub', 'id="add_club"');?>
           <div class="item" style="border:none;">
               <i class="material-icons">add</i>
               <div id="add_field">
           <input type="hidden" name="studentid" value="<?php echo $this->session->userdata['studentid'];?>">
           <select name="clubname" class="form-control">
               <?php foreach($allclub as $ac){ ?>
               <option value="<?=$ac->c_name?>"><?=$ac->c_name?></option>
               <?php }?>
           </select> 
           <input type="button" id = "add_btn" class="btn btn-info" value="등록">
           </div>
            </div>
           
           </form>
           </div>

        </div>
        <div class="object_box">
        <h3>나의 동아리 멤버</h3>
        <?php foreach($club as $cl){ ?>
        <a href="/club/mypage/<?=$cl->id?>"style="color:#999;"><?=$cl->c_name?></a>
        <?php } ?>
        <table cellspacing="0" style="text-align:center;"class="table table-bordered">
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
            if($members =='none'){
                ?><tr><td colspan="5"> <?php echo "멤버가 없습니다";?></td>
           </tr>
           <?php }else{ 
            foreach($members as $mb){?>
        <tr>
            <td><?=$mb->username?></td>
            <td><?=$mb->studentid?></td>
            <td><?=$mb->department?></td>
            <td><?=$mb->grade?></td>
            <td><?=$mb->gender?></td>
            </form>
        </tr>
        <tr><?php 
         } } }else{ ?><td colspan="5"> <?php echo "선택된 동아리가 없습니다.";?></td><?php }?>
        </tr>
    </tbody>
    </table>
        </div>
        <div class="object_box">
        </div>
    </div>
    </div>
</div>
<script>
    $(function(){
        $('.clubpic').click(function() {
            var result = confirm("동아리를 탈퇴하시겠습니까?");
            if(result)
            {
                $('#del_club').submit();
            }
        });
        $('#add_btn').click(function() {
            var result = confirm("동아리를 추가 등록하시겠습니까?");
            if(result)
            {
                $('#add_club').submit();
            }
            
        });
        $('#change').click(function() {
            $('#pwfield').toggle(function(){

            });
    });
    });
</script>

    
</body>
</html>