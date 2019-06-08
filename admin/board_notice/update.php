<meta charset="utf-8">
<?php
	session_start();
	$uid = $_SESSION[ses_uid];

	include "../lib/conn.php";

	$ulv = $_SESSION[ses_ulevel];

	if($ulv !== '3'){
		echo("
			<script>
			window.alert('관리자가 아니면 사용하실 수 없습니다.');
			location.href='../index.php';
			</script>
		
	");
 };

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
	$sql = 'select * from notice where password = "' . $password . '" and no = ' . $no;
	$result = mysql_query($sql, $connect);
	$up_array = mysql_fetch_array($result);
	$up_password = $up_array[password];

	if($up_password == $password){
		$up_sql = "update notice set subject =  '$subject' , content = '$content'  where no = '$no' " ;
		$up_result = mysql_query($up_sql, $connect);

		echo "<script>
		alert('수정했습니다.');
		location.href='list.php';
		</script>";
	}else{
		echo"<script>
		alert('비밀번호가 맞지 않습니다.');
		history.go(-1);
		</script>";
	}
	}
?>