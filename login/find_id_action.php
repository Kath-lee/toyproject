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

	
	$sqlid = "select * from member where m_name = '$fname' and m_email = '$femail'";
	$result3= mysql_query($sqlid,$connect);
	$result4= mysql_fetch_array($result3);

	if($result4){
		echo "아이디는 $result4[m_id] 입니다.";exit;}
		

	 if(!$result4){
		echo "<script>
		alert('회원이 아닙니다.')
		history.go(-1)</script>";exit;}

mysql_close($connect);

?>
