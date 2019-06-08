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


	//$_POST['no']이 있을 때만 $no 선언
	if(isset($_POST['no'])) {
		$no = $_POST['no'];
	}

	//no이 없다면(글 쓰기라면) 변수 선언
	if(empty($no)) {
		$id = $_POST['id'];
		$date = date('Y-m-d H:i:s');
	}

	//항상 변수 선언
	$name = $_POST['name'];
	$password = $_POST['password'];
	$subject = $_POST['subject'];
	$content = $_POST['content'];

//글 수정
if(isset($no)) {
	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select count(password) as cnt from notice where password="' . $password . '" and no = ' . $no;
	$result = mysql_query($sql, $connect);
	$row = mysql_num_rows($result);
	//비밀번호가 맞다면 업데이트 쿼리 작성
	if($row) {
		$sql = 'update notice set subject="' . $subject . '", content="' . $content . '" where no = ' . $no;
		$msgState = '수정';
	//틀리다면 메시지 출력 후 이전화면으로
	} else {
		$msg = '비밀번호가 맞지 않습니다.';
	?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
	<?php
		exit;
	}
	
//글 등록
} else {
	$sql = 'insert into notice (no, id, name, subject, content, password, date) values(null, "' . $uid . '", "' . $name . '", "' . $subject . '", "' . $content . '", "' . $password . '", "' . $date . '")';
	$msgState = '등록';
}
//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	$result = mysql_query($sql, $connect);
	
	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
		if(empty($no)) {
			$no = $db->insert_id;
		}
		$replaceURL = './list.php';
	} else {
		$msg = '글을 ' . $msgState . '하지 못했습니다.';
?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
<?php
		exit;
	}
}

?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>