<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:800+Coding&display=swap" rel="stylesheet"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel= "stylesheet" href="/assets/ranking.css" type="text/css">
    <script src="/assets/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="/assets/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Ranking</title>
<script>
    google.load("visualization", "1.1", {'packages': ['corechart']});
    google.setOnLoadCallback(drawchart);
    function drawchart(data){
        if(data=='bar'){                   
                var bar_data = [['이름','평점'],
                <?php 
                        foreach($allrank as $ar){ 
                            echo '[' . '"' . $ar->c_name . '"' . ',' . $ar->average.'],';
                       }?>];
                var bar_options = {
                    title : '평점 순위',
                                height : 300,
                                width : $('.header').width(),
                                fontSize : 10
                                };
                var bar_chart = new google.visualization.ColumnChart(document.getElementById('rest_rank'));
                bar_chart.draw(google.visualization.arrayToDataTable(bar_data), bar_options);
                
        }else if(data=='pie'){
            var pie_data = [['이름','개수'],
                <?php
                        foreach($get_all_review_count as $rc){
                            echo '[' . '"' . $rc->c_name . '"' . ',' . $rc->ct .'],';

                        }?>];
                var pie_options = {
                    title : '후기수 순위',
                                height : 300,
                                width : $('.header').width(),
                                fontSize : 10,
                                piehole : 0.4,
                                };
                var Pie_chart = new google.visualization.PieChart(document.getElementById('rest_rank'));
                Pie_chart.draw(google.visualization.arrayToDataTable(pie_data), pie_options);
        }
            };
        $(function() {
            $('#search_btn').click(function(){
                var search_word = $('#q').val();
                if(search_word == ''){
                    alert("검색어를 입력해주세요");
                }else{
                    location.href="/club/ranking/q/"+search_word;
                    $('#q').val() = search_word;
                }
            });
            result = <?php if(@$this -> session -> userdata('logged_in')==TRUE)echo 1;else echo 0;?>;
        var user = '<?php echo $this -> session -> userdata('username');?>';
    
            if(result==1){
            $('.p_user').text(user+"님");
            $('#usericon').css('color', '#ee6e74');
            $('.loginicon').click(function(e){
                e.stopPropagation();
                $('.login_detail').fadeToggle();
            });
            $(document).click(function(e) {
                $('.login_detail').hide();
        });
        }else{
            $('.loginicon').on('click', function(e) {
            e.stopPropagation();
            $('.login_form').slideToggle();
        });
        $(document).click(function(e) {
            if(!$('.login_form').has(e.target).length)
                $('.login_form').hide();
        });
        $('#usericon').css('color', 'white');
        }
        $('#menuicon').click(function(e) {
            e.stopPropagation();
            $('.menu_detail').fadeToggle();
        });
        $(document).click(function(e) {
                $('.menu_detail').hide();
        });
            var cnum = 1;
            var i = 1;
            
            $('#twice').children('li:eq(0)').on('click',function(event) {
                cnum = 1;
                $('#score_tab').css('color', '#906eee');
                $('#review_tab').css('color', '#eee');
                $('.club_rate').fadeIn();
                $('.club_count').fadeOut();
                drawchart('bar');
            });
            $('#twice').children('li:eq(1)').on('click',function(event){
                cnum = 2;
                $('#review_tab').css('color', '#906eee');
                $('#score_tab').css('color', '#eee');
                $('.club_count').fadeIn();
                $('.club_rate').fadeOut();
                drawchart('pie');
                
            });
            $('#drop_down').click(function(){
                i++;
                if(i%2==0){
                    if(cnum == 1){
                $('.header').animate({height: '900px'});
                drawchart('bar');
                    }else if(cnum == 2){
                        $('.header').animate({height: '900px'});
                        drawchart('pie');
                    }
                }else{
                    $('.header').animate({height: '540px'});
                }
            });
        });
            
    </script>
    
</head>
<body>
<div id="wrap" class="basic">
<div id="container">
    <div id="cont">
    <div class="menu-bar">
    <ul class="menu">
    <li id="home" style="left:0;"><a href="/club"><i class="material-icons">home</i></a></li>
    <li><p class="p_user" style="font-size:20px;color:white;position:relative;"></p></li>
        <li><a class="loginicon" style="color:#ee6e74;cursor:pointer;"><i id="usericon"class="material-icons m">person_pin</i></a>
        <ul class="login_detail">
                <li><a href="/club/mypage">마이페이지</a></li>
                <li><a href="/admin/admain/<?php echo $this -> session -> userdata('dongcode');?>">관리페이지</a></li>
                <li id="logout"><a href="/admin/logout">로그 아웃</a></li>
            </ul>
    </li>
        <li><a class="menuicon" style="cursor:pointer;"><i id="menuicon" class="material-icons m">menu</i></a>
        <ul class="menu_detail">
            <li><a href="/club/ranking">랭킹 보기</a></li>
            <li><a href="https://jajudy.khu.ac.kr/">중앙동아리연합회</a></li>
             <li><a href="/admin/register">계정 신청</a></li>
            
        </ul>
        </li>
    </ul>
</div>
<div class="login_form">
    <div id="form_area">
<?php
    echo form_open('admin/login', 'id="auth_login"');
?>
        <legend style="margin-top: 20px;">로그인</legend>
        <div class="input_field" >
        <div class="controls" style="margin-bottom:40px;">
            <input type="radio" class="radio" name="cradio" value="clubhead">
            <label>동아리장</label>
            <input type="radio" class="radio" name="cradio" value="clubmember" checked="checked">
            <label>동아리원</label>
            </div>
            <div class="controls">
                <input type="text" class="input-xlarge" id="input1" name="username"
                placeholder= "STUDENTID" value="<?php echo set_value('username'); ?>" autocomplete="off"
                    required/>
            </div>
            <div class="controls">
            <input type="password" class="input-xlarge" id="input2" name="password"
                    placeholder= "Password" value="<?php echo set_value('password'); ?>" required/>
            </div>
            <div class="form_actions">
                <button type="submit" class="login_btn">확인</button>
            </div>
    </form>
        </div>
    </div>
    
        </div>
    <div class="header" id="header">
        <div id="header_wrap">
        <div class="my_main">
            <div class="running_tab">
                <ul id="twice">
                    <li><a id="score_tab" style="cursor:pointer;">평점 순</a></li>
                    <li><a id="review_tab" style="cursor:pointer;">후기 수 多</a></li>
                </ul>
            </div>
            <div id="wrap_rank">
            <div class="club_rate">
                <div class="wrap_clubs">
                    <?php
                    $i = 0;
                        foreach($rank as $rk){
                        $i++;
                        $name = $rk->c_name;
                        $score = $rk->average;
                        $pic_path = $rk->pic_path;
                        $id = $rk->info_id;
                    ?>
                    <div class="item" style="cursor:pointer;" onclick="location.href='/club/view/<?=$id?>';">
                        <h1><?=$i?></h1>
                        <img src="<?=$pic_path?>"/>
                        <div class="score_field">
                            <span id="name"><?=$name?>
                            <span id="score">
                            <?php for($p=1; $p<=$score;$p++){ ?>
                            <i class="material-icons r">star</i><?php } echo round($score,1);?></span></span>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="club_count">
                <div class="wrap_clubs">
                    <?php $i = 0;
                        foreach($review_count as $rc){
                        $i++;
                        $name = $rc->c_name;
                        $score = $rc->ct;
                        $pic_path = $rc->pic_path;
                        $id = $rc->info_id;
                        ?>
                    <div class="item" style="cursor:pointer;" onclick="location.href='/club/view/<?=$id?>';">
                        <h1><?=$i?></h1>
                        <img src="<?=$pic_path?>">
                        <div class="score_field">
                            <span id="name"><?=$name?></span>
                            <span id="score"><?=$score?></span>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
                        </div>
            
        </div>
        <div id="rest_rank">
            </div>
       
                        </div>
    </div> 
    <div class="rank_box">
        <i class="material-icons" id="drop_down" title="랭킹 전체 보기">expand_more</i>
        </div>
    <div class="search_box">
        <fieldset>
        <input type="search" placeholder="검색" name="search_word" id="q"
        autocomplete="off" required/>
        <button type="button" id="search_btn"><i class="material-icons"
        style="color:white;">search</i></fieldset>
    </div>
        
    <div id="content">
        <div class="sub_title">
            <span>최근 후기</span>
            <span id="counts"><i class="material-icons a" >arrow_right</i>총 <?php echo $allcount;?>개의 후기가 있습니다.</span>
        </div>
        <table cellspacing="0" class="list">
            <thead>
            
                <tr>
                    <th>번호</th>
                    <th>후기</th>
                    <th>글쓴이,날짜</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lists as $ls){
                    $id= $ls->id;
                    $title=$ls->r_name;
                    $review= $ls->c_review;
                    $writer = $ls->username;
                    $date = $ls->c_dt;
                    $score = $ls->c_score;
                    $info_id = $ls->info_id;
                ?>
                <tr>
                    <td class="ac_num"><?=$id?></td>
                    <td class="title"><a href="/club/view/<?=$info_id?>"><?=$title?></a>
                        <?php for($i=1; $i<=$score;$i++){ ?>
                        <i class="material-icons r">star</i><?php }?><?=$score?></div>
                        <br><?=$review?>
                    </td>
                    <td class="num"><?=$writer?><br><?=date('Y-m-d',strtotime($date))?></td>
                </tr>
              
                <?php } ?>
                <tr>
                    <td colspan="3"> <div class="text-center">
        <ul class="pagination">
            <li><?php echo $links;?></li>
        </ul>
    </div> </td>
                </tr>
            </tbody>
            
        </table>
        
    </div>
</div>
   
    <div class="footer">
    
        <span class="contact" style="color:white;">DEVELOPER_
        contact email : coolguysiun@gmail.com</span>
</div>
</div>
</div>

</body>
</html>