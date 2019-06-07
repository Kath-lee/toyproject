<meta charset="utf-8">
<?session_start();
	
	include "../lib/conn.php";

	$fuserid = $_POST[fuserid];
	$fpasswd = $_POST[fpasswd];
	$uid = $_SESSION[ses_uid];
	
//탈퇴하기
$sql = "select * from member where m_id = '$uid'";
$result = mysql_query($sql,$connect);
$row = mysql_fetch_array($result);

if($fpasswd != $row[m_pass]){echo "<script>alert('비밀번호가 틀립니다.');
			history.go(-1);</script>";}else{

$drop_sql = "select * from ticket where idno = '$uid'";
$sql_que = mysql_query($drop_sql,$connect);
$rows = mysql_num_rows($sql_que);

	if($rows) {
		echo "<script>alert('예약된 티켓이 있습니다.');
			location.href='../ticket/myticket.php';</script>";
			}else {//경로지정
		$mem_tk = "delete from member where m_id = '$uid'";
		mysql_query($mem_tk,$connect);
		mysql_close($connect);

		unset($_SESSION['ses_uid']);
		unset($_SESSION['ses_ulevel']);

		echo "<script>alert('탈퇴가 완료되었습니다.');
			location.href='../index.php';</script>";
		}
			}
?>
