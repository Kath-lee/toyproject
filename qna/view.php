<?php
 session_start();
$uid = $_SESSION[ses_uid];
 $page = $_GET[page];
    if(!$_SESSION['ses_uid']){
		$_SESSION['history'] = $_SERVER['REQUEST_URI'];
		}

 include "../lib/conn.php";

if(!$uid){
	echo("
	<script>
		alert('로그인 하셔야 합니다.');
		location.replace('login_form.php');
	</script>
	");
 };

  $num = $_GET['num'];
  
  $sql = 'select * from qna where num = "'.$num.'"';
  $result = mysql_query($sql,$connect);
  $ram=mysql_num_rows($result);

  $num = mysql_result($result, $i, 0);
  $idno = mysql_result($result, $i, 1);
  $group_num = mysql_result($result, $i, 2);
  $depth = mysql_result($result, $i, 3);
  $password = mysql_result($result, $i, 4);
  $name = mysql_result($result, $i, 5);
  $subject = mysql_result($result, $i, 6);
  $content = mysql_result($result, $i, 7);
  $date = mysql_result($result, $i, 8);
  $hit = mysql_result($result, $i, 9);
  $hit = $hit + 1;

  $hitsql = "update qna set hit = '$hit' where num = '$num'";
  $hitresult = mysql_query($hitsql,$connect);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <link rel="stylesheet" type="text/css" href="../css/qna_view.css">
</head>
<body>
  <div id="wraper">
    <header>
	<nav>
      <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	</header>
    <section>
		<h2>페스티벌 문의</h2>
    <h3>여러분의 궁금증을 풀어드립니다!</h3><br/><br/>
		<br/><br/>
		<div class="con_info">
			<div class="clear"></div>
			<div class="width_long"><p class="title_info"><?php echo $subject ?></p><p class="title_sub">&nbsp;|<?php echo $idno ?>님
			</p></div><div class="width_shot"><p class="title_sub"><?php echo $date ?></p></div>
		</div>
		<div class="content">
			<?php echo nl2br($content) ?>
		</div>
		<div class="con_info">
			<div class="width_long"><input type="button" onClick="location.href='./list.php?page=<?=$page?>'" value="목록보기"/><p class="title_sub">&nbsp;조회수 | <?php echo $hit ?></p></div><div class="width_shot"><?if($idno == $uid){?><input type="button" onClick="location.href='./update_form.php?num=<? echo $num ?>'" value="수정하기"/>&nbsp;<input type="button" onClick="location.href='./delete.php?num=<? echo $num ?>'" value="삭제하기"/><?}?></div>
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>