<?php
  session_start();
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
	$gno = $_GET[no];
   
	//수정 티켓 확인
	$modsql = "select *  from ticket where no = '$gno'";
	$modresult = mysql_query($modsql, $connect);    
	$modarr=mysql_fetch_array($modresult);
	$no = $modarr[no] ;
	$idno = $modarr[idno];
	$ticket = $modarr[ticket];
	$re_member = $modarr[re_member];
	$re_phone = $modarr[re_phone];
	$name = $modarr[name];
   
	//고객 정보테이블 호출
	$memb="select * from member where m_id = '$uid'";
	$result=mysql_query($memb, $connect);
	$row=mysql_fetch_array($result);
	$id = $row[m_id];
	$phone = $row[m_phone];
	$password = $row[m_pass];

	$total_record = mysql_num_rows($result);

	//잔여 티켓 확인
	$tot_query1="select sum(re_member) total from ticket where ticket = '1' ";
	$tot_con1=mysql_query($tot_query1, $connect);
	$tot_arr1= mysql_fetch_array($tot_con1);
	$tot_op1=500-$tot_arr1[total];

	$tot_query2="select sum(re_member) total from ticket where ticket = '2' ";
	$tot_con2=mysql_query($tot_query2, $connect);
	$tot_arr2= mysql_fetch_array($tot_con2);
	$tot_op2=500-$tot_arr2[total];

	$tot_query3="select sum(re_member) total from ticket where ticket = '3' ";
	$tot_con3=mysql_query($tot_query3, $connect);
	$tot_arr3= mysql_fetch_array($tot_con3);
	$tot_op3=1000-$tot_arr3[total];

	//예약갯수 10개넘을시
	if($totsel > 10){
		echo("
			<script>
			alert('더이상 예매 하실 수 없습니다. \\n 예약 확인 페이지로 이동합니다.');
			location.href='myticket_ad.php';
			</script>
		");
	};
	$resrsql = "select * from ticket where no = '$gno'";
	$resresult=mysql_query($resrsql,$connect);
	$resticarr = mysql_fetch_array($resresult);
	$restic = $resticarr[ticket];
	
	$modsql = "select * from reserlist";
	$modresult = mysql_query($modsql,$connect);
	$modrows = mysql_num_rows($modresult);	

	?>	

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- ticket_form css/script -->
  <link rel="stylesheet" type="text/css" href="../css/ticket_reserve.css">
  <script>
	function validate(){
	if(document.reserv_form.re_phone.value == ""){window.alert('연락처를 입력해주세요.');return;}

	var phoneval = /^[0-9]*$/;
	if(!phoneval.test(document.reserv_form.re_phone.value)){window.alert('영문, 특수문자를 제외한 연락처를 입력해주세요.'); return;}

	document.reserv_form.submit();
  }
</script>
</head>
<bodyclass="a_menu1">
  <div id="wraper">
    <header>
      <?php include "../lib/top_login2.php"; ?>
    </header>
    <nav>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	<div class="clear"></div>
    <section>
		<h2>예약 수정하기</h2>
		<h3>정보 수정 후 [수정하기]버튼 선택하시면, 수정된 정보를 저장합니다.</h3>
		<form name='reserv_form' method='post' action='reserv_mod.php'>
			<div class="ticket_form">
					<div><p class="line_title">티켓선택</p><input type='hidden' name='gno' value='<?echo $gno?>'></input><label><select name='option'>
					<option value=''>회차선택</option>		  
							<?
							for ($i = 0; $i < $modrows; $i++){
							$res = mysql_result($modresult, $i, 0);
								echo"<option value='$res'"?>;
								<? if($restic == $res)
									{ echo " selected='selected'" ;
								echo">$res 회</option>	";
							}
							?><? if($restic== $res)
								{ echo "selected='selected'" ;}
							echo">$res 회</option>	";
							}?>
						</select>
					</label>
					</div>
					<div class="clear"></div>
					<div>
					<p class="line_title">인원</p><label><select name='re_member'>
						<option value=''>선택</option>		  
						<option value='1' <? if($re_member== '1')
						{ echo "selected='selected'" ;}?>>1명</option>
						<option value='2'<? if($re_member == '2')
						{ echo "selected='selected'" ;}?>>2명</option>
						<option value='3'<? if($re_member == '3')
						{ echo "selected='selected'" ;}?>>3명</option>
						<option value='4'<? if($Re_member == '4')
						{ echo "selected='selected'" ;}?>>4명</option>
						<option value='5'<? if($Re_member == '5')
						{ echo "selected='selected'" ;}?>>5명</option>
					</select>  
					</label> 
					</div> 
				<div><p class="line_title">연락처</p><input type='text' name='re_phone' value='<?echo $re_phone?>'></div>
				<div class="subbtn">
					<input type="button" name="button" name="cancel" value="수정 취소하기" onclick="javascript:history.go(-1);" >
				</div>
				<div class="mainbtn">
						<input type="button" name="button" value="수정하기" onclick="javascript:validate();" >
				</div>
			</div>
		</form>	
		<div class="clear"></div>
	</section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>