<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<?php
    if ( @$this -> session -> userdata('logged_in') == TRUE) {
?>
<?php echo $this -> session -> userdata('username');?> 님 환영합니다. <a href="/auth/logout" class="btn btn-danger">로그아웃</a>
<?php
    } else {
?>
    <a href="/project2/auth/login" class="btn btn-primary">로그인</a>
    <a href="/project2/auth/signup" class="btn btn-info">회원가입</a>
    <?php } ?>
</body>
</html>