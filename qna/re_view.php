<?php
 session_start();
$uid = $_SESSION[ses_uid];
$page = $_GET[page];

 
 include "../lib/conn.php";

if(!$uid){
	echo("
	<script>
		alert('로그인 하셔야 합니다.');
		location.replace('login_form.php');
	</script>
	");
 };

  $no = $_GET['no'];
  
  $sql = 'select * from re_qna where no = "'.$no.'"';
  $result = mysql_query($sql,$connect);
  $row=mysql_fetch_array($result);

  
  $no = $row[no];
  $parent = $row[parent];
  $id = $row[id];
  $password = $row[password];
  $name = $row[name];
  $subject = $row[subject];
  $content = $row[content];
  $date = $row[date];
  $hit = $hit + 1;

  /*$hitsql = "update qna set hit = '$hit' where num = '$num'";
  $hitresult = mysql_query($hitsql,$connect);*/
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <link rel="stylesheet" type="text/css" href="../css/qna_re_view.css">
  <!-- index css/script -->
</head>
<body>
  <div id="wraper">
    <header>
	<nav>
      <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
	  <div class="clear"></div>
    </nav>
	</header>
    <section>
		<h2>페스티벌 문의</h2>
    <h3>여러분의 궁금증을 풀어드립니다!</h3><br/><br/>
		<br/><br/>
		<div class="con_info">
			<div class="clear"></div>
			<div class="width_long"><p class="title_info"><?php echo $subject ?></p><p class="title_sub">&nbsp;|<?php echo $name ?>님</p></div><div class="width_shot"><p class="title_sub"><?php echo $date ?></p></div>
		</div>
		<div class="content">
			<?php echo nl2br($content) ?>
		</div>
		<div class="con_info">
			<div class="width_long"><input type="button" onClick="location.href='./list.php?page=<?=$page?>'" value="목록보기"/></div><div class="width_shot"></div>
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>