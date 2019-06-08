<meta charset="utf-8">
<?
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
		
	$tot_query1="select sum(re_member) total from ticket where ticket = '1' ";
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

	$date=$_POST["date"];
	$option=$_POST["option"];
	$re_member=$_POST["re_member"];
	$re_phone=$_POST["re_phone"];
	$time = date('Y-m-d H:i:s');
	$gno = $_POST['gno'];
	//선택한 티켓 이름 변경  

	if ($option == 1){
		$seltic = "1일권";
	}else{
		if ($re_member == 2){
			$seltic = "2일권";
		}else{
			if ($re_member == 3){
				$seltic = "전일자유";
			};
		};
	};


	if(!$option){
		echo("
			<script>
			window.alert('회차를 선택하세요');
			history.go(-1);
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
  
	if ($tot_op1 = 0){
		echo("
			<script>
			alert('더이상 예매하실 수 없습니다. 다른 상품을 선택해주세요');
			location.href='reserv_form.php';
			</script>
		");
	}else {
				$reserv_sql = "update ticket set  idno = '$id', ticket = '$option', re_member = '$re_member' , re_phone = '$re_phone' where no = '$gno'";
				mysql_query($reserv_sql, $connect);
				echo 
					"<script>
			alert('수정이 완료 되었습니다.');
			location.href='myticket_ad.php';
			</script>";
			}
?>
</body>
</html>
