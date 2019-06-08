<?php
 session_start();
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
 include "../lib/conn.php";

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
<body class="a_menu3">
  <div id="wraper">
    <header>
    <nav>
	  <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
	  <div class="clear"></div>
    </nav>
	</header>
    <div class="clear"></div>
    <section class="tab3">  
      <ul id="tab">
        <li><a class="tab1" href="../board_notice/list.php">공지 게시판</a></li>
        <li><a class="tab2" href="../board_review/list.php">후기 게시판</a></li>
        <li><a class="tab3" href="list.php">문의 게시판</a></li>
      </ul>
      <div class="clear"></div>
      <div class="tab_content">
        <h2>QnA 게시판</h2> <br/><br/>
    		<div class="con_info">
    			<div class="clear"></div>
    			<div class="width_long"><p class="title_info"><?php echo $subject ?></p><p class="title_sub">&nbsp;|<?php echo $name ?>님</p></div><div class="width_shot"><p class="title_sub"><?php echo $date ?></p></div>
    		</div>
    		<div class="content">
    			<?php echo nl2br($content) ?>
    		</div>
    		<div class="con_info">
    			<div class="width_long"><input type="button" onClick="location.href='./list.php'" value="목록보기"/></div><div class="width_shot"><input type="button" onClick="location.href='./re_update_form.php?no=<? echo $no ?>'" value="수정하기"/>&nbsp;<input type="button" onClick="location.href='./re_delete.php?no=<? echo $no ?>'" value="삭제하기"/></div>
    		</div>
      </div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>