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
		//빈문자열 검사
		if(document.find_id_form.fname.value == ""){window.alert('이름을 입력해주세요.');return;}
		if(document.find_id_form.femail.value == ""){window.alert('이메일을 입력해주세요.');return;}
	//이름
	var nameval = /^[0-9]*$/;
	if(nameval.test(document.find_id_form.fname.value)){window.alert('이름은 최대 10자까지 입력가능합니다'); return;}
	//이메일
	var emailval = /^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$/;
	if(!emailval.test(document.find_id_form.femail.value)){window.alert('이메일 형식에 맞지 않습니다.\nex) example@mail.com'); return;}
	document.find_id_form.submit();
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
    	<h2>아이디 찾기</h2>
     	<h3>가입시 작성한 정보로 아이디를 찾으실 수 있습니다.</h3>
		<div class="findid">
		<form name="find_id_form" action="find_id_action.php" method="post">
		<div class="input_line"><p>이름</p><input type="text" name="fname" id="fname" size="12" maxlength="10" ></div>
		<div class="input_line"><p>이메일</p><input type="email" name="femail" size="30" maxlength="30"></div>
		<span>가입시 작성한 이메일 주소를 입력해주세요.</span><br />
		<div class="input_line"><input type="button" name="button" value="아이디 찾기" onclick="javascript:validate();"></div>
		</form>
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>