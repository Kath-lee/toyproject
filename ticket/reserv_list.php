<?php
  session_start();
		
		include "../lib/conn.php";
		include "../lib/paging.php";
		$uid = $_SESSION[ese_uid];
		$today['date'] = date('Y-m-d');
	
	$search = "";
	if($_GET['searchText']){
		$search = " and ".$_GET['searchColumn']." like '%".$_GET['searchText']."%'";
	}

	$cnt_qurey = "select *  from reserlist where 1 $search";
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
		$paging_search = "&searchColumn=".$_GET['searchColumn']."&searchText=".$_GET['searchText'];

		$paging = paging($page, $page_row, $page_scale, $row, $paging_search);

		$page_que = "select * from reserlist where stdate > '$today[date]'  ".$search." order by no desc limit  $from_record, $page_row";
		$result =mysql_query($page_que,$connect);
		$page_arr=mysql_fetch_array($result);
		$row1 = mysql_num_rows($result);
	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- ticket_form css/script -->
  <link rel="stylesheet" type="text/css" href="../css/ticket_reserve_list.css">
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
</head>
<body>
  <div id="wraper">
    <header>
    <nav>
	  <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	</header>
    <div class="clear"></div>
    <section>
	
     <h2>페스티벌 예매하기</h2>
	 <h3><? echo "총 <span>$row</span>개의 페스티벌이 진행중입니다.";?></h3><br/><br/>
	 <img src="../img/poster.jpg" width="880" height="1000" border="0" alt=""><br><br>

	 

	  <h2>예매 리스트</h2>
	  예매가능 횟수는 회차 상관없이 1인당 총 10매 예매 가능합니다.<br><br>
	 <div class="ticket_res">
		<?
			for ($i = 0; $i < $row1; $i++){
				$no = mysql_result($result, $i, 0);
				$subject = mysql_result($result, $i, 1);
				$date = mysql_result($result, $i, 2);
				$content = mysql_result($result, $i, 4);

				?>
				<div class="fes_list">
					<div class="fes_no"><p><?echo $no?>차</p></div>
					<div class="fes_title"><p class="subtitle"><strong><a href="./reserv_list.php?view=<? echo $no ?>&page=<?=$page?>"><? echo $subject."&nbsp;&nbsp;&nbsp;"?></strong>
					</a></p><p class="date"><?echo $date ?></p><br>
					<?if($_GET['view'] == $no ){?>
					<div class="fes_view" autofocus='focus'><?echo $content;?></div>
					<?}?>
					
					</div>
				<div class="fes_res_btn" >
			<input type="button" value = "예매하기" onclick="location.href='./reserv_form.php?no=<?=$no?>'">
			<div class="clear"></div>
			</div>
				</div>
				<?
			};
		?>
	</div>
		<div class="clear"></div>
		<div class="paging_align">
			<div id="paging">
				<? echo $paging?>
			</div>
		</div>
		<!-- 검색 들어갈 부분 -->
			<div class="search">
				<form action="./reserv_list.php" method="get">
					<select name="searchColumn">
						<option <?php echo $_GET['searchColumn']=='no'?'selected="selected"':null?> value="no">회차</option>
						<option <?php echo $_GET['searchColumn']=='subject'?'selected="selected"':null?> value="subject">이름</option>
					</select><input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>"><button type="submit">검색</button>
				</form>
			</div>
	</section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>