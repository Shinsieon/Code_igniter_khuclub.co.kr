<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="/assets/bootstrap.min.css" type="text/css">
    <link rel= "stylesheet" href="/assets/bootstrap.min.js" type="text/css">
    <link rel= "stylesheet" href="/assets/admin.css" type="text/css">
    <title>modify</title>
</head>
<body>
   <?php foreach($views as $vs){ 
       echo form_open('/Admin/modify/'.$vs->id); ?>
   
        <div class="form-group">
            <h1><?=$vs->c_name?></h1>
        <label for="content">소개 : </label>
            <input type="text" name="club_content" class="form-control" id="content" rows="5"
            value = "<?=$vs->c_cont?>">
        </div>
        <div class="form-group">
            <label for="picpath">사진경로 : </label>
            <input name="club_picpath" class="form-control" id="picpath"
            value="<?=$vs->pic_path?>"/> 
        </div>
        <div class="form-actions"> 
            <button type="sumbit" class="btn btn-primary">SAVE</button>
        </div>
   <?php } ?>

    
</body>
</html>