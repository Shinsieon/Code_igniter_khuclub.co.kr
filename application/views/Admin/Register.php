<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <link rel= "stylesheet" href="/assets/bootstrap.min.css" type="text/css">
    <link rel= "stylesheet" href="/assets/register.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:800+Coding&display=swap" rel="stylesheet"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="/assets/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="/assets/bootstrap.min.js"></script>
    
    <title>Register</title>
    
</head>
<body>
<div id="wrap">
    <div id="container">

<div class="menu-bar">
    <ul class="menu">
    <li id="home" style="left:0;"><a href="/club"><i class="material-icons">home</i></a></li>
    
        <li><a class="loginicon" style="color:#ee6e74;cursor:pointer;"><i id="usericon"class="material-icons m">person_pin</i></a>
        <ul class="login_detail">
                <li><a href="/club/mypage">마이페이지</a></li>
                <li><a href="/admin/admain/<?php echo $this -> session -> userdata('dongcode');?>">관리페이지</a></li>
                <li id="logout"><a href="/admin/logout">로그 아웃</a></li>
            </ul>
    </li>
        <li><a class="menuicon" style="cursor:pointer;"><i id="menuicon" class="material-icons m">menu</i></a>
        <ul class="menu_detail">
            <li><a href="/club/ranking">랭킹 보기</a></li>
            <li><a href="https://jajudy.khu.ac.kr/">중앙동아리연합회</a></li>
            <li><a href="/club/register">계정 신청</a></li>
        </ul>
        </li>
    </ul>
</div>
<div class="login_form">
    <div id="form_area">
<?php
echo validation_errors();
    echo form_open('admin/login', 'id="auth_login"');
    
?>
        <legend style="margin-top: 20px;">로그인</legend>
        <div class="input_field">
        <div class="controls" style="margin-bottom:40px;">
            <input type="radio" class="radio" name="cradio" value="clubhead">
            <label>동아리장</label>
            <input type="radio" class="radio" name="cradio" value="clubmember" checked="checked">
            <label>동아리원</label>
            </div>
            <div class="controls">
                <input type="text" class="input-xlarge" id="input1" name="username"
                placeholder= "STUDENTID" value="<?php echo set_value('username'); ?>" autocomplete="off"
                    required/>
            </div>
            <div class="controls">
            <input type="password" class="input-xlarge" id="input2" name="password"
                    placeholder= "Password" value="<?php echo set_value('password'); ?>" required/>
            </div>
            <div class="form_actions">
                <button type="submit" class="login_btn">확인</button>
            </div>
    </form>
        </div>
    </div>
</div>
<div class="header">
</div>
<div class="content">
    <div class="container">
        <div class="tab_menu" style="border-top:0; font-size:20px">
            <h3>계정 신청</h3><a href="/admin/adregister"><input type="button" class="btn btn-info"value="동아리장"></a>
            <p>동아리장은 여길 클릭해주세요</p>
        </div>
        <?php echo form_open('admin/register', 'id="signup_form",class="form_inline"'); ?>
        <select class="form-control" name="club[]" multiple>
        <?php foreach($club as $cl){?>
            <option value="<?=$cl->c_name?>"><?=$cl->c_name?></option>
        <?php } ?>
        </select>
        <input type="text" class="form-control" autocomplete="off" name="studentid" placeholder="학번" required>
        <input type="text" class="form-control" autocomplete="off" name="username" placeholder="이름"required>
        <input type="password" autocomplete="off" class="form-control" name="password" placeholder="비밀번호"required>
        <input type="password" class="form-control" name="passconf" placeholder="비밀번호 확인"> 
        <p><?php echo validation_errors();?> </p>
        <select class="form-control" name="department">
            <?php foreach($dept as $dp){ ?>
        <option value="<?=$dp->dept?>"><?=$dp->dept?>
            <?php } ?>
        </select>
        <select name="grade" class="form-control">
        <option value="1">1학년</option>
        <option value="2">2학년</option>
        <option value="3">3학년</option>
        <option value="4">4학년</option>    
    </select>
        <input type="radio" class="form-radio-input" name="gradio" value="1">남
        <input type="radio" class="form-radio-input" name="gradio" value="0">여
        
    </div>
    <input type="submit" class="btn btn-primary"value="등록">
</form>
<h5 style="font-weight:bold; font-size: 15px;">계정 신청을 하고 동아리장의 승인이 있어야 평가/후기를 남길 수 있습니다.</h5>

</div>
<div class="footer">
    <h5>개인정보 방침</h5>
</div>
</div>
</div>
</div>
<script>
    $(function(){
        result = <?php if(@$this -> session -> userdata('logged_in')==TRUE)echo 1;else echo 0;?>;
        var user = '<?php echo $this -> session -> userdata('username');?>';
            if(result==1){
               
            $('.p_user').text(user+"님");
            $('#usericon').css('color', '#ee6e74');
            $('.loginicon').click(function(e){
                e.stopPropagation();
                $('.login_detail').fadeToggle();
            });
            $(document).click(function(e) {
                
                $('.login_detail').hide();
        });
        }else{
            $('.loginicon').on('click', function(e) {
            e.stopPropagation();
            $('.login_form').slideToggle();
        });
        $(document).click(function(e) {
                if(!$('.login_form').has(e.target).length)
                $('.login_form').hide();
        });
        $('li').remove('#logout');
        $('#usericon').css('color', 'black');
        }
        $('#menuicon').click(function(e) {
            e.stopPropagation();
            $('.menu_detail').fadeToggle();
        });
        $(document).click(function(e) {
                $('.menu_detail').hide();
        });
    });
         
    </script>

    
    
</body>
</html>