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

	$name = $_POST['name'];
	$password = $_POST['password'];
	$subject = $_POST['subject'];
	$content = $_POST['content'];

	if(isset($_POST['num'])) {
		$num = $_POST['num'];
	}

	$sql = 'insert into re_qna (no, parent, id, password, name, subject, content, date) values(null, "' . $num .'", "' . $uid . '", "' . $password . '", "' . $name . '", "' . $subject . '", "' . $content . '", now())';
	$result = mysql_query($sql, $connect);

	if($result) {
		echo "<script>
		alert('답글쓰기 완료 했습니다');
		location.href='list.php';
		</script>";
		} else {
		echo "<script>
		alert('답글을 등록하지 못 했습니다.');
		</script>";
		}
?>