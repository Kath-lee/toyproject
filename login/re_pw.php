<meta charset="utf-8">
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
	function validate(){
	//비밀번호
	var pwval = /^[a-zA-Z0-9]*$/;
	if(!pwval.test(document.re_pw.fpasswd.value)){window.alert('비밀번호는 최대 16자 대,소문자,숫자,특수기호만 입력가능합니다.'); return;}
	document.re_pw.submit();
	}
	</script>
</head>
<body>
  <div id="wraper">
    <header>
        <nav>
	  <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	</header>
    
    <section>
      <h2>회원 인증</h2>    
      <h3>회원 인증이 필요한 서비스입니다.<br/>안전한 작업을 위해 비밀번호를 입력해주세요.</h3>
      <div class="re_pw">
      	<p class="text">아이디</p><span><?echo $_SESSION[ses_uid];?></span><br/>	
      	<form name="re_pw" action="re_pw_action.php" method="post">
      	<div class="input_line"><p class="text">비밀번호</p><input type="password" name="fpasswd" id="fpasswd" size="20"></div>
      	<div class="input_line"><input type="button" name="button" value="회원 인증하기" onclick="javascript:validate();"></div>
      	</form>
      </div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>