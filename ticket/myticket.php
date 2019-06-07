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

	$tic_query = "select * from ticket where idno = '$uid' order by no desc";
    $tic_result=mysql_query($tic_query, $connect);
	$tic_row=mysql_num_rows($tic_result);
	
	

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
<body>
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
			<li><a class="tab1" href="../login/my_info.php">나의 정보</a></li>
			<li><a class="tab2" href="myticket.php">나의 예약</a></li>
			<li><a class="tab3" href="../login/drop_form.php">회원 탈퇴</a></li>
		</ul>
		<div class="clear"></div>
		<div class="tab_content">
		<h2>나의 예매</h2>
		<h3>예매 내용을 수정 또는 삭제하실 수 있습니다.<br/>결제 및 티켓 수령은 행사 당일 Ticket box에서 진행합니다.</h3><br/><br/>
		<div class="list table" align='center'>
			<table border='1px' >
				<thead>
					<tr>
						<th align='center'>예매번호</th>
						<th align='center'>회차</th>
						<th align='center'>인원</th>
						<th align='center' width = '300px'>연락처</th>
						<th align='center'>페스티벌날짜</th>
						<?
							if($tic_row !== 0) {
						echo "<th align='center'>수정</th>
						<th align='center'>삭제</th>";
						}
					echo "<script>
					function test(){
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
							if($tic_row == 0) {
						?>
						<tr>
							<td class="no_ticket"colspan="5">고객님 예매하신 내역이 없습니다.</td>
						</tr>
						<?
							} else 
						for ($i = 0; $i < $tic_row; $i++){
						$no1 = mysql_result($tic_result, $i, 0);
						$option1 = mysql_result($tic_result, $i, 2);
						$option2 = mysql_result($tic_result, $i, 3);
						$option3 = mysql_result($tic_result, $i, 4);
						$ticdate = mysql_result($tic_result, $i, 6);
						?>
						<tr class="td_con">
							<td align = 'center'><?echo $no1 ?></td>
							<td align = 'center'><?echo $option1."회" ?></td>
							<td align = 'center'><?echo $option2."명"?></td>
							<td align = 'center'><?echo $option3 ?></td>
							<td align = 'center'><?echo $ticdate ?></td>
							<td style="width:60px" align = 'center'><input type='button' value='수정' onClick="location.href='../ticket/reserv_modiform.php?no=<?=$no1?>'"></td>
							<td style="width:60px" align = 'center'><input type='button' value='삭제' onClick="test()"></td>
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
		</div>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>
