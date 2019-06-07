<meta charset="utf-8">
<?
	include "../lib/conn.php";

	$fuserid = $_POST['fuserid'];
	$fpasswd = $_POST['fpasswd'];
	$fpasswd_re = $_POST['fpasswd_re'];
	$fname = $_POST['fname'];
	$fphone = $_POST['fphone'];
	$femail = $_POST['femail'];
	$faddr = $_POST['faddr'];


	$sqlid = "select * from member where m_name = '$fname' and m_id = '$fuserid' and m_email = '$femail'";
	$result5= mysql_query($sqlid,$connect);
	$result6= mysql_fetch_array($result5);

	if($result6) {
		echo " $result6[m_name]님의 비밀번호는 $result6[m_pass] 입니다.";}
	if(!$result6) {
		echo "<script>
		alert('비밀번호를 찾을수 없습니다.')
		history.go(-1)</script>";}
	
		
mysql_close($connect);
?>
