<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="/portfolio/assets/mainpage.css" type="text/css">
    <link rel= "stylesheet" href="/portfolio/assets/jquery-jvectormap-2.0.5.css" type="text/css">
    
    <link href="https://fonts.googleapis.com/css?family=Oxanium|PT+Sans&display=swap" rel="stylesheet">
    <script src="/assets/jquery-3.4.1.min.js" type="text/javascript"></script>
    <title>Document</title>
    <script>
var speed = 700;    // 스크롤 스피드 수치로 사용할 변수 
     function scrolling(obj){
         if (!obj){  // 예외처리, 현재는 기능적으로 필요한 부분은 아님, 관례적 사용
             $('html, body').animate({scrollTop:0},speed);
         }else{
             var posTop = $(obj).offset().top;   // posTop = 매개변수로 들어온 컨텐츠 obj 의 offset().top - 네비게이션 높이
             $('html, body').animate({scrollTop:posTop}, speed ) // body의 스크롤이동 : posTop
         }
     }
     $(function() {
        $("ul li a").click(function(){
         var direction = $(this).attr("href");   // direction = 클릭한 요소의 href 속성
         scrolling( direction ); // direction 을 인자로 함수 실행
         return false;   // 본래 이벤트 방지 
     });
     var posY;
        $('.country').click(function(e) {
                $.ajax({
                    url: 'Mainpage/showpictures',
                    type: 'GET',
                    data: {"value" : $(this).attr('value')},
                    dataType: "html",
                    complete : function(xhr, textStatus){
                        if(textStatus == 'success'){
                            $('#pop-container').html(xhr.responseText);
                        }
                    }
                });
            
            $('.popup').fadeIn();
        });
        $('.popup').click(function(e) {
            $('.popup').fadeOut();
        });
     });
     
</script>
</head>
<body>
<div class="popup">
    <div id="pop-container">
    </div>
</div>
<div id="wrap">
    <div class="container">
        <div class="object-box">
            <div class="navbar">
                <span id="myname">SHINSIEON</span>
            </div>
            <div class="category">
            <ul>
                <li><a href="#develop">개발</a></li>
                <li><a href="#journey">여행</a></li>
                <li><a href="#club">동아리</a></li>
                <li><a href="#license">자격증</a></li>
            </ul>
            </div>
        </div>
        <div class="object-box" style="min-height:600px; text-align:center;">
            <div id="myprofile">
                <div id="profilepic">
                    <img style="height:200px;width:200px;"src="/portfolio/images/profile.jpg"></img>
                </div>
                <div id="title">
                    <h5>SHIN SIE ON</h5>
                    <span>DEVELOP & DATA-MINING<br>
                    <strong>
                        1997.07.28<br>
                        coolguysiun@gmail.com
                    </strong>
                    </span>
                </div>
                <div id="subtitle">
                </div> 
            </div>
            <div id="my_com">
            <span>어제의 나보다 성장하는 오늘의 내가 되길</span>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="develop" class="object-box" style="height:100%;">
            <div class="index">
                <div class="table">
                    <h4>Done Projects</h4>
                        <a href="http://khuclub.co.kr">경희대학교 중앙동아리 평가 사이트</a>
                </div>
            </div>
            <div class="img">
                    <img style="width:100%;height:100%;"src="/portfolio/images/khu41.jpg">
            </div>
        </div>
    </div>
    <div style="text-align:center;" class="container">
        
        <div id="journey" class="object-box">
        <h2>TRAVEL MAP</h2>
            <img style="width:100%;height:600px"src="/portfolio/images/worldmap.png">
            <div class="country-box">
            <button class="country" value="india"  style="background-color: #FFBC42;"id="india_btn">INDIA</button>
            <button class="country" value="jeju" style="background-color: #EC7357;"id="JEJU_btn">JEJU</button>
            <button class="country" value="japan" style="background-color: #754F44;"id="JAPAN_btn">JAPAN</button>
            <button class="country" value="philippines" style="background-color: #FDD692;"id="PHILIPPINES_btn">PHILIPPINES</button>
            <button class="country" value="cambodia" style="background-color: #0B9ED9;"id="CAMBODIA_btn">CAMBODIA</button>
            <button class="country" value="taiwan" style="background-color: #64CD3C;"id="TAIWAN_btn">TAIWAN</button>
            </div>
            
        </div>
    </div>
    <div class="container">
        <div id="club" class="object-box">
            <div class="club-column" style="border-top:1px solid #FFBC42;border-bottom:1px solid #FFBC42;">
                <div class="club_title" style="background-color:#FFBC42">
                    <h4>연극 동아리</h4>
                </div>
                <h4>경희극회</h4>
                <p>본회는 역사적으로 부여받은 대학인의 창의정신을 기반으로 하여 냉철한 시대적 사회, 문화, 예술 발전 법칙에 기여함을 내용으로 하고, 대학인으로서 선진적인 형식상의 다변화와 실험정신을 가진 연극 전반활동을 수행함을 그 목적으로 한다.</p>
            </div>
            <div class="club-column" style="border-top:1px solid #EC7357;border-bottom:1px solid #EC7357;">
            <div class="club_title" style="background-color:#EC7357">
                    <h4>PPT 발표 동아리</h4>
                </div>
            <h4>언론지대</h4>
                <p>산업공학 전공인의 모임으로 언론보도를 보다 적극적으로 비교, 검토하고 젊은이의 입장에서 보다 건전하게 이해하자는 취지아래 신문, 잡지, 뉴스, 책자 등에서 관심분야를 발췌하여 세미나를 갖는 동아리입니다.</p>
            </div>
            <div class="club-column" style="border-top:1px solid #754F44;border-bottom:1px solid #754F44;">
            <div class="club_title" style="background-color:#754F44">
                    <h4>동물 봉사 동아리</h4>
                </div>
            <h4>보금자리</h4>
                <p>동물을 사랑하는 사람들끼리 모여 유기견보호소 봉사활동과 같은 실질적인 실천활동을 통해 동물보호에 대한 의식을 함양하고, 친목도모를 하는 것을 목적으로 한다.</p>
            
            </div>
            <div class="club-column" style="border-top:1px solid #FDD692;border-bottom:1px solid #FDD692;">
            <div class="club_title" style="background-color:#FDD692">
                    <h4>배드민턴 동아리</h4>
                </div>
            <h4>하이클리어</h4>
                <p>본회의 모임은 배드민턴 실력향상과 건강관리는 물론 배드민턴을 통해 친목을 도모하고 교제를 나누며 회원간의 상호협력을 목적으로 한다</p>
            
            </div>
        </div>
    </div>
    <div class="container">
        <div id="license" class="object-box">
        </div>
    </div>
    </div>
</div>


</body>
</html>