<?php
  session_start();
  	if(!$_SESSION[history]){
	$_SESSION[history] = "../index.php";
	}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- login css/script -->
  <link rel="stylesheet" type="text/css" href="../css/login_form.css">
</head>
<body class="log_m1">
  <div id="wraper">
    <header>
    <nav>
	  <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	   </header>
    <section>
		<h2>로그인</h2>
		<h3>로그인이 필요한 서비스입니다. </h3>
		<div class="loginform">
			<form name="login_form" action="login_form_action.php" method="post" >
				<div class="input_line"><p class="text">아이디</p><input type="text" name="fuserid" id="fuserid" size="19"></div>
				<div class="input_line"><p class="text">비밀번호</p><input type="password" name="fpasswd" id="fpasswd" size="20"></div>
				<div class="input_line"><input type="submit" name="submit" value="로그인"></div>
			</form>
			<div class="input_line2"><a href="member_form.php">회원가입</a>&nbsp;|&nbsp;<a href="find_id.php">아이디 찾기</a>
			<!--&nbsp;|&nbsp;
			<a href="find_pw.php">비밀번호 찾기</a></div>-->
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>