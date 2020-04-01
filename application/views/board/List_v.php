<html lang="en">
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
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <script>
        $(document).ready(function() {
            $('#search_btn').click(function() {
                if($('#q').val() ==''){
                    alert("검색어를 입력하세요");
                    return false;
                }else {
                    var act = "/ci/index.php/Board/lists/board/q/"+$("#q").val()+"/page/1";
                    $("#bd_search").attr('action',act).submit();
                }
            });
        });
    
        function board_search_enter(form) {
            var keycode = window.event.keyCode;
            if(keycode == 13)
                $("#search_btn").click();
        }
    </script>
</head>
<body>
<header>
            
</header>
<div class="container">
    <div class="search_wrap">
    </div>

    <!--DB에서 게시판 불러오기입니다-->
<article id="board_area">
    <h3> 보도자료 </h3>
    <p>BGF복지재단의 언론 보도 기사를 전해 드립니다.</p>   
        <form method="post" id="bd_search">
            <select class="type" name="search_type" id="">
                <option value="title" >제목</option>
                <option value="content" >내용</option>
            </select>
        <input name="search_word" id="q"
        type="text" onkeypress="board_search_enter(documnet.q);"/>
        <input class="btn btn-info" type="button" id="search_btn" value="검색">
        <a href="/ci/index.php/board/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>"
        class="btn btn-success">쓰기</a>
        </form>
    <table cellpaddin="0" cellspacing="0" class="table">      
    <thead>
    </thead>
        <tbody>
            <tr>
                <th scope="col">번호</th>
                <th scope="col">제목</th>
                <th scope="col">날짜</th>
            </tr>
            <?php foreach($list as $lt) { ?>
            <tr>
                <th scope="row"><?php echo $lt -> board_id;?></th>
                <?php $st= $lt->board_date;
                $datestring = date("Y-m-d", strtotime($st));
                ?>
                <td scope="row"><a rel="external" href=
                "/ci/index.php/<?php echo $this->uri->segment(1);?>/view/<?php echo $this->uri->segment(3);?>/<?php echo $lt->board_id;?>"><?php echo $lt->board_title?></a></td>
                <td scope="row"><?php echo $datestring;?></td>
                                    
                </tr>
            <?php }?>
        </tbody>
        <tfoot>
            <tr>
            
                <th colspan="5" ><?php echo $pagination;?></th>
            </tr>
        </tfoot>
    </table>
</article>

</body>
<footer>
</footer>
</html>