<?php 
 session_start();
 $uid = $_SESSION[ses_uid];
 $page = $_GET[page];

	include "../lib/conn.php";

	if(!$uid){
	echo("
	<script>
		alert('로그인 하셔야 합니다.');
		location.replace('../login/login_form.php');
	</script>
	");
 };

if(isset($_GET['no'])) {
	$no = $_GET['no'];
}

/*if(isset($no)) {
	$sql = 'select idno, name, subject, content, password from review where no = ' . $no;
	$result = mysql_query($sql, $connect);
	$ram=mysql_num_rows($result);
	$row=mysql_fetch_array($result);
}*/
$sql = "select * from member where m_id = '$uid'";
$result = mysql_query($sql, $connect);
$mm = mysql_fetch_array($result);
$name_sel = $mm[m_name];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>후기 게시판</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
    <link rel="stylesheet" type="text/css" href="../css/review_list.css">
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
				if (confirm("확인을 누르시면 작성된 내용이 모두 사라지고 \n목록으로 돌아갑니다.")){
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
		<h2>후기 게시판 게시물 작성</h2>
			<div>
				<form name="board_form" action="./write.php" method="post" enctype="multipart/form-data">
					<?php
					if(isset($no)) {
						echo '<input type="hidden" name="no" value="' . $no . '">';
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
								<p class="name">제목</p><input type="text" name="subject" maxlength="30" value="">
							</div>
							
							<div class="form">
								<p class="name" style="float:left">내용</p><textarea name="content" rows="5" cols="50" maxlength="200"></textarea>
							</div>
							
							<div class="form">
								<p class="name">그림파일</p><input type="file" name="upfile"></input>
							</div>

							<div class="subbtn">
								<input type="button" onClick="button_event()" value="취소하기"/>
							</div>
							
							<div class="mainbtn">
								<input type="button" onclick="check_input()" value="<?php echo isset($no)?'수정':'작성'?>">
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