<meta charset="utf-8">
<?
	session_start();
	
	include "../lib/conn.php";

	$uid = $_SESSION[ses_uid];
	$no = $_POST[no];
	$date=$_POST["date"];
	$option=$_POST["option"];
	$re_member=$_POST["re_member"];
	$re_phone=$_POST["re_phone"];
	$time = date('Y-m-d H:i:s');
		
	$tot_query1="select sum(re_member) total from ticket where ticket = '$option' ";
	$tot_con1=mysql_query($tot_query1, $connect);
	$tot_arr1= mysql_fetch_array($tot_con1);
	$tot_op1=500-$tot_arr1[total];

	$maxticsql = "select sum(re_member) total from ticket where idno = '$uid'";
	$maxresult = mysql_query($maxticsql, $connect);    
	$maxarr=mysql_fetch_array($maxresult);
	$totsel=$maxarr[total];

	$memb="select * from member where m_id = '".$uid."'";
	$result=mysql_query($memb, $connect);
	$row=mysql_fetch_array($result);

	$name = $row[m_name];
	$id = $row[m_id];

	

	$restot = $totsel + $re_member;

	$datesql = "select * from  reserlist where no = '$option'";
	$dqteresult = mysql_query($datesql,$connect);
	$daterow=mysql_fetch_array($dqteresult);
	$stdate = $daterow['stdate'];
	$stdate1 = substr($stdate,2,2);
	$stdate2 = substr($stdate,5,2);
	$stdate3 = substr($stdate,8,2);

	$nosql = "select count(no) no from ticket dese";
	$noresult = mysql_query($nosql,$connect);
	$noarr=mysql_fetch_array($noresult);
	$reserno = $noarr[no];
	if(!$reserno){
	$reserno = "0";}
	$reserno1 = $reserno+1; 

	$resernumber =  $option.$stdate1.$stdate2.$stdate3.$reserno1;


			if($restot > 10){
		echo("
			<script>
			alert('최대 예매 가능 인원수를 초과 하였습니다. \\n 현재 고객님 예매인원은 $totsel 명 입니다.\\n 나의 예매 화면으로 이동합니다.');
			location.href='../login/re_pw.php';
			</script>
		");
	};

	if(!$uid){
		echo("
			<script>
			window.alert('로그인 해주세요');
			location.href='../login/login_form.php';
			</script>
		");
		exit;
	
	}
	if(!$re_member){
		echo("
			<script>
			alert('인원을  선택해주세요');
			history.go(-1);
			</script>
		");
		exit;
	}
	if(!$re_phone){
		echo("
			<script>
			alert('연락처를 작성해주세요');
			history.go(-1);
			</script>
		");
	exit;
	}
  
	if ($restot = 0){
		echo("
			<script>
			alert('더이상 예매하실 수 없습니다. 다른 상품을 선택해주세요');
			location.href='/reserv_form.php';
			</script>
		");
	}else{
				$reserv_sql = 
				"insert into ticket (no, idno, ticket, re_member, re_phone, name, date) values ('$resernumber', '$id', '$option', '$re_member', '$re_phone', '$name','$stdate')";
				mysql_query($reserv_sql, $connect);
			}
		
	
?>
<?if ($uid){
		echo("
			<script>
			alert('$id 님 예약 감사합니다. 예매 내역으로 이동합니다.');
			location.href='./myticket.php';
			</script>
		");
	}?>

