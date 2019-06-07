<meta charset="utf-8">
<?session_start();
	include "../lib/conn.php";

	$fuserid = $_POST['fuserid'];
	$fpasswd = $_POST['fpasswd'];
	$fpasswd_re = $_POST['fpasswd_re'];
	$fname = $_POST['fname'];
	$fphone = $_POST['fphone'];
	$femail = $_POST['femail'];
	$fpostcode1 = $_POST['fpostcode1'];
	$fpostcode2 = $_POST['fpostcode2'];
	$froadaddr = $_POST['froadaddr'];
	$fjibunaddr = $_POST['fjibunaddr'];
	$fdetailaddr = $_POST['fdetailaddr'];
	$uid = $_SESSION['ses_uid'];	


$selname = "select m_id from member where m_id = '$uid'";
$sql_que = mysql_query($selname,$connect);
$sql_name = mysql_fetch_assoc($sql_que);

$uppw ="update member set m_pass = '$fpasswd', m_name = '$fname', m_phone = '$fphone', m_email = '$femail', m_postcode1 = '$fpostcode1' , m_postcode2 = '$fpostcode2', m_roadaddr = '$froadaddr', m_jibunaddr = '$fjibunaddr', m_detailaddr = '$fdetailaddr' where m_id = '$uid'";
$uidup = mysql_query($uppw,$connect);

if($uidup) {
		echo "<script>
			alert('수정 완료.');
			location.replace('./my_info.php');
			</script>";
	}
	else{
		echo "<script>
			alert('수정 실패.');
			history.go(-1);
			</script>";
	}

mysql_close($connect);
?>