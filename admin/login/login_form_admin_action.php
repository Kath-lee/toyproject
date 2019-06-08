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
    location.href='../index.php';
    </script>
    ");
exit;}
if(!$fpasswd){
   echo("
    <script>
    window.alert('비밀번호를 입력하세요.');
    location.href='../index.php';
    </script>
    ");
exit;};

$login_sql = "select * from member where m_id = '$fuserid' and m_pass = '$fpasswd'";
$sql_que = mysql_query($login_sql,$connect);
$rows = mysql_num_rows($sql_que);
$arr = mysql_fetch_array($sql_que);
$logid =  $arr[m_id];
$loglv =  $arr[level];

$_SESSION['ses_uid'] = $logid;
$_SESSION['ses_ulevel'] = $loglv;

$ulv = $_SESSION['ses_ulevel'];
	if($_SESSION['ses_ulevel'] == 3){
			echo("
		<script>
		window.alert('관리자님 환영합니다.');
		location.href='../ticket/myticket_ad.php';
		</script>
		");
	}else{
		echo "<script>
			alert('관리자만 로그인 가능합니다.');
			location.replace('../index.php');
			</script>";
	}
	

	mysql_close($connect);
?>