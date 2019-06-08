<meta charset="utf-8">
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
	

	$memb="select * from member where m_id = '$memarr[m_id]'";
	 //  where m_id=$uid
    $result=mysql_query($memb, $connect);
    $row=mysql_fetch_array($result);
    $no = $row[no];

	$tic_query = "select * from ticket where idno = '$memarr[m_id]' order by no desc";
    $tic_result=mysql_query($tic_query, $connect);
	$tic_row=mysql_num_rows($tic_result);
	
	

	?>

    <section>
		<h2>회원 예약 리스트</h2>
		<div class="list table">
			<table border='1px' >
				<thead>
					<tr>
						<th align='center'>예약번호</th>
						<th align='center'>회차</th>
						<th align='center'>인원</th>
						<th align='center'>연락처</th>
						<th align='center'>페스티벌날짜</th>
						<?
							if($tic_row !== 0) {
						echo "<th align='center'>수정</th>
						<th align='center'>삭제</th>";
						}
					
					?>
					
						</tr>
				</thead>
				<tbody>	
						<?
							if($tic_row == 0) {
						?>
						<tr>
							<td class="no_ticket"colspan="5">고객님 예약하신 내역이 없습니다.</td>
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
							location.href='../ticket/memreserv_del.php?no=".$no1."&gid=".$memarr[m_id]."';
							}else{ 
							}};
						</script>"
				?>
				</tbody>	
			</table>
		</div>
    </section>

