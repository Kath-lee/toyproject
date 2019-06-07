<meta charset="utf-8">
<?
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
	
	//submit 아이디 중복확인
	$sql = "select * from member where m_id = '$fuserid'";
	$res = mysql_query($sql,$connect);
	$rows = mysql_num_rows($res);
	
	if($rows){echo "<script>
	alert('이미 존재하는 아이디입니다.');
	history.go(-1);</script>";exit;}//

$insertsql = "insert into member (m_id, m_pass, m_name, m_phone, m_email, reg_date, m_postcode1, m_postcode2, m_roadaddr, m_jibunaddr, m_detailaddr)values ('$fuserid', '$fpasswd', '$fname', '$fphone', '$femail', now(),'$fpostcode1','$fpostcode2', '$froadaddr', '$fjibunaddr','$fdetailaddr')";
$sql_que = mysql_query($insertsql,$connect);
$insert_test = "select * from member where m_id = '$fuserid'";
$sql_test = mysql_query($insert_test,$connect);
$result = mysql_num_rows($sql_test);

if($result) {
		echo "<script>
			alert('회원가입 성공.');
			location.replace('login_form.php');</script>";
		}else{
			echo "<script>
			alert('회원가입 실패.');
			location.replace('member_form.php');</script>";
		}


mysql_close($connect);
?>
