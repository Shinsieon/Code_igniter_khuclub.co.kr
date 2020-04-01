<html lang="ko">
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
        $(document).ready(function() {
            $('.slider').slider();
            $(".menu li").hover(function(){
            $('ul:first', this).show();
        }, function() {
            $('ul:first', this).hide();
        });
        $(".menu ul li:has(ul)")
    .find("a:first")
    .append("<p style='float:right;margin:-3px'>&#9656;</p>");


        $("#ch").click(function() {
            var file_data = $('#userfile').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url : '/Board/do_upload',
                dataType : 'text',
                cache : false,
                contentType : false,
                processData : false,
                data: form_data,
                type: 'post',
                success: function(response){
                    alert(response);
                },
                error: function(response){
                    alert(response);
                }
            });
        });
        $("#write_btn").click(function() {
                if($("#input01").val() == ''){
                    alert('제목을 입력해 주세요.');
                    $("#input01").focus();
                    return false;
                }else {
                    var str = $("#userfile").val();
                    var link = str.slice(12);
                    $("#imgload").val(link);
                    $("#write_action").submit();
                }
            });
    });
    </script>
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
        <li><a href="#">1번 메뉴</a>
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
<form class="form-group" name= "myform" method="post" action="" id="write_action">
        <h1>기사 쓰기</h1>
            <div class="form-group">
                <label for="input01">제목</label>
                <input type="text" class="form-control" id="input01" name="board_title"
                value="<?php echo set_value('board_title');?>">
                <label for="input02">내용</label>
                <textarea class="form-control" id="input02" 
                rows= "5" name="board_content" rows="5"><?php
                echo set_value('board_content');?></textarea>
                <div class="controls">
                    <p class="help-block"><?php echo validation_errors();?></p>
                </div>
                <div class="form-actions">
                <input type="file" id = "userfile" name="userfile" size="20" />
                <input type="hidden" name= "file_path" id="imgload" value=""/>
                <input type="button" id="ch" value ="upload"/>
                <br /><br />
                    <input type="submit" class="btn btn-primary" id="write_btn" value="작성"></button>
                        <button class="btn" href="/project2/board/lists/board">취소
                        </button>
                </div>
            </div>
</form>
</body>
</html>