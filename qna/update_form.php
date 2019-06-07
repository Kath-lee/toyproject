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
 }

if(isset($_GET['num'])) {
	$num = $_GET['num'];
}

if(isset($num)) {
	$sqlq = 'select * from qna where num = ' . $num;
	$resultq = mysql_query($sqlq, $connect);
	$ramq=mysql_num_rows($resultq);
	$rowq=mysql_fetch_array($resultq);
	$subject = $rowq[subject];
	$content = $rowq[content];
}
$sql = "select * from member where m_id = '$uid'";
$result = mysql_query($sql, $connect);
$mm = mysql_fetch_array($result);
$name_sel = $mm[m_name];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <link rel="stylesheet" type="text/css" href="../css/qna_update_form.css">
  <script>
			function check_input(){
				if(!document.board_form.subject.value){
					alert("제목을 입력하세요");
					document.board_form.subject.focus();
					return;
				}
				if(!document.board_form.password.value){
					alert("비밀번호를 입력하세요");
					document.board_form.password.focus();
					return;
				}
				if(!document.board_form.content.value){
					alert("내용을 입력하세요");
					document.board_form.content.focus();
					return;
				}
				document.board_form.submit();
			}
				function button_event(){
				if (confirm("확인을 누르시면 작성된 내용이 모두 사라지고 \n이전화면으로 돌아갑니다.")){
			    history.go(-1);
				}else{
			    return;
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
			<div class="update_form">
				<form name="board_form" action="./update.php" method="post">
					<?php
						if(isset($num)) {
							echo '<input type="hidden" name="num" value="' . $num . '">';
						}
					?>
					<div class="wirte_wrap">
						<div class="form">
							<p class="name">작성자</p><span><?php echo $name_sel; ?></span>
							<input type="hidden" name="name" value='<?=$name_sel; ?>'>
						</div>
						<div class="form">
							<p class="name">비밀번호</p><input type="password" name="password">
						</div>
						<div class="form">
							<p class="name">제목</p><input type="text" name="subject" value="<?=$subject?>"maxlength="30">
						</div>
						<div class="form">
							<p class="name" style="float:left">내용</p><textarea name="content" rows="5" cols="50"><?=$content?></textarea>
						</div>
							<div class="subbtn">
							<input type="button" name="button" value="취소하기" onclick="button_event()" >
						</div>	
						<div class="mainbtn">
							<input type="button" onclick="check_input()" value="<?php echo isset($no)?'수정하기':'작성하기'?>">
						</div>
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