<?
session_start();
include "../lib/conn.php"; 
$ulv = $_SESSION[ses_ulevel];

	if($ulv == '3'){
		echo("
			<script>
			location.href='./ticket/myticket_ad.php';
			</script>
		");
	};
?>

<!-- 이자리에 세션확인 로직 필요 -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival/관리자 페이지</title>
  <link rel="stylesheet" type="text/css" href="css/common.css">
  <!-- login css/script -->
  <link rel="stylesheet" type="text/css" href="css/admin_login.css">
</head>
<body>
  <div id="wraper">
    <section>
		<div class="loginform">
			<img src="./img/login_logo.png" alt="logo" ><br/>
			<h2>관리자 로그인</h2>
			<form name="login_form" action="login/login_form_admin_action.php" method="post" >
				<div class="input_line"><p class="text">아이디</p><input type="text" name="fuserid" id="fuserid" size="19"></div>
				<div class="input_line"><p class="text">비밀번호</p><input type="password" name="fpasswd" id="fpasswd" size="20"></div>
				<div class="login_btn"><input type="submit" name="submit" value="로그인"></div>
			</form>
		</div>
    </section>
    <footer>
        <?php include "lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>