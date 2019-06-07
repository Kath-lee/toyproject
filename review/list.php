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


	$cnt_qurey = "select *  from review where 1 $search";
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

		$page_que = "select * from review where 1 ".$search." order by no desc limit  $from_record, $page_row";
		$result =mysql_query($page_que,$connect);
		$page_arr=mysql_fetch_array($result);
		$row1 = mysql_num_rows($result);

	

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
    <link rel="stylesheet" type="text/css" href="../css/review_list_form.css">
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
			<h2>페스티벌 후기</h2>
			<h3>Uranos와 함께한 여러분들의 이야기를 들려주세요!</h3><br/><br/>
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
									$no = mysql_result($result, $i, 0);
									$subject = mysql_result($result, $i, 3);
									$name = mysql_result($result, $i, 2);
									$datetime = mysql_result($result, $i, 6);
								$date = substr($datetime,0,10);
									$hit = mysql_result($result, $i, 7);
									$file_name = mysql_result($result, $i, 8);
									$file_copied = mysql_result($result, $i, 9);
									$today['date'] = date('H:i:s');
									$img = str_replace($file_copied, img, $file_copied);
									$img = $img;

								$re_qry = "select * from re_review where parent = '$no' order by date desc";
								$re_result = mysql_query($re_qry,$connect);
								$row2 =mysql_num_rows($re_result); 
								$re_num = "(".$row2.")";
						?>
					<tr >
						<td align = 'center'><? echo $no ?></td>
						<td ><a href="./view.php?no=<? echo $no ?>&page=<?=$page?>"><? echo $subject."&nbsp;&nbsp;&nbsp;".$re_num."&nbsp;".$img ?></a>
						</td>
						<td align = 'center'><? echo $name ?></td>
						<td align = 'center'><? echo $date ?></td>
						<td align = 'center'><? echo $hit ?></td>
					</tr>
							<?php
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
					echo "<div class='alink_btn'><a href='write_form.php?page=$page'>게시글작성</a></div>";
				}
			?>		
		<div class="clear"></div>
		<!-- 검색 필드 -->
		<div class="search">
			<form action="list.php" method="get">
				<label><select name="searchColumn">
					<option <?php echo $_GET['searchColumn']=='subject'?'selected="selected"':null?> value="subject">제목</option>
					<option <?php echo $_GET['searchColumn']=='content'?'selected="selected"':null?> value="content">내용</option>
					<option <?php echo $_GET['searchColumn']=='name'?'selected="selected"':null?> value="name">이름</option>
				</select></label><input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>"><button type="submit">검색</button>
			</form>
	</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>