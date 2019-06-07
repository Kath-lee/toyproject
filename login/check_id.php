<meta charset="utf-8">
<?
	$id = $_GET['id'];
	include "../lib/conn.php";
	$sql = "select * from member where m_id = '$id'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	if(!$rows){echo "사용가능한 아이디 입니다.";}else{echo "이미 사용중인 아이디입니다.";}

?>