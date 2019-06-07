<meta charset="utf-8">
<?session_start();
	
	include "../lib/conn.php";

	$fuserid = $_POST[fuserid];
	$fpasswd = $_POST[fpasswd];
	$uid = $_SESSION[ses_uid];
	
	
$login_sql = "select * from member where m_id = '$uid' and m_pass = '$fpasswd'";
$sql_que = mysql_query($login_sql,$connect);
$rows = mysql_num_rows($sql_que);


if($rows) {

		echo "<script>
			location.replace('member_form_modify_tab.php');
			</script>";
	}else {
		echo "<script>
			alert('비밀번호가 일치하지 않습니다.');
			location.replace('myt_re_pw.php');
			</script>";
	mysql_close($connect);
	}
?>
