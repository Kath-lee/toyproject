<meta charset="utf-8">
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

	$num = $_GET['num'];
	$content = $_POST['content'];
	$password = $_POST['password'];
	$no = $_POST['no'];




//글 수정
if(isset($num)) {
	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select * from re_review where password = "' . $password . '" and no = ' . $num;
	$result = mysql_query($sql, $connect);
	$up_array = mysql_fetch_array($result);
	$up_password = $up_array[password];

if($up_password == $password){
		$up_sql = "update re_review set content =  '$content'  where no = '$num' " ;
		$up_result = mysql_query($up_sql, $connect);

	echo "<script>
		alert('수정했습니다.');
		location.href='view.php?no=".$no."';
		</script>";
	}else{
		echo"<script>
		alert('비밀번호가 맞지 않습니다.');
		history.go(-1);
		</script>";
	}
	}
?>