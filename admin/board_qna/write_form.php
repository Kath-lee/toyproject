<?php 
 session_start();
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
	include "../lib/conn.php";


if(isset($_GET['num'])) {
	$num = $_GET['num'];
}

/*if(isset($num)) {
	$sql = 'select * from qna where num = ' . $num;
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
  <title>QnA 게시판</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <link rel="stylesheet" type="text/css" href="../css/qna_write_form.css">
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
<body class="a_menu3">
  <div id="wraper">
    <header>
    <nav>
	  <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	</header>
    <div class="clear"></div>
    <section class="tab3">	
		<ul id="tab">
			<li><a class="tab1" href="../board_notice/list.php">공지 게시판</a></li>
			<li><a class="tab2" href="../board_review/list.php">후기 게시판</a></li>
			<li><a class="tab3" href="list.php">문의 게시판</a></li>
		</ul>
		<div class="clear"></div>
		<div class="tab_content">
			<h2>QnA 게시판</h2> <br/><br/>
			<div class="write_form">
				<form name="board_form" action="./write.php" method="post">
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
								<p class="name">제목</p><input type="text" name="subject" value=""maxlength="30">
							</div>
							
							<div class="form">
								<p class="name" style="float:left">내용</p><textarea name="content" rows="5" cols="50" maxlength="200"></textarea>
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
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>