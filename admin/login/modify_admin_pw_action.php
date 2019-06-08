<meta charset="utf-8">
<?session_start();
	include "../lib/conn.php";

	$fpasswd = $_POST['fpasswd'];
	$fpasswd_re = $_POST['fpasswd_re'];

	if($fpasswd == $fpasswd_re) {
		$uppw = "update member set m_pass = '$fpasswd' where level = '3'";
		$upd = mysql_query($uppw,$connect);
		
		unset($_SESSION['ses_uid']);
		unset($_SESSION['ses_ulevel']);
		echo "<script>
			alert('비밀번호변경 완료.다시 로그인하세요.');
			location.replace('../index.php');			
			</script>";
	
		}else{
			echo "<script>
			alert('비밀번호가 다릅니다.');
			location.replace('modify_admin_pw.php');
			</script>";
	}
mysql_close($connect);
?>