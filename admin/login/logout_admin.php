<?

	include "session.php";
	unset($_SESSION['ses_uid']);
	unset($_SESSION['ses_ulevel']);
	echo "<script>
		alert('[logout] \\r\\n 로그인 화면으로 이동합니다.');
		location.replace('../index.php');
		</script>";
?>