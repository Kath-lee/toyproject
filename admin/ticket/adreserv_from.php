<?
	session_start();
	include "../lib/conn.php";
	$uid = $_SESSION[ses_uid];
	$ulv = $_SESSION[ses_ulevel];

	$maxticsql = "select sum(re_member) total from ticket where idno = '$uid'";
	$maxresult = mysql_query($maxticsql, $connect);    
	$maxarr=mysql_fetch_array($maxresult);
	$totsel=$maxarr[total];
	if(!$totsel){
		$totsel = 0;
	}


	$memb="select * from member where m_id = '$uid'";
	$result=mysql_query($memb, $connect);
	$row=mysql_fetch_array($result);
	$id = $row[m_id];
	$phone = $row[m_phone];
	$password = $row[m_pass];

	$total_record = mysql_num_rows($result);

	if($ulv !== '3'){
		echo("
			<script>
			window.alert('관리자가 아니면 사용하실 수 없습니다.');
			location.href='../index.php';
			</script>
		");
	};
$sql = "select * from reserlist order by no desc";
$sqlresult = mysql_query($sql,$connect);
$sqlarr = mysql_fetch_array($sqlresult);
$next= $sqlarr[no] + 1;

;?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival/관리자 페이지</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- festival_add css/script -->
  <link rel="stylesheet" type="text/css" href="../css/festival_add.css">
</head>
<body class="a_menu1">
  <div id="wraper">
    <header>
      <?php include "../lib/top_login2.php"; ?>
    </header>
    <nav>
      <?php include "../lib/top_menu2.php"; ?>
	  <div class="clear"></div>
    </nav>
    <section>
		<h2>페스티벌 등록</h2>
		<h3>이번에 등록되는 페스티벌은 <span><?echo "$next "?></span>회차 입니다.</h3>
		<br><br>
		<div class="reservation">
			<form name='reserv_form' method='post' action='adreserv.php'>
				<input type='hidden' name='no' size= '12' value='<?echo "$next "?>'></input>
				<p class="line_title">날짜</p><input type='date' name='date' size= '12' value=''></input><br/>
				<p class="line_title">제목</p><input type='text' size= '12' name='subname' value='' placeholder="진행되는 페스티벌 제목을 입력해주세요"></input><br/>
				
				<p class="line_title" style='float:left'>추가내용</p><textarea name="content" rows="5" cols="50" maxlength="200" placeholder="행사에 추가되는 내용을 입력해 주세요."></textarea>
				 <div class="clear">
				
				<p class="line_title">비밀번호입력</p><input type='password' name='password' size= '12' value=''placeholder="페스티벌을 관리할 비밀번호를 입력해주세요"></input><br/>
				<input type='submit' value='등록하기'></input>
			</form>
		</div>
	</section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>