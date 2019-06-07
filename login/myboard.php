<?php
  session_start();
 
	if(!$_SESSION[ses_uid]){
		echo("
		<script>
		window.alert('로그인 해주세요');
		location.href='../login/login_form.php';
		</script>
		");
	}
	
	$uid = $_SESSION[ses_uid];
	 include "../lib/conn.php";
	

	$memb="select * from member where m_id = '$uid'";
	 //  where m_id=$uid
    $result=mysql_query($memb, $connect);
    $row=mysql_fetch_array($result);
    $no = $row[no];

	$rev_query = "select * from review where idno = '$uid' order by no desc";
    $rev_result = mysql_query($rev_query, $connect);
	$rev_row = mysql_num_rows($rev_result);

	$qna_query = "select * from qna where idno = '$uid' order by num desc";
    $qna_result = mysql_query($qna_query, $connect);
	$qna_row = mysql_num_rows($qna_result);
	
	

	?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- festival_form css/script -->
  <link rel="stylesheet" type="text/css" href="../css/ticket_list.css">
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
    <section class="tab3">	
		<ul id="tab">
			<li><a class="tab1" href="../login/my_info.php">나의 정보</a></li>
			<li><a class="tab2" href="../ticket/myticket.php">나의 예약</a></li>
			<li><a class="tab3" href="myboard.php">나의 게시글</a></li>
			<li><a class="tab4" href="../login/drop_form.php">회원 탈퇴</a></li>
		</ul>
		<div class="clear"></div>
		<div class="tab_content">
		<h2>나의 게시글</h2>
		<h3>게시글을 수정 또는 삭제하실 수 있습니다.</h3><br/><br/>
		<div class="list table" align='center'>
			<table border='1px' >
			<h4>review</h4><!--common.css 스타일추가-->
				<thead>
					<tr>
						<th align='center'>번호</th>
						<th align='center'>제목</th>
						<th align='center'>내용</th>
						<th align='center'>작성일</th>
						<?
							if($tic_row !== 0) {
						echo "<th align='center'>수정</th>
						<th align='center'>삭제</th>";
						}
					echo "<script>
					function test(){
						if(confirm('정말 삭제하시겠습니까?')){
					location.href='../review/delete.php?no=".$no1."';
					}else{ 
					}};
					</script>"
					
					?>
					
						</tr>
				</thead>
				<tbody>	
						<?
							if($rev_row == 0) {
						?>
						<tr>
							<td class="no_ticket"colspan="5">작성한 게시글이 없습니다.</td>
						</tr>
						<?
							} else 
						for ($i = 0; $i < $rev_row; $i++){
						$no1 = mysql_result($rev_result, $i, 0);
						$option1 = mysql_result($rev_result, $i, 3);
						$option2 = mysql_result($rev_result, $i, 4);
						$option3 = mysql_result($rev_result, $i, 6);
						?>
						<tr class="td_con">
							<td align = 'center'><?echo $no1?></td>
							<td class="my_title" align = 'center'><?echo $option1?></td>
							<td class="my_content" align = 'center'><?echo $option2?></td>
							<td align = 'center'><?echo $option3?></td>
							<td style="width:60px" align = 'center'><input type='button' value='수정' onClick="location.href='../review/update_form.php?no=<?=$no1?>'"></td>
							<td style="width:60px" align = 'center'><input type='button' value='삭제' onClick="location.href='../review/delete.php?no=<?=$no1?>'"></td>
						</tr>
						<?
					
						};
						echo "<script>
							function test(){if(confirm('정말 삭제하시겠습니까?')){
							location.href='../ticket/reserv_del.php?no=".$no1."';
							}else{ 
							}};
						</script>"
				?>
				</tbody>	
			</table>


			<table border='1px' >
			<h4>QnA</h4>
				<thead>
					<tr>
						<th align='center'>번호</th>
						<th align='center'>제목</th>
						<th align='center'>내용</th>
						<th align='center'>작성일</th>
						<?
							if($qna_row !== 0) {
						echo "<th align='center'>수정</th>
						<th align='center'>삭제</th>";
						}
					echo "<script>
					function test2(){
						if(confirm('정말 삭제하시겠습니까?')){
					location.href='../ticket/reserv_del.php?no=".$no1."';
					}else{ 
					}};
					</script>"
					
					?>
					
						</tr>
				</thead>
				<tbody>	
						<?
							if($qna_row == 0) {
						?>
						<tr>
							<td class="no_ticket"colspan="5">작성한 게시글이 없습니다.</td>
						</tr>
						<?
							} else 
						for ($i = 0; $i < $qna_row; $i++){
						$no1 = mysql_result($qna_result, $i, 0);
						$option1 = mysql_result($qna_result, $i, 6);
						$option2 = mysql_result($qna_result, $i, 7);
						$option3 = mysql_result($qna_result, $i, 8);
						
						?>
						<tr class="td_con">
							<td align = 'center'><?echo $no1?></td>
							<td class="my_title" align = 'center'><?echo $option1?></td>
							<td class="my_content" align = 'center'><?echo $option2?></td>
							<td align = 'center'><?echo $option3?></td>
							<td style="width:60px" align = 'center'><input type='button' value='수정' onClick="location.href='../qna/update_form.php?num=<?=$no1?>'"></td>
							<td style="width:60px" align = 'center'><input type='button' value='삭제' onClick="location.href='../qna/delete.php?num=<?=$no1?>'"></td>
						</tr>
					
						<?
					
						};
						echo "<script>
							function test2(){if(confirm('정말 삭제하시겠습니까?')){
							location.href='../qna/delete.php?num=".$no1."';
							}else{ 
							}};
						</script>"
				?>
				</tbody>	
			</table>
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>
