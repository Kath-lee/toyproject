<?php 
 session_start();
 $uid = $_SESSION[ses_uid];
 $ulv = $_SESSION['ses_ulevel'];
    if(!$_SESSION['ses_uid']){
		$_SESSION['history'] = $_SERVER['REQUEST_URI'];
		}
 
 include "../lib/conn.php";
 include "../lib/paging.php";

 if(!$uid){
  echo("
	<script>
		alert('로그인 하셔야 합니다.');
		location.replace('../login/login_form.php');
	</script>
    ");
};

	$search = "";
	if($_GET['searchText']){
		$search = " and ".$_GET['searchColumn']." like '%".$_GET['searchText']."%'";
	}
	

	//$cnt_result = $db->query('select count(n_no) as cnt from notice where 1'.$search);
	//$row = $cnt_result->fetch_assoc();

	$cnt_qurey = "select *  from qna where 1 $search";
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

		$page_que = "select * from qna where 1 ".$search." order by num desc limit  $from_record, $page_row";
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
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <link rel="stylesheet" type="text/css" href="../css/qna_list_form.css">
</head>
<body>
  <div id="wraper">
    <header>
    <nav>
	  <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	 </header>
    <section>
		<h2>페스티벌 문의</h2>
		<h3>여러분의 궁금증을 풀어드립니다!</h3><br/><br/>
		<table border="1">
			<thead>
				<tr>
					<th style="width:60px">번호</th>
					<th>제목</th>
					<th style="width:110px">작성자</th>
					<th style="width:110px">작성일</th>
					<th style="width:60px">조회수</th>
				</tr>
			</thead>
			<tbody>
						<?php
							for ($i = 0; $i < $row1; $i++){
								$num = mysql_result($result, $i, 0);
								$idno = mysql_result($result, $i, 1);
								$group_num = mysql_result($result, $i, 2);
								$depth = mysql_result($result, $i, 3);
								$password = mysql_result($result, $i, 4);
								$name = mysql_result($result, $i, 5);
								$subject = mysql_result($result, $i, 6);
								$content = mysql_result($result, $i, 7);
								$datetime = mysql_result($result, $i, 8);
								$date = substr($datetime,0,10);
								$hit = mysql_result($result, $i, 9);
							
						?>
				<tr>
					<td align='center'><? echo $num ?></td>
					<td><a href="./view.php?num=<? echo $num ?>&page=<?=$page?>
"><? echo $subject ?></a>
					</td>
					<td align='center'><? echo $name ?></td>
					<td align='center'><? echo $date ?></td>
					<td align='center'><? echo $hit ?></td>
				</tr>
						<?php
						$re_sql = "select * from re_qna where parent = '$num'";
						$re_result = mysql_query($re_sql, $connect);
						$re_row = mysql_fetch_array($re_result);
						$re_no = $re_row[no];
						$re_subject = $re_row[subject];
						$re_datetime = $re_row[date];
								$re_date = substr($datetime,0,10);
						if($re_subject){
							echo "<tr>
							<td></td>
							<td><a href='./re_view.php?no=$re_no&page=$page'>└[RE]$re_subject</a></td>
							<td align='center'>$re_row[name]</td>
							<td align='center'>$re_date</td>
							<td></td>
							</td>";
						}
							}
						?>
			</tbody>
		</table>
		<div id='paging'>
			<? echo $paging ?>
		</div>
		<?	
			$write = 'location.href="write_form.php"';
			if($uid){
			echo "<div class='alink_btn'><a href='write_form.php'>게시글작성</a></div>";
			}
		?>
	<!-- 검색 필드 -->
		<div class="search">
			<form action="list.php" method="get">
				<label><select name="searchColumn">
					<option <?php echo $_GET['searchColumn']=='subject'?'selected="selected"':null?> value="subject">제목</option>
					<option <?php echo $_GET['searchColumn']=='content'?'selected="selected"':null?> value="content">내용</option>
					<option <?php echo $_GET['searchColumn']=='name'?'selected="selected"':null?> value="name">이름</option>
				</select></label>
				<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
				<button type="submit">검색</button>
			</form>
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>