<meta charset="utf-8">
<?php
	session_start();
	$uid = $_SESSION[ses_uid];
	$parent = $_POST['no'];
	$password = $_POST['password'];
	$content = $_POST['content'];
	
	include "../lib/conn.php";

	if(!$uid){
		echo("
		<script>
		alert('로그인 하셔야 합니다.');
		location.replace('../login/login_form.php');
		</script>
		");
	};
	
//글 등록
 /*else {*/
	$sql = "insert into re_review (parent, id, password, content,date) values( '$parent','$uid','$password','$content',now())";
	$result = mysql_query($sql,$connect);
	
	//쿼리가 정상 실행 됐다면,
	if($result) {
		echo"<script>
		alert('정상적으로 글이 등록 되었습니다.');
		location.href= 'view.php?no=".$parent."';
		</script>";
		} else {
			echo"<script>
		alert('글을 등록하지 못했습니다.');
		</script>";
		}
	?>
