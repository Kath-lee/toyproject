<?php
  session_start();
   include "../lib/conn.php";
   $ulv = $_SESSION[ses_ulevel];
   if($ulv !== '3'){
      echo("
         <script>
         window.alert('관리자가 아니면 사용하실 수 없습니다.');
         location.href='../index.php';
         </script>
      ");
   };

	$sql = "select * from member where level ='3'";
	$result = mysql_query($sql,$connect);
	$memarr = mysql_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival/관리자 페이지</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- index css/script -->
  <link rel="stylesheet" type="text/css" href="../css/modify_pw.css">
</head>
<body class="log_m2">
  <div id="wraper">
    <header>
      <?php include "../lib/top_login2.php"; ?>

	  <script>
		function re_pw() {
		//빈문자열 검사
		if(document.modify_admin_pw_form.fpasswd.value == ""){window.alert('비밀번호를 입력해주세요.');return;}
		//비밀번호
		var pwval = /^[!@#%&*_a-z0-9-]{6,}$/;//소문자+숫자+특수문자 6~16자?
		if(!pwval.test(document.modify_admin_pw_form.fpasswd.value)){window.alert('비밀번호는 6~16자 소문자,숫자,특수기호만 입력가능합니다.'); return;}
		//비번 일치
		if(document.modify_admin_pw_form.fpasswd.value != document.modify_admin_pw_form.fpasswd_re.value){window.alert('비밀번호가 일치하지 않습니다.'); return;}

		document.modify_admin_pw_form.submit();
		}
  </script>

    </header>
    <nav>
      <?php include "../lib/top_menu2.php"; ?>
	  <div class="clear"></div>
    </nav>
    <section>
    	<h2>관리자 비밀번호 변경</h2>
    	<h3>비밀번호 수정 후 [변경하기]버튼을 선택하시면, 비밀번호가 변경됩니다.</h3>
    	<div class="modifyform">
    		<form name="modify_admin_pw_form" action="modify_admin_pw_action.php" method="post">
    			<p class="text">아이디</p><span><?echo $memarr[m_id];?></span><br/>
    			<div class="input_line"><p class="text">비밀번호 변경</p><input type="password" name="fpasswd" id="fpasswd" size="20"></div>
    			<div class="input_line"><p class="text">비밀번호 확인</p><input type="password" name="fpasswd_re" id="fpasswd_re" size="20"></div>
    			<div class="subbtn">
    				<input type="button" name="button" name="cancel" value="취소하기" onclick="javascript:history.go(-1);" >
    			</div><div class="mainbtn">
    				<input type="button" name="button" value="변경하기" onclick="javascript:re_pw();">
    			</div>
    		</form>
    	</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>