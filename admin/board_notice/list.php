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
 include "../lib/paging.php";


	$search = "";
	if($_GET['searchText']){
		$search = " and ".$_GET['searchColumn']." like '%".$_GET['searchText']."%'";
	}
	


	$cnt_qurey = "select *  from notice where 1 $search";
		$cnt_result = mysql_query($cnt_qurey,$connect);
		$row =mysql_num_rows($cnt_result);
	
	// paging 변수 선언
	if($_GET[page] && $_GET[page] > 0){
		$page = $_GET[page];
	}else{
		$page = 1;
	}
	$page_row = 10;
	$page_scale = 5;
	$from_record = ($page - 1) * $page_row;
	$paging_search = "&searchColumn=".$_GET['searchColumn']."&searchText=".$_GET['searchText'];


// paging 함수 호출
		$paging = paging($page, $page_row, $page_scale, $row, $paging_search);

		$page_que = "select * from notice where 1 ".$search." order by no desc limit  $from_record, $page_row";
		$result =mysql_query($page_que,$connect);
		$page_arr=mysql_fetch_array($result);
		$row1 = mysql_num_rows($result);

	
	//$str = $_SERVER["PHP_SELF"];
	//echo strpos($_SERVER['PHP_SELF'], "notice");

	

//--------------------------------------------------------------------------------------
/*
		$cnt_qurey = "select *  from ticket";
		$cnt_result = mysql_query($cnt_qurey,$connect);
		$row =mysql_num_rows($cnt_result);
		
	
			// paging 변수 선언
		if($_GET[page] && $_GET[page] > 0){
				$page = $_GET[page];
			}else{
				$page = 1;
			}

		$page_row = 5;
		$page_scale = 5;
		$from_record = ($page - 1) * $page_row;
		
		

		
		// paging 함수 호출
		$paging = paging($page, $page_row, $page_scale, $row);

		$page_que = "select * from ticket order by date desc limit  $from_record, $page_row";
		$result =mysql_query($page_que,$connect);
		$page_arr=mysql_fetch_array($result);
		$row = mysql_num_rows($result);
*/
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
  <link rel="stylesheet" type="text/css" href="../css/notice_list_form.css">
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
			<?	
			if($ulv == 3){
				echo "<div class='alink_btn' style='float:right'><a href='write_form.php'>게시글작성</a></div><div class='clear'></div>";
			}?>
			<table border="1">
				<caption></caption>
				<thead>
					<tr>
						<th width = '60px'>번호</th>
						<th>제목</th>
						<th width = '100px'>작성자</th>
						<th width = '180px'>작성일</th>
					</tr>
				</thead>
				<tbody>

							<?php
								for ($i = 0; $i < $row1; $i++){
									$no = mysql_result($result, $i, 0);
									$subject = mysql_result($result, $i, 1);
									$content = mysql_result($result, $i, 2);
									$name = mysql_result($result, $i, 3);
									$id = mysql_result($result, $i, 4);
									$datetime = mysql_result($result, $i, 5);
									$date = substr($datetime,0,10);
									$password = mysql_result($result, $i, 6);
							?>
					<tr>
						<td align = 'center'><? echo $no ?></td>
						<td><a href="./view.php?no=<? echo $no ?>&page=<?=$page?>"><? echo $subject ?></a>
						</td>
						<td align = 'center'><? echo $name ?></td>
						<td align = 'center'><? echo $date ?></td>
					</tr>
							<?php
								}
							?>
				</tbody>
			</table>

			
			<div id="paging">
				<? echo $paging ?>
			</div>
		<!-- 검색 필드 -->	
			<div class="search">
			<!-- 스타일 줬어요 -->
				<form action="list.php" method="get" style="width:800px">
					<label><select name="searchColumn">
						<option <?php echo $_GET['searchColumn']=='subject'?'selected="selected"':null?> value="subject">제목</option>
						<option <?php echo $_GET['searchColumn']=='content'?'selected="selected"':null?> value="content">내용</option>
						<option <?php echo $_GET['searchColumn']=='name'?'selected="selected"':null?> value="name">이름</option>
					</select></label>
					<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
					<button type="submit">검색</button>
				</form>
			</div>
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>