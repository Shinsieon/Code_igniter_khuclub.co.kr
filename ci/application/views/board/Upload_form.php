<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
        $(document).ready(function() {
            $("input[type=file]").change(function(){
                var fileinput = document.getElementById("userfile");
                var files= fileInput.files;
                var file;
                for(var i =0; i< files.length; i++){
                    file = files[i];
                    alert(file.name);
                }
            });
        });
    </script>
</head>
<body>
<form method="post" action ="/ci/index.php/image/index" enctype='multipart/form-data'>
<input type="file" id ="userfile" name="files[]" multiple/>

<br /><br />

<input type="submit" value="upload" />

</form>
</body>
</html>

