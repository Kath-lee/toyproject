<?
	session_start();


include "../lib/conn.php";

$uid = $_SESSION['ses_uid'];
$ulv = $_SESSION[ses_ulevel];
$date = $_POST['date'];
$subname = $_POST['subname'];
$password = $_POST['password'];
$no = $_POST['no'];
$content = $_POST['content'];




$sql = "select count(no) cou from reserlist";
$sqlresult = mysql_query($sql,$connect);
$sqlarr = mysql_fetch_array($sqlresult);
$next= $sqlarr[cou] + 1;

$today['date'] = date('Y-m-d');
                   
if($ulv != 3){
		echo("
			<script>
			window.alert('관리자가 아니면 사용하실 수 없습니다.');
			location.href='../index.php';
			</script>a
		");
	};

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
			alert('제목을 입력해 주세요');
			history.go(-1);
			</script>
		");
		exit;
	}
	if(!$content){
		echo("
			<script>
			alert('내용을 입력 해주세요');
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
		if($date < $today['date']){
		echo("
			<script>
			alert('지난 일자는 예약 하실 수 없습니다.');
			history.go(-1);
			</script>
		");
		exit;
	}

$sql = "insert into reserlist (no,stdate, subject, password, content) values('$no','$date','$subname','$password','$content')";
$sqlresult = mysql_query($sql,$connect);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
</head>
<body class="a_menu1">
  <div id="wraper">
    <header>
      <?php include "../lib/top_login2.php"; ?>
    </header>
    <nav>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
    <section>
	<!-- 삽입 -->
	<?
	echo "
	<script>
	alert('페스티벌 등록이 완료되었습니다.')
	location.href='reserv_ad.php';
	</script>"
	?>
	</section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>
</body>
</html>
		