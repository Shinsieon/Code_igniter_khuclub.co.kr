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
                $("#write_btn").click(function() {
                    if ($("#input01").val() == '') {
                        alert('제목을 입력해 주세요.');
                        $("#input01").focus();
                        return false;
                    } else if ($("#input02").val() == '') {
                        alert('내용을 입력해 주세요.');
                        $("#input02").focus();
                        return false;
                    } else {
                        $("#write_action").submit();
                    }
                });
            });
       </script>

</head>

<body>
<header>
<h3> 보도자료 </h3>
<p>BGF복지재단의 언론 보도 기사를 전해 드립니다.</p>

<a href="/ci/index.php/board/delete/<?php echo $this -> uri -> segment(3); ?>/board_id/<?php echo $this -> uri -> segment(4); ?>/page/<?php echo $this -> uri -> segment(7); ?>"class="btn btn-danger"> 삭제 </a>
        
</header>
<h1><?php echo $views-> board_title;?></h1><p><?php echo $views->board_date;?></p>
<h3><?php echo $views-> board_content;?></h3>
<form class="form-group" method="post" action="" id="write_action">
    <fieldset>
        <legend>기사 수정</legend>
            <div class="form-group">
                <label for="input01">제목</label>
                <input type="text" class="form-control" id="input01" name="board_title"
                    value="<?php echo $views->board_title;?>"/>
                <label for="input02">내용</label>
                <textarea class="form-control" id="input02" name="board_content" rows="5"><?php echo $views->board_content;?></textarea>
            </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="write_btn">수정</button>
                        <button class="btn" onclick="document.location.reload()">취소
                        </button>
                </div>
            </div>
        </fieldset>
</form>
</body>
</html>