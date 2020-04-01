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

            $("#comment_add").click(function() {
                
            $.ajax({
            url: "/project2/ajax_board/ajax_comment_add",
            method: "post",
            data : {
                "comment_contents" : encodeURIComponent($("#input01").val()),
                "csrf_test_name" : getCookie('csrf_test_name'),
                "table" : "reviews",
                "board_id" : "<?php echo $this->uri->segment(4);?>"
            },
            dataType : "html",
            complete : function(xhr, textStatus){
                if(textStatus == 'success'){
                    if(xhr.responseText == 1000) {
                        alert("댓글 내용을 입력하세요");
                    }else if(xhr.responseText == 2000) {
                        alert("다시 입력하세요");
                    }else if(xhr.responseText == 9000){
                        alert("로그인해야 합니다");
                    }else {
                        $("#comment_area").html(xhr.responseText);
                        $("#input01").val('');
                        location.reload();
                    }
                }
            }
        });
    });
});
    function comment_delete($ci){
        $.ajax({
            url : '/project2/ajax_board/ajax_comment_delete',
            method: 'post',
            data: {
                "csrf_test_name" : getCookie('csrf_test_name'),
                "table" : "reviews",
                "comment_id" : $ci,
                "board_id" : "<?php echo $this->uri->segment(4);?>"
            },
            dataType : "text",
            complete: function(xhr, textStatus) {
                    if (textStatus == 'success') {
                        if (xhr.responseText == 9000) {
                            alert('로그인해야합니다.');
                        } else if (xhr.responseText == 8000) {
                            alert('본인의 댓글만 삭제할 수 있습니다.');
                        } else if (xhr.responseText == 2000) {
                            alert('다시 삭제하세요.');
                        } else {
                            
                            alert("삭제되었습니다");
                            location.reload();
                        }
                    }
                }
        });
    };
  
    
    function board_search_enter(form) {
        var keycode = window.event.keyCode;
        if (keycode == 13)
            $("#search_btn").click();
        }
    
    function getCookie(name) {
        var nameOfCookie = name + "=";
        var x = 0;
        
        while ( x <= document.cookie.length) {
            var y = (x + nameOfCookie.length);
            
            if (document.cookie.substring(x, y) == nameOfCookie) {
                if (( endOfCookie = document.cookie.indexOf(";", y)) == -1) 
                    endOfCookie = document.cookie.length;
                
                return unescape(document.cookie.substring(y, endOfCookie));
            }
            
            x = document.cookie.indexOf(" ", x) + 1;
            
            if ( x == 0) 
            
            break;
        }
        return "";
    }

       </script>
</head>
<body>
<div id="container">
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
      <div id="content">
      <h1><?php echo $views->board_title;?></h1>
      <span><?php echo $views->board_date;?></span>
      <p><span><?php echo $views->username;?>님이 작성한 기사입니다</span></p>
      <img width='500' height = '300' src='/project2/<?php echo $linkpath[0]->pic_path;?>'/><br>
      <?php echo $views-> board_content;?>
      
      <br></br>
        
<a href="/project2/board/delete/<?php echo $this -> uri -> segment(3); ?>/board_id/<?php echo $this -> uri -> segment(4); ?>/page/<?php echo $this -> uri -> segment(7); ?>"class="btn btn-danger"> 삭제 </a>
<a href="/project2/board/modify/<?php echo $this -> uri -> segment(3); ?>/board_id/<?php echo $this -> uri -> segment(4); ?>/page/<?php echo $this -> uri -> segment(7); ?>"class="btn btn-primary">수정 </a>

      <form class="form-horizontal" method="POST" action="" name="com_add">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="input01">댓글</label>
                <div class="controls">
                    <textarea class="input-xlarge" id="input01" rows=2 name="comment_contents"></textarea>
                    <input class="btn btn-primary" type="button" id="comment_add" value="작성" >
                </div>
            </div>
        </fieldset>
    </form>
    <div id="comment_area">
        <table cellspacing="0" cellpadding="0" class="table table-striped">
            <tbody>

            <!--댓글 영역-->
                <?php
                    foreach ($comment_list as $lt) {
                ?>
                <tr id="row_num_<?php echo $lt['board_id'];?>">
                    <th scope="row">
                        <?php echo $lt['username'];?>
                    </th>
                <td><?php echo $lt['comment_txt'];?></td>
                <td>
                    <?php $st= $lt['reg_date'];
                        $datestring = date("Y-m-d", strtotime($st));
                        $ci = $lt['comment_id'];
                        echo $datestring?>
                </td>
                <td>
                        <a class="del" value="<?=$ci?>" style="cursor:pointer;" onclick="comment_delete(<?=$ci?>)">
                            삭제
                        </a>
                    </td>
                </tr>
                    <?php }?>
            </tbody>
        </table>
    </div>
      </div>
    </div>
</body>
</html> 