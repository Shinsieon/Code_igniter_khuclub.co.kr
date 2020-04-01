<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/project2/css/mainpage.css">
    <link rel="stylesheet" href="/project2/css/jquery.bxslider.css">
     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="/project2/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <Script>
    $(document).ready(function(){
        $('.slider').slider();
        $('#search_btn').click(function() {
                if($('#q').val() ==''){
                    alert("검색어를 입력하세요");
                    return false;
                }else {
                    var act = "/project2/Board/lists/board/q/"+$("#q").val()+"/page/1";
                    $("#bd_search").attr('action',act).submit();
                }
        });
        $(".flex-item").click(function(){
        });
        $(".menu li").hover(function(){
            $('ul:first', this).show();
        }, function() {
            $('ul:first', this).hide();
        });
        $(".menu ul li:has(ul)")
    .find("a:first")
    .append("<p style='float:right;margin:-3px'>&#9656;</p>"); });
    function board_search_enter(form) {
            var keycode = window.event.keyCode;
            if(keycode == 13)
                $("#search_btn").click();
        }
    </script>
    <title>mainpage</title>
</head>
<body>
<div id="headerTop">
<?php
    if ( @$this -> session -> userdata('logged_in') == TRUE) {
?>
<?php echo $this -> session -> userdata('username');?> 님 환영합니다. <a href="/project2/auth/logout" class="btn-danger">로그아웃</a>
<?php
    } else {
?>
    <a href="/project2/auth/login">로그인 |</a>
    <a href="/project2/auth/signup">회원가입 |</a>
    <a href="/project2/auth/signup">마이페이지</a>
    
    <?php } ?>
</div>
<div class="menu-bar">
    <ul class="menu">
        <li><a href="/project2/board/lists/board">홈</a></li>
        <li><a href="/email">이메일</a>
            <ul>
                <li><a href="#">1-a 메뉴</a></li>
                <li><a href="#">1-b 메뉴</a></li>
            </ul>
        </li>
        <li><a href="#">2번 메뉴</a>
            <ul>
                <li><a href="#">2-a 메뉴</a></li>
                <li><a href="#">2-b 메뉴</a></li>
            </ul>
        </li>
        <li><a href="#">3번 메뉴</a>
            <ul>
                <li><a href="#">3-a 메뉴</a></li>
                <li><a href="#">3-b 메뉴</a></li>
            </ul>
        </li>
    </ul>
</div>
<div class="slider">
   
    <ul class="slides">
      <li>
        <img src="/project2/images/wheel.jpg"> <!-- random image -->
        <div class="caption center-align">
          <h3>This is our big Tagline!</h3>
          <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        </div>
      </li>
      <li>
        <img src="/project2/images/sketch.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h3>Left Aligned Caption</h3>
          <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        </div>
      </li>
      <li>
        <img src="/project2/images/windmill.jpg"> <!-- random image -->
        <div class="caption right-align">
          <h3>Right Aligned Caption</h3>
          <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        </div>
      </li>
      <li>
        <img src="/project2/images/man.jpg"> <!-- random image -->
        <div class="caption center-align">
          <h3>This is our big Tagline!</h3>
          <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
        </div>
      </li>
    </ul>
  </div>
  <div class="search-box">
  <form method="post" id="bd_search">
            <select class="type" name="search_type" id="">
                <option value="title" >제목</option>
                <option value="content" >내용</option>
            </select>
        <input name="search_word" id="q"
        type="text" onkeypress="board_search_enter(documnet.q);"/>
        <input class="btn btn-info" type="button" id="search_btn" value="검색">
    </form>
    <a href="/project2/board/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>"
        class="btn-floating">+</a>
    </div>
  <div class="flex-container">
      <?php foreach($list as $lt){ ?>
      <div class="flex-item" style="cursor:pointer;">
          <div class="pic">
              <img class="im" src="/project2/<?php echo $lt->pic_path;?>">
            </div>
            <div class="content">
            <h1><a rel="external" id="link"
                href="/project2/<?php echo $this->uri->segment(1);?>/view/<?php echo $this->uri->segment(3);?>/<?php echo $lt->board_id;?>"><?php echo $lt->board_title?></a></h1>
            <h3><?php $st= $lt->board_date;
                $datestring = date("Y-m-d", strtotime($st));
                echo $datestring;?></h3>
            <p><?php echo $lt->board_content;?></p>
            </div>
      </div><?php } ?>
    </div>
    <div class="text-center">
                <ul class="pagination">
                <li><?php echo $pagination;?></li>
                </ul>
            </div>

</body>
</html>