<?php
  session_start();
include "../lib/conn.php";

	$no = $_GET[no];
	$uid = $_SESSION[ses_uid];
		$ulv = $_SESSION[ses_ulevel];
	if($ulv !== '3'){
		echo("
			<script>
			window.alert('관리자가 아니면 사용하실 수 없습니다.');
			location.href='../index.php';
			</script>
		");
	};
?>	

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- festival_add css/script -->
  <link rel="stylesheet" type="text/css" href="../css/festival_add.css">
</head>
<body class="a_menu1">
  <div id="wraper">
    <header>
      <?php include "../lib/top_login2.php"; ?>
    </header>
    <nav>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	<div class="clear"></div>
    <section>
		<h2>페스티벌 삭제하기</h2>
		<h3><span><?=$no?></span>회 페스티벌을 삭제합니다. <br/>삭제 후 복구할 수 없으니 주의해주세요.</h3>
		<h3>기존에 예매한 목록은 별도 삭제되지 않습니다..</h3>
		<div class="reservation">
			<form name='reserv_del_form' method='post' action='reserv_del1.php'>
				<input type='hidden' name='delno' value='<?=$no?>'></input>
				<p class="line_title">비밀번호</p><input type='password' name='password' value='' placeholder="등록 시 사용했던 비밀번호를 입력해주세요"></input><br/>
				<div class="subbtn">
					<input type="button" name="button" name="cancel" value="수정 취소하기" onclick="javascript:history.go(-1);" >
				</div>
				<div class="mainbtn">
					<input type='submit' value='삭제하기'>
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