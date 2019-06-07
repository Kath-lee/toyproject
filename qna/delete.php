<?php
 session_start();
 $uid = $_SESSION[ses_uid];

	include "../lib/conn.php";

	if(!$uid){
	echo("
	<script>
		alert('로그인 하셔야 합니다.');
		location.replace('login_form.php');
	</script>
	");
 };

 //$_GET['bno']이 있어야만 글삭제가 가능함.
	if(isset($_GET['num'])) {
		$num = $_GET['num'];
	}

	$del_sql = "select * from qna where num = '$num'";
	$del_result = mysql_query($del_sql, $connect);
	$del_array = mysql_fetch_array($del_result);
	$del_subject = $del_array[subject]; 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <link rel="stylesheet" type="text/css" href="../css/qna_delete_form.css">
 <script>
			function check_input(){
				if(!document.board_form.password.value){
					alert("비밀번호를 입력하세요");
					document.board_form.password.focus();
					return;
				}else{
					document.board_form.submit();
				}
				if(document.board_form.password.value){
					confirm("정말로 삭제하시겠습니까? \n작성된 글과 답글이 전부 삭제됩니다.");
					document.board_form.password.focus();
					return;
				}else{
					document.board_form.submit();
				}
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
		<h2>페스티벌 문의</h2>
		<h3>여러분의 궁금증을 풀어드립니다!</h3><br/><br/>
		<div class="delete_form">
			<form action="./delete_update.php" method="post" name="board_form">
					<?php
						if(isset($num)) {
							echo '<input type="hidden" name="num" value="' . $num . '">';
						}
					?>
				<input type="hidden" name="num" value="<?php echo $num?>">

					<p class="text">제목</p><span><?php echo $del_subject?></span><br/>
						<div class="input_line"><p class="text">비밀번호</p><input type="password" name="password"></div>
					<div class="subbtn">
							<input type="button" name="button" name="cancel" value="취소하기" onclick="javascript:history.go(-1);" >
					</div><div class="mainbtn">
							<input type="button" name="button" value="삭제하기" onclick="check_input()">
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