<meta charset="utf-8">
<?
	session_start();
	
	include "../lib/conn.php";

	$uid = $_SESSION[ses_uid];
	$no = $_GET[no];
	echo $no;
	if(!$uid){
		echo("
			<script>
			alert('로그인 해주세요');
			location.href='login_form.php';
			</script>
		");
		exit;
	}
	$turechk = "delete from  ticket where no = '$no'";
	$delresult = mysql_query($turechk , $connect);    

	echo("
			<script>
			alert('삭제완료 되었습니다.');
			location.href='../ticket/myticket.php';
			</script>
		");
		exit;

?>