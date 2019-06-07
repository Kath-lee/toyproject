<?php
 session_start();
$uid = $_SESSION[ses_uid];

 include "../lib/conn.php";

if(!$uid){
	echo("
	<script>
		alert('로그인 하셔야 합니다.');
		location.replace('../login/login_form.php');
	</script>
	");
 };

 //$_GET['bno']이 있어야만 글삭제가 가능함.
	if(isset($_GET['no'])) {
		$no = $_GET['no'];
	}

	$del_sql = "select * from review where no = '$no'";
	$del_result = mysql_query($del_sql, $connect);
	$del_array = mysql_fetch_array($del_result);
	$del_subject = $del_array[subject];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <title>Poltfolio-Uranos Festival/관리자 페이지</title>

  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <link rel="stylesheet" type="text/css" href="../css/review_delete_form.css">
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
					confirm("정말로 삭제하시겠습니까? \n작성된 글이 전부 삭제됩니다.");
					document.board_form.password.focus();
					return;
				}else{
					document.board_form.submit();
				}
			}
  </script>
</head>
<body class="a_menu3">
  <div id="wraper">
    <header>
    <nav>
	  <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
	  </header>
    </nav>
	<div class="clear"></div>
    <section class="tab2">	
		<div class="clear"></div>
		<div class="tab_content">
			<h2>후기 게시판</h2>
			<br/><br/>
			<div class="delete_form">
				<form action="./delete_update.php" method="post" name="board_form">
						<?php
							if(isset($no)) {
								echo '<input type="hidden" name="no" value="' . $no . '">';
							}
						?>
						<input type="hidden" name="no" value="<?php echo $no?>">
						<p class="text">제목</p><span><?php echo $del_subject?></span><br/>
						<div class="input_line"><p class="text">비밀번호</p><input type="password" name="password"></div>
					<div class="subbtn">
							<input type="button" name="button" name="cancel" value="취소하기" onclick="javascript:history.go(-1);" >
					</div><div class="mainbtn">
							<input type="button" name="button" value="삭제하기" onclick="check_input()">
					</div>
				</form>
			</div>
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>