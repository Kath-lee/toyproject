<meta charset="utf-8">
<?

	include "../lib/session.php";
	unset($_SESSION['ses_uid']);
	unset($_SESSION['ses_ulevel']);
	echo "<script>
		alert('[logout] \\r\\n 로그아웃 되었습니다.');
		location.replace('../index.php');
		</script>";
?>