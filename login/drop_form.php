<?php
  session_start();
	include "../lib/conn.php";
	$uid = $_SESSION['ses_uid'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- login css/script -->
  <link rel="stylesheet" type="text/css" href="../css/login_form.css">
  <script>
	function drop_mem(){
	//비밀번호 유효성 검사
	var pwval = /^[a-zA-Z0-9]*$/;
	if(!pwval.test(document.drop.fpasswd.value)){window.alert('비밀번호는 최대 16자 대,소문자,숫자,특수기호만 입력가능합니다.'); return;}
	document.drop.submit();
	}
	</script>
</head>
<body class="a_menu2">
  <div id="wraper">
    <header>
       <nav>
	  <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	 </header>
    <div class="clear"></div>
    <section class="tab3">  
    <ul id="tab">
      <li><a class="tab1" href="my_info.php">나의 정보</a></li>
      <li><a class="tab2" href="../ticket/myticket.php">나의 예약</a></li>
	  <li><a class="tab3" href="drop_form.php">회원 탈퇴</a></li>
    </ul>
    <div class="clear"></div>
    <div class="tab_content">
      <h2>회원 인증</h2>    
      <h3>회원 인증이 필요한 서비스입니다.<br/>안전한 작업을 위해 비밀번호를 입력해주세요.</h3>
      <div class="drop">
      	<p class="text">아이디</p><span><?echo $_SESSION[ses_uid];?></span><br/>	
      	<form name="drop" action="drop_action.php" method="post">
      	<div class="input_line"><p class="text">비밀번호</p><input type="password" name="fpasswd" id="fpasswd" size="20"></div>
		<span id="alert">※ 탈퇴후 계정 복구는 불가능합니다.<br />
		※ 예약하신 티켓이 있을 경우 탈퇴가 불가능합니다.<br /></span>
      	<div class="input_line"><input type="button" name="button" value="탈퇴하기" onclick="javascript:drop_mem();"></div>
      	</form>
      </div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>