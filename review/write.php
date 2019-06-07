<meta charset="utf-8">
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

	$upload_dir="../data/";

	$files=$_FILES["upfile"];

	$file=explode(".",$files["name"]);
	$file_name=$file[0];
	$file_ext=$file[1];

	if(!$files["error"]){
		$new_file_name=date("Y_m_d_H_i_s");
		$upfile=$new_file_name.".".$file_ext;
		$uploaded_file=$upload_dir.$upfile;

		if($files["size"]>1112000){
			echo("<script>
			alert('용량이 너무 큽니다.');
			history.go(-1);
			</script>");
			exit;
		}else if(($files["type"] != "image/gif") && ($files["type"] != "image/jpeg") && ($files["type"] != "image/pjpeg") && ($files["type"] != "image/png")) {
			echo("<script>
			alert('jpg, png, gif 파일만 가능합니다.');
			history.go(-1);
			</script>");
			exit;
		}else if(!move_uploaded_file($files["tmp_name"], $uploaded_file)){
			echo("<script>
			alert('이미지 업로드 실패했습니다.')
			</script>");
			exit;
		}
	}


	echo $file_size;
	
	//$_POST['no']이 있을 때만 $no 선언
	if(isset($_POST['no'])) {
		$no = $_POST['no'];
	}

	//no이 없다면(글 쓰기라면) 변수 선언
	if(empty($no)) {
		$idno = $_POST['idno'];
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
	$sql = 'select count(password) as cnt from review where password="' . $password . '" and no = ' . $no;
	$result = mysql_query($sql, $connect);
	$row = mysql_num_rows($result);
	//비밀번호가 맞다면 업데이트 쿼리 작성
	if($row) {
		$sql = 'update review set subject="' . $subject . '", content="' . $content . '" where no = ' . $no;
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
	$sql = 'insert into review (no, idno, name, subject, content, password, date, hit, file_name_0, file_copied_0) values(null, "' . $uid . '", "' . $name . '", "' . $subject . '", "' . $content . '", "' . $password . '", "' . $date . '", 0, "' . $files["name"] . '", "' . $upfile . '")';
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