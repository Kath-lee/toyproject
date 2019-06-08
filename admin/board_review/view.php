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
  $upload_dir = "../data/";
  
  $sql = 'select * from review where no = "'.$no.'"';
  $result = mysql_query($sql,$connect);
  $row=mysql_fetch_array($result);

  $no = $row[no];
  $idno = $row[idno];
  $name = $row[name];
  $subject = $row[subject];
  $content = $row[content];
  $date = $row[date];
  $hit = $row[hit];
  $image_name = $row[file_name_0];
  $image_copied = $row[file_copied_0];

  $img_name = $upload_dir.$image_copied;

  $hit = $hit + 1;
  $hitsql = "update review set hit = '$hit' where no = '$no'";
  $hitresult = mysql_query($hitsql,$connect);

  $sql2 = "select * from member where m_id = '$uid'";
		$result2 = mysql_query($sql2, $connect);
		$mm = mysql_fetch_array($result2);
		$name_sel = $mm[m_name];

$re_qry = "select * from re_review where parent = '$no' order by date desc";
$re_result = mysql_query($re_qry,$connect);
$row1 =mysql_num_rows($re_result); 
$re_num = "(".$row1.")"
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
   <link rel="stylesheet" type="text/css" href="../css/review_view.css">
</head>
<body class="a_menu3">
  <div id="wraper">
    <header>
    <nav>
	  <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	    </header>
  <div class="clear"></div>
    <section class="tab2">  
    <ul id="tab">
      <li><a class="tab1" href="../board_notice/list.php">공지 게시판</a></li>
      <li><a class="tab2" href="list.php">후기 게시판</a></li>
      <li><a class="tab3" href="../board_qna/list.php">문의 게시판</a></li>
    </ul>
    <div class="clear"></div>
    <div class="tab_content">
      <h2>후기 게시판</h2>
      <br/><br/>
  		<div class="con_info">
  			<div class="clear"></div>
  			<div class="width_long"><p class="title_info"><?php echo $subject ?></p><p class="title_sub">&nbsp;|<?php echo $name_sel ?>님</p></div><div class="width_shot"><p class="title_sub"><?php echo $date ?></p></div>
  		</div>            
  		<div class="content">
  			<?php echo nl2br($content) ?><br>
  		</div>
  		<div class="con_info">
  			<div class="width_long"><input type="button" onClick="location.href='./list.php?page=<?=$page?>'" value="목록보기"/><p class="title_sub">&nbsp;조회수 | <?php echo $hit ?></p></div><div class="width_shot"><input type="button" onClick="location.href='./update_form.php?no=<? echo $no ?>'" value="수정하기"/>&nbsp;<input type="button" onClick="location.href='./delete.php?no=<? echo $no ?>'" value="삭제하기"/></div>
  		</div>
  		<div class="reple_area">
  			<?include "re_test01.php"?>
  		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>