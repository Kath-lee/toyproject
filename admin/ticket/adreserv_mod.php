<meta charset="utf-8">
<?
	session_start();


include "../lib/conn.php";

	$uid = $_SESSION[ses_uid];
		$ulv = $_SESSION[ses_ulevel];
	if($ulv !== '3'){
		echo("
			<script>
			window.alert('관리자가 아니면 사용하실 수 없습니다.');
			location.href='../index.php';
			</script>
		");
	};
$date = $_POST['date'];
$subname = $_POST['subname'];
$password = $_POST['password'];
$no = $_POST['no'];
$today['date'] = date('Y-m-d');
$content = $_POST['content'];

$sql = "select count(no) cou from reserlist";
$sqlresult = mysql_query($sql,$connect);
$sqlarr = mysql_fetch_array($sqlresult);
$next= $sqlarr[cou] + 1;

$pwsql = "select * from reserlist where no = '$no'";
$pwresult = mysql_query($pwsql,$connect);
$pwarr = mysql_fetch_array($pwresult);
$servpw = $pwarr['password'];
$qwdate = $pwarr['stdate'];

	if(!$date){
		echo("
			<script>
			alert('날짜를 선택해주세요');
			history.go(-1);
			</script>
		");
		exit;
	}
	if(!$subname){
		echo("
			<script>
			alert('부 제목을 입력해 주세요');
			history.go(-1);
			</script>
		");
		exit;
	}
		if(!$password){
		echo("
			<script>
			alert('비밀번호를 입력해 주세요');
			history.go(-1);
			</script>
		");
		exit;			
		}

if($servpw != $password){
	echo("
			<script>
			alert('입력하신 비밀번호가 일지하지 않습니다.');
			history.go(-1);
			</script>
		");
		exit;			
		}
if($qwdate < $today['date']){
		echo("
			<script>
			alert('지난 일자는 변경 하실 수 없습니다.');
			history.go(-1);
			</script>
		");
		exit;
	}


$sql = "update reserlist set stdate = '$date' , subject = '$subname', content = '$content' where no = '$no'  "; 
echo $sql;
$result = mysql_query($sql,$connect);
echo "<script>
alert('수정이 완료되었습니다.')
location.href='reserv_ad.php';
</script>"

?>
