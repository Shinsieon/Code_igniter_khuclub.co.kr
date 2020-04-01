<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel= "stylesheet" href="/assets/login.css" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>adregister</title>
</head>
<body>
<div class="wrapper fadeInDown">
<div id="formContent">
<article id="board_area">
<?php
    echo form_open('admin/adregister', 'id="auth_login"');
    echo validation_errors();
?>
        <legend>동아리장 계정신청</legend>
        <div class="input_field">
            <div class="controls">
            <select class="form-control" name="club">
        <?php foreach($club as $cl){?>
            <option value="<?=$cl->id?>"><?=$cl->c_name?></option>
        <?php } ?>
        </select>
            <input type="text" class="input-xlarge" id="input1" name="headid" placeholder= "학번" autocomplete="off" required/>
            <input type="password" id="input2" name="password" placeholder= "비밀번호" required/>
            <input type="password" name="passconf" placeholder="비밀번호 확인">
            
            <input type="email"  id="input2" name="email" autocomplete="off" placeholder= "이메일" required/>
            <input type="text" class="input-xlarge" id="input2" name="headname" autocomplete="off"  placeholder= "이름" required/>
            <select class="form-control" name="department">
            <?php foreach($dept as $dp){ ?>
        <option value="<?=$dp->dept?>"><?=$dp->dept?>
            <?php } ?>
        </select><p><?php echo validation_errors();?></p>    
        </div>
            <div class="form_actions">
                <input type="submit" class="btn btn-primary" value="등록">
            </div>
        </div>
        </form>
</article>
</body>
</html>

 