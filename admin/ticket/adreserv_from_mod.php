<?
	session_start();

	include "../lib/conn.php";
	$uid = $_SESSION[ses_uid];
	$ulv = $_SESSION[ses_ulevel];
	$no =$_GET[no];
	
	$modsql = "select * from reserlist where no = '$no'";
	$msqlresult = mysql_query($modsql,$connect);
	$modsqlarr=mysql_fetch_array($msqlresult);
	$modno = $modsqlarr['no'];
	$moddate = $modsqlarr['stdate'];
	$modsubject = $modsqlarr['subject'];
	$modcontent = $modsqlarr['content'];
	$page = $_GET['page'];

	if($ulv !== '3'){
		echo("
			<script>
			window.alert('관리자가 아니면 사용하실 수 없습니다.');
			location.href='login_form.php';
			</script>
		");
	};
;?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
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
    </nav>
	<div class="clear"></div>
    <section>
		<h2>페스티벌 정보 더보기</h2>
		<h3>정보 수정 후 [수정하기]버튼 선택하시면, <span><?=$no;?></span>회 페스티벌의 수정된 정보를 저장합니다.</h3><br><br>
		<div class='reservation'>
			<form name='reserv_form' method='post' action='adreserv_mod.php'>
				<input type='hidden' name='no' size= '12' value='<?=$no;?>'></input>
				<p class="line_title">날짜</p><input type='date' name='date' size= '12' value='<?=$moddate;?>'></input><br/>
				<p class="line_title">제목</p><input type='text' size= '12' name='subname' value='<?=$modsubject;?>' placeholder="진행되는 페스티벌 제목을 입력해주세요"></input><br/>
				<p class="line_title" style='float:left'>추가내용</p><textarea name="content" rows="5" cols="50" maxlength="200"><?=$modcontent;?></textarea>
				 <div class="clear">

				<p class="line_title">비밀번호입력</p><input type='password' name='password' size= '12' value=''placeholder="등록된 비밀번호를 입력해주세요"></input>
				<div class="subbtn">
					<input type="button" name="button" name="cancel" value="목록으로" onclick="location.href='reserv_ad.php?page=<?=$page;?>'" >
				</div>
				<div class="mainbtn">
					<input type='submit' value='수정하기'>
				</div>
			</form>
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>
</body>
</html>
		