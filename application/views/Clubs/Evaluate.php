<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:800+Coding&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton|Bebas+Neue|Sigmar+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel= "stylesheet" href="/assets/list.css" type="text/css">
    <script src="/assets/jquery-3.4.1.min.js" type="text/javascript"></script>
    <title>evaluation</title>
    <script>
        result = <?php if(@$this -> session -> userdata('logged_in')==TRUE)echo 1;else echo 0;?>;
        var user = '<?php echo $this -> session -> userdata('username');?>';
    function search_click(){
        if($('.s').val()!=''){
        var searchword = $('.s').val();
        location.href="/club/evaluation/s/"+searchword;
        }else alert("검색어를 입력해주세요");
    }
    function enterkey() {
        if (window.event.keyCode == 13) {
             search_click();
        }
}
    $(function() {

        $('#about').click(function() {
            $('#popup').fadeIn();
        });
        $('#popup').click(function() {
            $('#popup').fadeOut();
        });
        $('.top').click(function(){
            $('html, body').animate( {scrollTop:0}, 400);
            return false;
        });
        $('#menuicon').click(function(e) {
            e.stopPropagation();
            $('.menu_detail').fadeToggle();
        });
        $(document).click(function(e) {
                $('.menu_detail').hide();
        });
        $('#button').mouseover(function(){
           $('.text').attr("height","100%"); 
        });
        $('#button').click(function() {
            $('#testModal').modal('show');
        });
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
            $('#usericon').css('color', 'white');
        }
      });  
      
            
    </script>
</head>
<body>
<div id="popup">
    <div id="popmenu">
        <p>경희대학교 중앙동아리 평가 사이트입니다. <br>
        계정 신청을 한 동아리원 만이 후기를 남길 수 있으며, 익명성은 보장됩니다.<br></br> 구경은 자유롭게 할 수 있습니다:)</p>
        무분별하고 악의적인 후기는 남기지 말아주십시오.<br>
        중앙동아리연합회와는 무관하게 개발된 사이트입니다.</p>
        <span>개발자 연락처: 01087265402</span>
        <?php echo $this->input->ip_address();?>
        <div class="exit">닫기</div>
    </div>
    </div>
<div id="wrap">
<div class="container">

<div class="menu-bar">
    <ul class="menu">
    <li id="home" style="left:0;"><a href="/club"><i class="material-icons">home</i></a></li>
        <li><p class="p_user" style="font-size:20px;color:white;position:relative;"></p></li>
        <li><a class="loginicon" style="color:#ee6e74;cursor:pointer;"><i id="usericon" class="material-icons m">person_pin</i></a>
            <ul class="login_detail">
                <li><a href="/club/mypage">마이페이지</a></li>
                <li><a href="/admin/admain/<?php echo $this -> session -> userdata('dongcode');?>">관리페이지</a></li>
                <li id="logout"><a href="/admin/logout">로그 아웃</a></li>
            </ul>
    </li>
        <li><a class="menuicon" style="cursor:pointer;"><i id="menuicon"class="material-icons m">menu</i></a>
        <ul class="menu_detail">
            <li><a href="/club/ranking">랭킹 보기</a></li>
            <li><a href="https://jajudy.khu.ac.kr/">중앙동아리연합회</a></li>
            <li><a href="/admin/register">계정 신청</a></li>
            
        </ul>
        </li>
    </ul>
</div>
<div class="login_form">
    <div id="form_area">
<?php
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
    <h1>Leave your reviews</h1>
    <h2>경희대학교 중앙동아리에 관한 모든 것</h2>
    
    <div class="search_form">
      <div class="search">
          <i onclick="search_click();" style="cursor:pointer;color:#999;margin:10px 10px;"class="material-icons">search</i>
          <span><input onkeyup="enterkey();"class="s" type="text" data-autofocus autocomplete="off" placeholder="동아리 검색"></span>
    </div>
    </div>
<button id="about">ABOUT</button>
    </div>
</div>
<div class="category">
<p class="title">Club Category</p>
<ul class="btn_set">
<li><p class="filter_btn_parent" >
    <span class="filter_btn" data-val="performance" style="cursor:pointer"
    onclick="location.href='/club/evaluation';">All</span></p></li>
    <li><p class="filter_btn_parent" >
    <span class="filter_btn" data-val="performance" style="cursor:pointer"
    onclick="location.href='/club/evaluation/q/연행';">연행</span></p></li>
    <li><p class="filter_btn_parent" >
    <span class="filter_btn" data-val="scholarship" style="cursor:pointer"
    onclick="location.href='/club/evaluation/q/학술';">학술</span></p></li>
    <li><p class="filter_btn_parent">
    <span class="filter_btn" data-val="sports" style="cursor:pointer"
    onclick="location.href='/club/evaluation/q/체육';">체육</span></p></li>
    <li><p class="filter_btn_parent">
    <span class="filter_btn" data-val="society" style="cursor:pointer"
    onclick="location.href='/club/evaluation/q/사회';">사회</span></p></li>
    <li><p class="filter_btn_parent">
    <span class="filter_btn" data-val="religion" style="cursor:pointer"
    onclick="location.href='/club/evaluation/q/종교';">종교</span></p></li>
    <li><p class="filter_btn_parent">
    <span class="filter_btn" data-val="cultural" style="cursor:pointer"
    onclick="location.href='/club/evaluation/q/취미교양';">취미교양</span></p></li>
    <li><p class="filter_btn_parent">
    <span class="filter_btn" data-val="creation" style="cursor:pointer"
    onclick="location.href='/club/evaluation/q/전시창작';">전시창작</span></p></li>
</ul>
</div>
<div class="grid">
    <?php foreach($lists as $lt) { ?>
    <article id="button" style="cursor:pointer" 
    onclick="location.href='/club/view/<?php echo $lt->id;?>'"class="item <?php echo $lt->c_dept;?>">
        <div class="im">
        <img src="<?php echo $lt->pic_path;?>" alt="" style="object-fit:cover;">
        </div>
        <div class="section">
            <div class="text">
                <h3 class="title"><?php echo $lt->c_name;?></h3>
                <h4 class="dept"><?php echo $lt->c_dept;?></h4>
                <span class="cont"><?php echo $lt->c_cont;?></span>
            </div>
        </div>
    </article>
    <?php } ?>
</div>
<div class="footer">
</div>
    </div>
    <a style="display:scroll;position:fixed;bottom:10px;right:10px;" 
    class="top" href="#" title="맨위로">
    <img style="width:50px;z-index:10;"src = "/images/top.png"/></a>
<!--modal-->

</body>

</html>