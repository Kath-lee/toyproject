<?php
   session_start();
$uid = $_SESSION[ses_uid];
$page = $_GET[page];
 
 include "../lib/conn.php";


  $no = $_GET['no'];
  
  $sql = 'select * from notice where no = "'.$no.'"';
  $result = mysql_query($sql,$connect);
  $ram=mysql_num_rows($result);

  $no = mysql_result($result, $i, 0);
  $subject = mysql_result($result, $i, 1);
  $content = mysql_result($result, $i, 2);
  $name = mysql_result($result, $i, 3);
  $id = mysql_result($result, $i, 4);
  $date = mysql_result($result, $i, 5);
  $password = mysql_result($result, $i, 6);

  $hitsql = "update notice set hit = '$hit' where no = '$no'";
  $hitresult = mysql_query($hitsql,$connect);

  $sql2 = "select * from member where m_id = '$uid'";
		$result2 = mysql_query($sql2, $connect);
		$mm = mysql_fetch_array($result2);
		$name_sel = $mm[m_name];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <link rel="stylesheet" type="text/css" href="../css/notice_view_form.css">
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
</head>
<body class="menu3">
  <div id="wraper">
    <header>
    <nav>
	  <?php include "../lib/top_login2.php"; ?>
    <?php include "../lib/top_menu2.php"; ?>
    </nav>
    </header>
	<section>
		<h2>페스티벌 공지</h2>
		<h3>페스티벌 진행과 새소식에 대하여 안내합니다.</h3><br><br>
		<!-- float 달았어요 ㅠ -->
			<div class="con_info">
				<div class="clear"></div>
					<div class="width_long" >
						<p class="title_info"><?php echo $subject?></p>&nbsp;|
						<p class="title_sub"><?php echo $name ?></p>
					</div><div class="width_shot"><p class="title_sub"><?php echo $date?></p>
					</div>		
			</div>
			<div class='clear'></div>

			
			<div class="content">
			<?php echo nl2br($content) ?>
			</div>
			<div class="con_info">
				<div class="width_long"></div><div class="width_shot"><input type="button" onClick="location.href='./list.php?page=<?=$page?>'" value="목록으로"/>
			</div>
			
	</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>