<meta charset="utf-8">
<?
	session_start();

	include "../lib/conn.php";

	$fuserid = $_POST[fuserid];
	$fpasswd = $_POST[fpasswd];


if(!$fuserid){
   echo("
    <script>
    window.alert('아이디를 입력하세요.');
    location.href='login_form.php';
    </script>
    ");
exit;}
if(!$fpasswd){
   echo("
    <script>
    window.alert('비밀번호를 입력하세요.');
    location.href='login_form.php';
    </script>
    ");
exit;};

$login_sql = "select * from member where m_id = '$fuserid' and m_pass = '$fpasswd'";
$sql_que = mysql_query($login_sql,$connect);
$rows = mysql_num_rows($sql_que);
$arr = mysql_fetch_array($sql_que);
$logid =  $arr[m_id];
$loglv =  $arr[level];

//마지막 로그인 날짜
$last_log = "update member set last_log = now()";
$sql_que2 = mysql_query($last_log,$connect);


$_SESSION['ses_uid'] = $logid;
$_SESSION['ses_ulevel'] = $loglv;
if($rows) {
		echo "<script>
			alert('$fuserid 님 로그인을 환영합니다..');
			location.replace('".$_SESSION['history']."');
			</script>";
	}
	else{
		echo "<script>
			alert('아이디 또는 비밀번호가 틀립니다.');
			location.replace('login_form.php');
			</script>";
	}
	mysql_close($connect);
?>