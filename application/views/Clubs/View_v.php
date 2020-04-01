<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Sunflower:300&display=swap" rel="stylesheet">
    <link rel= "stylesheet" href="/assets/View.css" type="text/css">
    <script src="/assets/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="/assets/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <title>evaluation</title>
  
</head>

<body>
<div id="wrap">
<div class="container">
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
        <legend style="margin-top: 20px;text-align:center;">로그인</legend>
        <div class="input_field">
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
<div class="header">

    <?php 
    if($average){
      foreach($average as $av){
        $avscore = round($av->average,1);
      }
    }else{
      $avscore = "후기 정보가 없습니다";
    }

foreach($lists as $lt){
        $club_title = $lt->c_name;
        $club_dept = $lt->c_dept;
        $club_content= $lt->c_cont; ?>
    <img class="club-img" src="<?php echo $lt->pic_path; }?>">
</div>
<div class="wrap">
<div class="clubinfo">
    <button class="button" id="review_btn" 
    data-toggle="modal"
    style="cursor:pointer;">후기 남기기</button>
    <h3><?=$club_title?></h3>
    <h4><?=$club_dept?></h4>
    <p>평점 : <?=$avscore?></p>
    <p><?=$club_content?></p>
</div>
<div class="section">
  <div class="static_field">
  <h4 id="nulltext"></h4>
    <div id="gender">
      
    </div>
    <div id="dept">
    </div>
  </div>
</div>


<div class="section">
  <div class="photo" id="_MainPhotoArea">
    <div class="title_area">
      <h4 style="font-size:20px;">포토</h4>
    </div>
    <div class="viewer">
      <div class="viewer_img">
      <?php $i = 0; 
      if(count($file_list)>0){
        foreach($file_list as $fs){
  $file_path[$i] = $fs['path'];
  ?>
        <img class="mySlides" src="<?php echo $file_path[$i];$i++;?>"> <?php }
        }else{
          echo"이미지가 없습니다"; 
        }
      ?>
      </div>
      <a class="prevbtn" onclick="plusDivs(-1)"
      title="이전사진"><i class="material-icons arrow">keyboard_arrow_left</i></a>
      <a class="nextbtn" onclick="plusDivs(+1)"
      title="다음사진"><i class="material-icons arrow">keyboard_arrow_right</i></a>
    </div>
  </div>
</div>
<div class="section">
<?php
 if(!empty($reviews)){
  foreach($reviews as $rv){
    $id = $rv->id;
    $username = $rv->username;
    $reviews = $rv->c_review;
    $score = $rv->c_score;
    $date = $rv->c_dt;
    $tu = $rv->recommend;
    $td = $rv->blame;
    //echo $average;?>
    <div class="art">
      <div class="score">
        <p class="username"><?=$username?></p><?php for($i=1;$i<=$score;$i++){ ?>
        <i class="material-icons c">star</i><?php } ?>
        <p class="date" style="margin-top:15px;color:#999;"><?=date('Y-m-d', strtotime($date))?></p>
        
      </div>
      <div class="reviews">
        
        <i id="delete_icon" class="material-icons md-24">delete</i>
        <?php echo form_open('/club/delete_review', 'id="del_form"');?>
        <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
        <input type="hidden" class="review_id" name="review_id" value="<?=$id?>"/>
        <input type="hidden" name="board_id" value="<?php echo $this->uri->segment(3);?>"/>
        <input type="passord" style="width:40%;" id="password" name="password" class="delete" placeholder="password" required/>
        <input type="submit" class="del" value="삭제"></input>
        <p class="text"><?=$reviews?></p>
        <a class="singo" vals="<?=$id?>" style="cursor:pointer;color:#999;font-size:12px;margin-top:0;">신고</a>
        <span><?=$rv->blame?></span> 
        <a class="recommend" vals="<?=$id?>" style="cursor:pointer;color:#999;font-size:12px;margin-top:0;">추천  </a>
        <span><?=$rv->recommend?></span> 
        </form>
        <input type="button" value="댓글" class="dat">
        <?php echo form_open('/club/addreview'); ?>

        <div class="comment_field">
          <div class="input_comment">
          <input type="hidden" class="review_id" name="review_id" value="<?=$id?>"/>
        <input type="hidden" name="info_id" value="<?php echo $this->uri->segment(3);?>"/>
        <label>이름 : </label><input type="text" name="name" required>
        <label>암호 : </label><input type="password" name="password" required><br>
        <label>내용 : </label><input style="width:40%;" type="text" name="content">
        <input type="submit" class="add_btn" value="입력">
        </form>
        <br><span style="color:red;">실명이 아닌 닉네임을 입력해주세요.</span>

        </div>
        <div class="show_comment">
        </div>

        </div>
      </div></div>
      <?php } }else echo "후기 데이터가 없습니다."; ?>
</div>
<div class="text-center">
  <ul class="pagination">
      <li><?php echo $links;?></li>
  </ul>
</div>
        </div>

<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">후기 작성</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo form_open('/club/insert_review');?>
        <fieldset>
        <h2><?=$club_title?></h2>
        <input type="text" autocomplete="off" id="username" name="username" placeholder="닉네임을 적어주세요" maxlength="10" required/><br>
        <input type="text" autocomplete="off" id="password" name="password" placeholder="비밀번호" required />
        <br></br>
        별점 : <select name="score" id="score">
        <option value="1" >★</option>
        <option value="2" >★★</option>
        <option value="3" >★★★</option>
        <option value="4" >★★★★</option>
        <option value="5" >★★★★★</option>
        </select>
        <br></br>
        <input type="textarea" name="review" autocomplete="off" 
        id="review_area" style="resize:none; width:100%;height:200px;"required>
        <input type="hidden" 
        id="cname" name="cname" value="<?=$club_title?>"/>
        <input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" 
        id="review_add" class="btn btn-primary">Save changes</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delete_modal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">비밀번호를 입력해주세요</h4>
        </div>
        <div class="modal-body">
          <?php echo form_open('club/comment_delete'); ?>
            <input type="password" name="password" id="password" required>
            <input type="hidden" name="review_id" class="review_id" value="2">
        </div>
        <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="확인">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
    google.load("visualization", "1.1", {'packages': ['corechart']});
    google.setOnLoadCallback(drawchart);
  function drawchart(){
    var male = <?php echo $male_count;?>;
    var female = <?php echo $female_count;?>;
    if(male==0 || female==0){
      document.getElementById('nulltext').innerHTML = "회원 정보가 없습니다";
    }else{
      document.getElementById('nulltext').innerHTML = "총원 : " +(male+female);
    
    var pie_data = [['성비','인원수'],
    ['남', male],
    ['여', female]];
         var pie_options = {
        title : '남녀 성비',
        height : 300,
        titlePosition:'center',
        width : $('.header').width()/2,
        fontSize : 20,
        colors: ['#86C8FC','#FF7E5A'],
        legend: {position: 'bottom', fontsize: 15,alignment: 'center'},
        };
        var pie_chart = new google.visualization.PieChart(document.getElementById('gender'));
        pie_chart.draw(google.visualization.arrayToDataTable(pie_data), pie_options);
  
  var bar_data = [['학과','비율'],
  <?php 
    foreach($dept_count as $dc){ 
    echo '[' . '"' . $dc->department . '"' . ',' . $dc->ct.'],';
   }?>];
  var bar_options = {
        title : '학과 비율',
        titleTextStyle: {
          fontSize:20
        },
        height : 300,
        width : $('.header').width()/2,
        fontSize : 10,
        colors: ['#86C8FC','#FF7E5A'],
        legend: {position: 'none'},
        bar: {groupWidth: "95%"},
        hAxis: {
          fontSize:10,
          minvalue: 0,
          ticks: [0, .2, .4, .6, .8, 1]
        }
        };

 var bar_chart = new google.visualization.BarChart(document.getElementById('dept'));
 bar_chart.draw(google.visualization.arrayToDataTable(bar_data), bar_options);
    }
  }
  var count = <?php echo count($file_list);?>;
if(count>0){
  var slideIndex = 1;
  showDivs(slideIndex);
  function plusDivs(n) {
    showDivs(slideIndex += n);
  }    
  function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if(n>x.length) {slideIndex = 1}
    if(n<1) {slideIndex = x.length};
    for(i=0; i< x.length; i++){
      x[i].style.display ="none";
    }
    x[slideIndex-1].style.display = "block";
  }
}
    result = <?php if(@$this -> session -> userdata('logged_in')==TRUE)echo 1;else echo 0;?>;
    var user = '<?php echo $this -> session -> userdata('username');?>';
    var dong = '<?php echo $this->session->userdata('dongcode');?>';
    var dongcode = <?php echo $this->uri->segment(3);?>;
    var studentid = '<?php echo $this->session->userdata('studentid');?>';
    
    $(document).ready(function() {
      $(document).on('click','.comment_delete',function() {
        $('#delete_modal').modal();
        
        $('.modal-body .review_id').val($(this).attr('vals'));
      });
      $('.dat').click(function() {
        var dat_index = $('.dat').index(this);
        $(".dat:eq(" + dat_index + ")").next().find('.comment_field').toggle();
        $.ajax({
          url: '/club/showreview',
          type: 'GET',
          data: {
            "info_id" : dongcode,
            "review_id" : $(".dat:eq(" + dat_index + ")").next().find('.review_id').val(),
            "csrf_token" : $('#csrf_token').val(),
          },
          dataType: "html",
          complete : function(xhr, textStatus){
            if(textStatus == 'success'){
              if(xhr.responseText == 2000){
              }
              else{
              $(".dat:eq(" + dat_index + ")").next().find('.show_comment').html(xhr.responseText);
              }
            }else alert(error_log);
          }
        });
      });
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
        $('#review_btn').click(function() {
            $.ajax({
              url: "/club/writercheck",
              type: "GET",
              data: {
                "studentid": studentid,
                "csrf_token" : $('#csrf_token').val(),
                "info_id": <?php echo $this->uri->segment(3);?>
              },
              dataType:"text",
              complete: function(xhr, textStatus){
                if(textStatus == 'success'){
                  if(xhr.responseText == 3000){
                    alert("해당 동아리원이 아닙니다. 동아리를 추가 등록해주세요");
                  }else if(xhr.responseText == 1000){
                    $('#mymodal').modal('show');
                  }
                }
              }
            });
          });
      }else{
        $('#review_btn').click(function() {
        alert("후기 남기실 권한이 없습니다. 로그인 해주세요");
        });
        $('.loginicon').on('click', function(e) {
            e.stopPropagation();
            $('.login_form').slideToggle();
        });
        $(document).click(function(e) {
          if(!$('.login_form').has(e.target).length)
                $('.login_form').hide();
        });
      }
      $('#menuicon').click(function(e) {
            e.stopPropagation();
            $('.menu_detail').fadeToggle();
        });
        $(document).click(function(e) {
                $('.menu_detail').hide();
        });
      $('.singo').click(function(e) {
        var result = confirm('해당 댓글을 신고하시겠습니끼?');
        if(result){
          var act = "/club/comment_singo";
          $('#del_form .review_id').val($(this).attr('vals'));
          $('#del_form').attr('action',act).submit();
        }else{

        }
      });

      $('.recommend').click(function() {
        var result = confirm('해당 댓글을 추천하시겠습니까?');
        if(result) {
          var act = "/club/comment_recommend";
          $('#del_form .review_id').val($(this).attr('vals'));
          $('#del_form').attr('action', act).submit();
        }else{

        }
      });
        $('#button').click(function() {
            $('#testModal').modal('show');
        });
          $('i').click(function() {
            var index = $('i').index(this);
            $("i:eq(" + index + ")").next().find('input').toggle(function(){
              
            });
            });
        });
    </script>
</html>