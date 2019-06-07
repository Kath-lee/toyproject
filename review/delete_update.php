<meta charset="utf-8">
<?php
 session_start();
$uid = $_SESSION[ses_uid];
 
 include "../lib/conn.php";
 $upload_dir="../data/";

if(!$uid){
	echo("
	<script>
		alert('로그인 하셔야 합니다.');
		location.replace('../login/login_form.php');
	</script>
	");
 };

	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['no'])) {
		$no = $_POST['no'];
	}
	
	$password = $_POST['password'];

//글 삭제
if(isset($no)) {
	//삭제 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select* from review where password= "' . $password . '" and no = ' . $no;
	$result = mysql_query($sql, $connect);
	$del_array = mysql_fetch_array($result);
	$del_password = $del_array[password];

if($del_password == $password){
	
	
	$delfilesql = 'select * from review  where no ='. $no;
	$delfileresult = mysql_query($delfilesql,$connect);
	$defilel_row = mysql_num_rows($delfileresult);
	$defilel_array = mysql_fetch_array($delfileresult);
	
	$copied_name = $defilel_array[file_copied_0];
	if($copied_name){
	$image_name=$upload_dir.$copied_name;
				unlink($image_name);
	}
	$del_sql = 'delete from review where no = ' . $no;
	$del_result = mysql_query($del_sql, $connect);




		echo "<script>
         alert('삭제 되었습니다.');
         location.href='list.php';
         </script>";
}else{
echo "<script>
		alert('비밀번호가 맞지 않습니다.')
		history.go(-1);
		</script>";
}
	/*<script>
		alert("<?php echo $msg?>");
		history.back();
	</script>*/


}


?>