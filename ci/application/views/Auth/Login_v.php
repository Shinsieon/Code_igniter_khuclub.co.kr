<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Anton|Bebas+Neue|Sigmar+One&display=swap" rel="stylesheet">
    <link rel= "stylesheet" href="/assets/list.css" type="text/css">
    <script src="/assets/jquery-3.4.1.min.js" type="text/javascript"></script>
    <title>Login</title>
</head>
<body>
<article id="board_area">
    <header><h1></h1></header>
<?php
    $attributes = array(
        'class' => 'form-horizontal',
        'id' => 'auth_login'
    );
   // echo form_open('Auth/login/', $attributes);
?>
    <?php echo form_open('/Auth/login', $attributes);?>
    <fieldset>
        <legend>로그인</legend>
        <div class="control-group">
            <label class="control-label" for="inputemail">아이디</label>
            <div class="controls">
                <input type="text" class="input-xlarge" id="email" name="username"
                    value="<?php echo set_value('username'); ?>" />
                <p class="help-block"></p>
            </div>
            <label class="control-label" for="input">비밀번호</label>
            <div class="controls">
                <input type="password" class="input-xlarge" id="password" name="password"
                    value="<?php echo set_value('password'); ?>" />
                <p class="help-block"></p>
            </div>
            <div class="controls">
                <p class="help-block"><?php echo validation_errors();?></p>
            </div>
            
            <div class="form_actions">
                <button type="submit" class="btn btn-primary">확인</button>
                <button class="btn" onclick="document.location.reload()">취소</button>
            </div>
        </div>
    </fieldset>
</article>
   
</body>
</html>
 