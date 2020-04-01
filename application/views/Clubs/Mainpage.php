
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mainpage</title>
    <link rel= "stylesheet" href="/assets/bg_style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet">
    <script src="/assets/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src = "/assets/jquery.backstretch.min.js" ></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <div id="wrap" class="bg_wrap">
    
    <script>
    $(function(){
    $(".bg_wrap").backstretch(["/images/mainpage.jpg", "/images/khu3.jpg","/images/khu4.jpg",
    "/images/khu1.jpg"],{duration:3500, fade:750});
    });
    </script>
        <div class="bg_cover">
            <div class="main_title">
            <h1><strong>Evaluate and Look Around</strong></h1>
            <h4 class="silver">KHU CLUBS</h4>
            </div>
            <div class="btn_more">
                    <a href="https://jajudy.khu.ac.kr/" class="view_btn">VIEW</a>
                    <a href="Club/Evaluation" class="eval_Btn">EVALUATE</a>
            </div>
            <div class="ex">
                <p>View는 경희대학교 중앙동아리연합회 사이트로 연결됩니다.</p>
            </div>
        </div>
    </div>

</body>
</html>