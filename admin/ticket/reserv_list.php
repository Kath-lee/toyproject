<?php
  session_start();
		
		include "../lib/conn.php";
		include "../lib/paging.php";
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
</head>
<body class="a_menu1">
  <div id="wraper">
    <header>
      <?php include "../lib/top_login2.php"; ?>
    </header>
    <nav>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
    <section>
	<!-- 삽입 -->
	<div align = 'center'>
     <h3>페스티벌 목록</h3>
<? echo "총 $row 개의 항목이 검색되었습니다.";?>
	<table border='1px' >
		<tr align = 'center'>
			<td > 회차 </td>
			<td width='360px'> 제목</td>
			<td >행사일자</td>
			<td >예약하기</td>
		</tr>
		<?
			for ($i = 0; $i < $row1; $i++){
				$no = mysql_result($result, $i, 0);
				$subject = mysql_result($result, $i, 1);
				$date = mysql_result($result, $i, 2);
				?>
				<tr align = 'center'>
					<td><?echo $no ?></td>
					<td><?echo $subject ?></td>
					<td><?echo $date ?></td>
					<td><input type='button' value='예약하기' onClick="location.href='reserv_form.php?no=<?=$no?>'"></td>
				</tr>
				<?
			};
		?>
	</table>
	<div id="paging">
		<? echo $paging?>
	</div>
		<!-- 검색 들어갈 부분 -->
			<div>
				<form action="./reserv_ad.php" method="get">
					<select name="searchColumn">
						<option <?php echo $_GET['searchColumn']=='no'?'selected="selected"':null?> value="no">회차</option>
						<option <?php echo $_GET['searchColumn']=='subject'?'selected="selected"':null?> value="subject">이름</option>
					</select>
					<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
					<button type="submit">검색</button>
				</form>
			</div>
			<a href='myticket.php'>나의예약 리스트</a>
		</div>
	</section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>