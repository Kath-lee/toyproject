<?php
  session_start();
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
	$no = $_GET[no];

	include "../lib/conn.php";

	$maxticsql = "select sum(re_member) total from ticket where idno = '$uid'";
	$maxresult = mysql_query($maxticsql, $connect);    
	$maxarr=mysql_fetch_array($maxresult);
	$totsel=$maxarr[total];
	if(!$totsel){
		$totsel = 0;
	}


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
			location.href='./login/login_form.php';
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
			alert('더이상 예매 하실 수 없습니다. \\n 예약 확인 페이지로 이동합니다.');
			location.href='../login/member_form_modify_tab.php';
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
		<h2>예약하기</h2>
		<h3>남은 티켓을 확인하시고, 페스티벌을 예약해주세요.</h3>
		<br><br>
		<div class="ticket_form">
			<table border='0'>
			<tr>
				<td><span><?=$no?></span>회차에서</td><td>&nbsp;예매 가능한 티켓 <span><?echo $tot_op1?></span>장</td>
			</tr>
			</table>
		
			<form name='reserv_form' method='post' action='reserv.php'>
			<input type='hidden' name='no' value='<?=$no?>'></span>
					<!--<span><?=$no?></span><p class="line_title">회차</p><br/> 이 정보 없어도 괜찮을듯?-->
						<p class="line_title">인원</p><label><select name='re_member'>
							<option value=''>선택</option>		  
							<option value='1'>1명</option>
							<option value='2'>2명</option>
							<option value='3'>3명</option>
							<option value='4'>4명</option>
							<option value='5'>5명</option>
						</select>
					</label>
					<div><p class="line_title">연락처</p><input type='text' name='re_phone' value='<?echo $phone?>' placeholder="안내 가능한 휴대폰 번호 11자리(-제외)를 입력해주세요"></div>
					<div class="reserve"><input type='submit' value='예약하기'></input></div>
			</form>
		</div>
		<div class="clear"></div>
	</section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>