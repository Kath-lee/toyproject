<?
	include "conn.php";

	$fuserid = $_POST['fuserid'];

	$level = "select * from member m_id = '$fuserid'";
	$levcon=mysql_query($level, $connect);
	$levarr= mysql_fetch_array($levcon);
	$ulevel = $levarr[level];
	
	$_SESSION['ses_uid'] = $fuserid;
	$_SESSION['ses_level'] = $ulevel;
?>