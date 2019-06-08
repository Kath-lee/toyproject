<?php
  session_start();	
		include "../lib/paging.php";
		include "../lib/conn.php";

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
	$page_row = 10;
	$page_scale = 5;
	$from_record = ($page - 1) * $page_row;

	// paging 함수 호출
		$paging_search = "&searchColumn=".$_GET['searchColumn']."&searchText=".$_GET['searchText'];

		$paging = paging($page, $page_row, $page_scale, $row, $paging_search);

		$page_que = "select * from reserlist where 1 ".$search." order by no desc limit  $from_record, $page_row";
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
  <!-- festival_form css/script -->
  <link rel="stylesheet" type="text/css" href="../css/ticket_list.css">
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
    <section class="tab2">	
		<ul id="tab">
			<li><a class="tab1" href="myticket_ad.php">페스티벌 예약 현황</a></li>
			<li><a class="tab2" href="reserv_ad.php">페스티벌 등록</a></li>
		</ul>
		<div class="clear"></div>
		<div class="tab_content">
			<h2>페스티벌 목록</h2>
			<h3><? echo "총 $row 개의 항목이 검색되었습니다.";?></h3>
			<br/><br/>
			<div class="alink_btn"><a href='adreserv_from.php'>페스티벌 등록하기</a><h3>새로운 페스티벌을 추가하시려면 [페스티벌 등록하기]버튼을 선택해주세요.</h3></div>
			<table border='1px' >
				<tr align = 'center'>
					<th> 회차 </th>
					<th> 행사부제목</th>
					<th>행사일자</th>
					<th>수정</th>
					<th>삭제</th>
				</tr>
				<?
							for ($i = 0; $i < $row1; $i++){
							$no = mysql_result($result, $i, 0);
							$subject = mysql_result($result, $i, 1);
							$date = mysql_result($result, $i, 2);
							?>
							<tr>
								<td align = 'center'><?echo $no ?></td>
								<td align = 'left'><?echo $subject ?></td>
								<td align = 'center'><?echo $date ?></td>
								<td style="width:60px" align = 'center'><input type='button' value='더보기' onClick="location.href='adreserv_from_mod.php?no=<?=$no?>&page=<?=$page?>'"></td>
								<td style="width:60px" align = 'center'><input type='button' value='삭제' onClick="location.href='reserv_pw.php?no=<?=$no?>'"></td>
							</tr>
							<?
						};
				?>
			</table>
			<div id="paging">
				<? echo $paging?>
			</div>
		<!-- 검색 들어갈 부분 -->
			<div class="search">
				<form action="./reserv_ad.php" method="get">
					<label>
						<select name="searchColumn">
							<option <?php echo $_GET['searchColumn']=='no'?'selected="selected"':null?> value="no">회차</option>
							<option <?php echo $_GET['searchColumn']=='subject'?'selected="selected"':null?> value="subject">제목</option>
						</select></label><input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>"/><button type="submit">검색</button>
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
