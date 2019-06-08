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
	

	//$cnt_result = $db->query('select count(n_no) as cnt from notice where 1'.$search);
	//$row = $cnt_result->fetch_assoc();

	$cnt_qurey = "select *  from ticket where 1 $search";
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
	//$paging = paging($page, $page_row, $page_scale, $row[cnt], $paging_search);
	//$result = $db->query("select n_no, n_title, m_id, n_reg_day, n_upd_day, n_hit from notice where 1".$search." order by n_no desc limit  ".$from_record.", ".$page_row);

// paging 함수 호출
		$paging = paging($page, $page_row, $page_scale, $row, $paging_search);

		$page_que = "select * from ticket where 1 ".$search." order by date desc limit  $from_record, $page_row";
		$result =mysql_query($page_que,$connect);
		$page_arr=mysql_fetch_array($result);
		$row1 = mysql_num_rows($result);

	
	//$str = $_SERVER["PHP_SELF"];
	//echo strpos($_SERVER['PHP_SELF'], "notice");

	

//--------------------------------------------------------------------------------------
		
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- festival_form css/script -->
  <link rel="stylesheet" type="text/css" href="../css/ticket_list.css">
  <script>
			function test(no1){
			if(confirm('정말 삭제하시겠습니까?')){
			location.href='reserv_del.php?no='+no1;
			}else{ 
			}};
			</script>
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
    <section class="tab1">	
		<ul id="tab">
			<li><a class="tab1" href="myticket_ad.php">페스티벌 예약 현황</a></li>
			<li><a class="tab2" href="reserv_ad.php">페스티벌 등록</a></li>
		</ul>
		<div class="clear"></div>
		<div class="tab_content">
			<h2>페스티벌 예약 현황</h2>
			<h3><? echo "총 $row 개의 항목이 검색되었습니다.";?></h3><br/><br/>
				<table border='1px'>
					<tr>
						<th align='center'>예약번호</th>
						<th align='center'>고객ID</th>
						<th align='center'>고객명</th>
						<th align='center'>티켓</th>
						<th align='center'>인원</th>
						<th align='center'>연락처</th>
						<th align='center'>수정</th>
						<th align='center'>삭제</th>
					</tr>
					<?
						for ($i = 0; $i < $row1; $i++){
							$no = mysql_result($result, $i, 0);
							$idno = mysql_result($result, $i, 1);
							$ticket = mysql_result($result, $i, 2);
							$member = mysql_result($result, $i, 3);
							$mephone=  mysql_result($result, $i, 4);
							$memname =  mysql_result($result, $i, 5);
							$fedate = mysql_result($result, $i, 6);
					
							?>
							<tr>
								<td align='center'><?echo $no ?></td>
								<td align='center'><?echo $idno ?></td>
								<td align='center'><?echo $memname ?></td>
								<td align='center'><?echo $ticket."회" ?></td>
								<td align='center'><?echo $member ?></td>
								<td align='center'><?echo $mephone ?></td>
								<td style="width:60px" align='center'><input type='button' value='수정' onClick="location.href='reserv_modiform.php?no=<?=$no?>'"></td>
								<td style="width:60px" align = 'center'><input type='button' value='삭제' onClick="test(<?=$no?>)"></td>
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
							<form action="myticket_ad.php" method="get">
								<label>
									<select name="searchColumn">
										<option <?php echo $_GET['searchColumn']=='ticket'?'selected="selected"':null?> value="ticket">티켓</option>
										<option <?php echo $_GET['searchColumn']=='idno'?'selected="selected"':null?> value="idno">아이디</option>
									</select></label><input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>"><button type="submit">검색</button>
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
