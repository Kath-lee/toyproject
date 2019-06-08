<meta charset="utf-8">
<?
	session_start();
	
	include "../lib/conn.php";

		$uid = $_SESSION[ses_uid];
		$ulv = $_SESSION[ses_ulevel];
		$gid = $_GET[gid];
	if($ulv !== '3'){
		echo("
			<script>
			window.alert('관리자가 아니면 사용하실 수 없습니다.');
			location.href='../index.php';
			</script>
		");
	};
	$no = $_GET[no];

	
	$turechk = "delete from  ticket where no = '$no'";
	$delresult = mysql_query($turechk , $connect);    

	echo("
			<script>
			alert('삭제완료 되었습니다.');
			location.href='../login/memberlist_modify_ad.php?id=".$gid."';
			</script>
		");
		exit;

?>