<meta charset="utf-8">
<?session_start();
	include "../lib/conn.php";
	$ulv = $_SESSION[ses_ulevel];

	if($ulv !== '3'){
		echo("
			<script>
			window.alert('관리자가 아니면 사용하실 수 없습니다.');
			location.href='../index.php';
			</script>
		");
	};
	//관리자가 회원목록 수정하기 action


	//아이디 가져오기??
	$fid = $_GET['id'];
	//$fpasswd = $_POST['fpasswd'];
	//$fpasswd_re = $_POST['fpasswd_re'];
	$fname = $_POST['fname'];
	$fphone = $_POST['fphone'];
	$femail = $_POST['femail'];
	$fpostcode1 = $_POST['fpostcode1'];
	$fpostcode2 = $_POST['fpostcode2'];
	$froadaddr = $_POST['froadaddr'];
	$fjibunaddr = $_POST['fjibunaddr'];
	$fdetailaddr = $_POST['fdetailaddr'];
	$uid = $_SESSION['ses_uid'];
	

	$selname = "select m_id from member where m_id = '$fid'";
	$sql_que = mysql_query($selname,$connect);
	$sql_name = mysql_fetch_assoc($sql_que);
	

	$uppw = "update member set m_name = '$fname', m_phone = '$fphone', m_email = '$femail', m_postcode1 = '$fpostcode1' , m_postcode2 = '$fpostcode2', m_roadaddr = '$froadaddr', m_jibunaddr = '$fjibunaddr',m_detailaddr = '$fdetailaddr' where m_id = '$fid'";
	$uidup = mysql_query($uppw,$connect);

	
	if($uidup) {//!!!!!!!!!!!!!!!!!경로지정!!!!!!!!!!!!!!!!!!!!!
		echo "<script>
			alert('회원정보가 수정 되었습니다.');
			location.replace('memberlist_admin.php');
			</script>";
	}
	else{
		echo "<script>
			alert('회원정보 수정에 실패했습니다.');
			hostory.go(-1);
			</script>";
	}


mysql_close($connect);
?>