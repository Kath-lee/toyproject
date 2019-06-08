<?php
   session_start();
$uid = $_SESSION[ses_uid];
 $ulv = $_SESSION[ses_ulevel];
$page = $_GET[page];

	if($ulv !== '3'){
		echo("
			<script>
			window.alert('관리자가 아니면 사용하실 수 없습니다.');
			location.href='../index.php';
			</script>
		");
	};
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
  <title>Poltfolio-Uranos Festival/관리자 페이지</title>
   <link rel="stylesheet" type="text/css" href="../css/common.css">
   <link rel="stylesheet" type="text/css" href="../css/notice_view_form.css">
  <!-- index css/script -->
</head>
<body class="a_menu3">
  <div id="wraper">
    <header>
      <?php include "../lib/top_login2.php"; ?>
    </header>
    <nav>
      <?php include "../lib/top_menu2.php"; ?>
	  <div class="clear"></div>
    </nav>
    <section class="tab1">  
    <ul id="tab">
      <li><a class="tab1" href="list.php">공지 게시판</a></li>
      <li><a class="tab2" href="../board_review/list.php">후기 게시판</a></li>
      <li><a class="tab3" href="../board_qna/list.php">문의 게시판</a></li>
    </ul>
    <div class="clear"></div>
    <div class="tab_content">
    	<h2>공지 게시판</h2><br/><br/>
    		<div class="con_info">
    				<div class="clear"></div>
    				<div class="width_long"><p class="title_info"><?php echo $subject?></p>&nbsp;|<p class="title_sub"><?php echo $name_sel ?></p></div><div class="width_shot"><p class="title_sub"><?php echo $date?></p></div></div>	
  			<div class="content">
  				<?php echo nl2br($content) ?>
  			</div>
  			<div class="con_info">
         <div class="width_long"><input type="button" onClick="location.href='./list.php?page=<?=$page?>'" value="목록보기"/></div><div class="width_shot"><input type="button" onClick="location.href='./update_form.php?no=<? echo $no ?>'" value="수정하기"/>&nbsp;<input type="button" onClick="location.href='./delete.php?no=<? echo $no ?>'" value="삭제하기"/></div>
        </div>
    	</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>