<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>news</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <script>
        $(document).ready(function() {
            $.ajax({
            url: "/ci/index.php/ajax_board/ajax_get_comment",
            method: "post",
            data : {
                "csrf_test_name" : getCookie('csrf_test_name'),
                "table" : "<?php echo $this->uri->segment(3);?>",
                "board_id" : "<?php echo $this->uri->segment(4);?>"
            },
            dataType : "html",
            complete : function(xhr, textStatus){
                if(textStatus == 'success'){
                        $("#comment_area").html(xhr.responseText);
                        $("#input01").val('');
                    }
            }
        });
        $("#test").click(function (){
            alert("test");
        });
        $("#search_btn").click(function() {
            if ($("#q").val() == '') {
                alert("검색어를 입력하세요!");
                return false;
            } else {
                var act = "/ci/index.php/board/lists/board/q/" + $("#q").val() + "/page/1";
                $("#bd_search").attr('action', act).submit();
            }
        });
    });
        $(function() {
            $("#comment_add").click(function() {
            $.ajax({
            url: "/ci/index.php/ajax_board/ajax_comment_add",
            method: "post",
            data : {
                "comment_contents" : encodeURIComponent($("#input01").val()),
                "csrf_test_name" : getCookie('csrf_test_name'),
                "table" : "<?php echo $this->uri->segment(3);?>",
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
                    }
                }
            }
        });
    });
    });
    
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

<header>
<h3> 보도자료 </h3>
<p>BGF복지재단의 언론 보도 기사를 전해 드립니다.</p>

<a href="/ci/index.php/board/delete/<?php echo $this -> uri -> segment(3); ?>/board_id/<?php echo $this -> uri -> segment(4); ?>/page/<?php echo $this -> uri -> segment(7); ?>"class="btn btn-danger"> 삭제 </a>
<a href="/ci/index.php/board/modify/<?php echo $this -> uri -> segment(3); ?>/board_id/<?php echo $this -> uri -> segment(4); ?>/page/<?php echo $this -> uri -> segment(7); ?>"class="btn btn-primary">수정 </a>
</header>
<colgroup>
    <col width="50%">
    <col width="50%">
</colgroup>
<thead>
<tr>
    <th colspan="2">
        <div class="title">
            <strong></strong>
        </div>
    </th>
</tr>
<tr>
    <th>
        <div class="name">
            <span><?php echo $views-> username;?></span>
        </div>
    </th>
</tr>
<tr>
    <th>
        <div class="date">
            <span><?php echo $views->board_date;?></span>
        </div>
    </th>
</tr>
</thead>
<tbody>
<tr>
    <td colspan="2">
        <div class="view_contents">
            <div class="txt">
            <p><?php echo $views-> board_content;?></p>
            </div>
        </div>
    </td>
</tr>
<!--첨부파일-->
<tfoot>
<form class="form-horizontal" method="POST" action="" name="com_add">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="input01">댓글</label>
                <div class="controls">
                    <textarea class="input-xlarge" id="input01" name="comment_contents" rows="3"></textarea>
                    <input class="btn btn-primary" type="button" id="comment_add" value="작성" >
                    <p class="help-block"></p>
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
                <tr>
                    <th scope="row">
                        <?php echo $lt->username;?>
                    </th>
                    <td><?php echo $lt->board_content;?></td>
                    <td>
                    <?php $st= $lt->board_date;
                $datestring = date("Y-m-d", strtotime($st));
                echo $datestring?>
                    </td>
                </tr>
<?php
    }
?>
            </tbody>
        </table>
</tfoot>
</table>
</body>
<footer>
<a href="/ci/index.php/board/lists/<?php echo $this->uri->segment(3)?>">목록으로</a>
</footer>
</html>