<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/project2/css/bootstrap.css">
    <title>Document</title>
</head>
<body>
<article id="board_area">
    <header><h1></h1></header>
    <?php
        if(form_error('username')){
            $error_username=form_error('username');
        }else {
            $error_username=form_error('username_check'); 
        }
    ?>
    <?php echo validation_errors(); ?>
    <form method="POST" class="form-horizontal" action="/project2/auth/signup">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="username">아이디</label>
                <div class="controls">
                    <input type="text" name="username" class="input-xlarge" id="username" />
                    <p class="help-block">
                        <?php
                        if ($error_username==FALSE){
                            echo "아이디를 입력하세요.";
                        }else {
                            echo $error_username;
                        }?>
                    </p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password">비밀번호</label>
                <div class="controls">
                    <input type="password" name="password" class="input-xlarge" id="password" />
                    <p class="help-block">
                    <?php
                        if (form_error('password')==FALSE){
                            echo "비밀번호를 입력하세요.";
                        }else {
                            echo form_error('password');
                        }?>
                    </p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input03">비밀번호 확인</label>
                <div class="controls">
                    <input type="password" name="re_password" class="input-xlarge" id="input03" />
                    </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="email">이메일</label>
                <div class="controls">
                    <input type="text" name="email" class="input-xlarge" id="email" />
                </div>
            </div>
        </fieldset>
        
        <div><input type="submit" value="가입" class="btn btn-primary"/></div>
    </form>
</article>
    
</body>
</html>