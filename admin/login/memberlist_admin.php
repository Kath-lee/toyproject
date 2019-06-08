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
	

		$cnt_qurey = "select *  from member where 1 $search";
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

		$page_que = "select * from member where 1 ".$search." order by reg_date desc limit  $from_record, $page_row";
		$result =mysql_query($page_que,$connect);
		$page_arr=mysql_fetch_array($result);
		$row1 = mysql_num_rows($result);

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
	  function test(){
		  
         if(confirm('정말 삭제하시겠습니까?')){
         
         }else{ 
         }};
         </script>
</head>
<body class="a_menu2">
  <div id="wraper">
    <header>
      <?php include "../lib/top_login2.php"; ?>


    </header>
    <nav>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
    <div class="clear"></div>
    <section class="tab1">	
		<div class="clear"></div>
		<div class="tab_content">
			    <h2>회원 관리</h2>
				<h3><? echo "총 $row 명의 회원이 검색되었습니다.";?></h3><br/><br/>
				<table border='1px'>
					<tr>
						<th align='center'>고객ID</th>
						<th align='center'>고객명</th>
						<th align='center'>휴대폰</th>
						<th align='center'>이메일</th>
						<th align='center'>가입일</th>
						<th align='center'>더보기</th>
						<!--<th align='center'>삭제</th>-->
					</tr>
					<?
				for ($i = 0; $i < $row1; $i++){
				$list_id = mysql_result($result, $i, 0);
				$list_name = mysql_result($result, $i, 2);
				$list_phone = mysql_result($result, $i, 3);
				$list_email = mysql_result($result, $i, 4);
				$list_reg_date =  mysql_result($result, $i, 5);
								$date = substr($list_reg_date,0,10);
				
				
				?>
				<tr>
					<td align='center'><?echo $list_id ?></td>
					<td align='center'><?echo $list_name ?></td>
					<td align='center'><?echo $list_phone ?></td>
					<td style="width:250px"><?echo $list_email ?></td>
					<td align='center' style="width:150px" ><?echo $date ?></td>
					
					
					<td style="width:60px" align='center'><input type='button' value='상세보기' onClick="location.href='memberlist_modify_ad.php?id=<?=$list_id?>&page=<?=$page?>'"></td>
					<!--<td style="width:60px" align='center'><input type='button' value='삭제' onClick="location.href='memberlist_del_ad.php?id=<?=$list_id?>'">-->
		
					<?
					echo "<script>
					function test(){
					location.href='memberlist_del_ad.php?id=".$list_id."&page=".$page."'
					};
					</script>";
					?>
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
							<form action="memberlist_admin.php" method="get">
								<label>
									<select name="searchColumn">
										<option <?php echo $_GET['searchColumn']=='m_id'?'selected="selected"':null?> value="m_id">아이디</option>
										<option <?php echo $_GET['searchColumn']=='m_name'?'selected="selected"':null?> value="m_name">이름</option>
										<option <?php echo $_GET['searchColumn']=='m_phone'?'selected="selected"':null?> value="m_phone">휴대폰</option>
										<option <?php echo $_GET['searchColumn']=='reg_date'?'selected="selected"':null?> value="reg_date">가입일</option>
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
