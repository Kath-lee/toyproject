<meta charset="utf-8">
<?
	session_start();
	
	include "../lib/conn.php";

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

	$password = $_POST[password];
	$delno = $_POST[delno];
	$no = $_GET[no];

	

	$delsql = "select * from reserlist where no = '$delno' and password = '$password'";
	$delresult = mysql_query($delsql,$connect);
	$delrows = mysql_fetch_array($delresult);
	$delpw = $delrows[password];
	
	if($delpw !== $password){
		echo("
			<script>
			alert('비밀번호가 일치하지 않습니다.');
			history.go(-1);
			</script>
		");
	}else{
				$turechk = "delete from reserlist where no = '$delno'";
				$delresult = mysql_query($turechk , $connect);    
	echo("
			<script>
			alert('삭제완료 되었습니다.');
			location.href='reserv_ad.php';
			</script>
		");
		exit;
	}
?>