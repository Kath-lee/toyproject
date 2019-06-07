<?php
  session_start();

	include "../lib/conn.php";

	$uid = $_SESSION[ses_uid];
	if(!$_SESSION['ses_uid']){
	$_SESSION[history] = $_SERVER['REQUEST_URI'];
	}

	$no= $_GET['no'];
	

	$maxticsql = "select sum(re_member) total from ticket where idno = '$uid'";
	$maxresult = mysql_query($maxticsql, $connect);    
	$maxarr=mysql_fetch_array($maxresult);
	$totsel=$maxarr[total];
	if(!$totsel){
		$totsel = 0;
	}
	
	$modsql = "select * from reserlist order by no desc";
	$modresult = mysql_query($modsql,$connect);
	$modrows = mysql_num_rows($modresult);	

	$selsql = "select * from reserlist";
	$selresult = mysql_query($selsql,$connect);
	$selarr=mysql_fetch_array($selresult);
	$stdate = $selarr[stdate];
	$stdate1= substr($stdate,0,4);
	$stdate2= substr($stdate,5,2);
	$stdate3= substr($stdate,8,2);


	
	$memb="select * from member where m_id = '$uid'";
	$result=mysql_query($memb, $connect);
	$row=mysql_fetch_array($result);
	$id = $row[m_id];
	$phone = $row[m_phone];
	$password = $row[m_pass];

	$total_record = mysql_num_rows($result);

	$tot_query1="select sum(re_member) total from ticket where ticket = '$no' ";
	$tot_con1=mysql_query($tot_query1, $connect);
	$tot_arr1= mysql_fetch_array($tot_con1);
	$tot_op1=500-$tot_arr1[total];

	
	if(!$uid){
		echo("
			<script>
			window.alert('로그인 해주세요');
			location.href='../login/login_form.php';
			</script>
		");
	}else{
		echo("
			<script>
			alert('1명당 최대 10매까지 예매 가능합니다. \\n 고객님 현재 예매수는 : $totsel 장입니다.');
			</script>
		");
	};
	if($totsel >= 10){
		echo("
			<script>
			alert('더이상 예매 하실 수 없습니다..');
			location.href='reserv_list.php';
			</script>
		");
	};

		$page_que = "select * from reserlist where 1 ".$search." order by no desc limit  $from_record, $page_row";
	
	

;?>	

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- ticket_form css/script -->
  <link rel="stylesheet" type="text/css" href="../css/ticket_reserve.css">
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
         function totvalidate(totsel){
			 if(Number(document.reserv_form.re_member.value) + Number(totsel) > 10){
        alert('더이상 예매 하실 수 없습니다.');
         }else{
		document.reserv_form.submit();
     }
		 };
         </script>
  <script>
	function validate(){
	if(document.reserv_form.re_phone.value == ""){window.alert('연락처를 입력해주세요.');return;}

	var phoneval = /^[0-9]*$/;
	if(!phoneval.test(document.reserv_form.re_phone.value)){window.alert('영문, 특수문자를 제외한 연락처를 입력해주세요.'); return;}

	document.reserv_form.submit();
  }
</script>
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
		<h2>예약하기</h2>
		<h3>남은 티켓을 확인하시고, 페스티벌을 예매해주세요.<br/><span><?=$no?></span>회차에서&nbsp;예매 가능한 티켓 <span><?echo $tot_op1?></span>장</h3>
		<br><br>
		<p class="info_title">안내사항</p>
		<div class='reser_info'>
			- 1인당 예매하실수 있는 총 티켓수는 10장입니다.<br/>
			- 예매하신 티켓발권은 행사 당일 티켓 부스에 가셔서 예약 번호와 연락처를 말씀해주시면 바로 발권 가능합니다.<br/>
			- 물품 보관함은 티켓부스에서 같이 운영하며 휴대폰, 귀금속 등 귀중품 분실에 대하여 책임 지지않으며 가급적 소지하기를 권장하고 있습니다.<br/>
			- 본 페스티벌은 앉는 자리가 없는 스탠딩 방식이며 발권받은 티켓(팔찌) 를 착용중이시면 언제든지 자유롭게 관람이 가능하십니다.<br/>
			- 예매하신 티켓의 수정은 당일 까지만 한하며 이후에 수정을 불가능합니다.<br/>
		</div>
		<p class="info_title">고객님께서 현재 선택하신 회차는 <strong><?=$no?></strong>회차입니다.</p>
		<br/><p class="info_title">페스티벌 날짜는 <strong><?=$stdate1;?></strong>년 <strong><?=$stdate2;?></strong>월 <strong><?=$stdate3;?></strong>일 입니다.</p>	<br>

		<form name='reserv_form' method='post' action='reserv.php'>
		<div class="ticket_form">
		<input type="hidden" name="option" value="<?=$no?>" >
				<!--<div><p class="line_title">티켓선택</p><label><select name='option'>
				<option value=''>회차선택</option>		  
						<?
						for ($i = 0; $i < $modrows; $i++){
						$res = mysql_result($modresult, $i, 0);
							echo"<option value='$res'"?>;
							<? if($no == $res)
								{ echo " selected='selected'" ;
							echo">$res 회</option>	";
						}
						?><? if($restic== $res)
							{ echo "selected='selected'" ;}
						echo">$res 회</option>	";
						}?>
					</select>
				</label>
				</div>-->
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
			<div class="reserve"><p class="line_title">연락처</p><input type='text' name='re_phone' value='<?echo $phone?>'></div>
			<div class="subbtn">
				<input type="button" name="button" name="cancel" value="예약 취소하기" onclick="javascript:history.go(-1);" >
			</div>
			<div class="mainbtn">
			<input type="button" name="button" value="예매 하기" onclick="javascript:validate();" >
			</div>
		</div>
	</form>	
	<div class="clear"></div>
		<!--<div class="ticket_form">
			<table border='0'>
			<tr>
				<td><span><?=$no?></span>회차에서</td><td>&nbsp;예매 가능한 티켓 <span><?echo $tot_op1?></span>장</td>
			</tr>
			</table>
		
			<form name='reserv_form' method='post' action='reserv.php'>
			<input type='hidden' name='no' value='<?=$no?>'></span>
					<span><?=$no?></span><p class="line_title">회차</p><br/> 이 정보 없어도 괜찮을듯?
						<p class="line_title">인원</p><label><select name='re_member'>
							<option value=''>선택</option>		  
							<option value='1'>1명</option>
							<option value='2'>2명</option>
							<option value='3'>3명</option>
							<option value='4'>4명</option>
							<option value='5'>5명</option>
						</select>
					</label>
					<div class="phone"><p class="line_title">연락처</p><input type='text' name='re_phone' value='<?echo $phone?>' placeholder="안내 가능한 휴대폰 번호 11자리(-제외)를 입력해주세요"></div>
					<div class="reserve_btn"><input type="button" name="button" value="예약하기" onclick="totvalidate(<?=$totsel?>);"/></div>
			</form>
		</div>
		<div class="clear"></div>-->
	</section>
	<div class="clear"></div>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>