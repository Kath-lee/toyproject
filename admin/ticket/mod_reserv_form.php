<meta charset="utf-8">
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

	$memb="select * from member where m_id = '$uid'";
    $result=mysql_query($memb, $connect);
    $row=mysql_fetch_array($result);
    $id = $row[m_id];
	$phone = $row[m_phone];
	$password = $row[m_pass];


	$total_record = mysql_num_rows($result);

    $tot_query1="select sum(re_member) total from ticket where re_member = '1' ";
    $tot_con1=mysql_query($tot_query1, $connect);
    $tot_arr1= mysql_fetch_array($tot_con1);
	$tot_op1=500-$tot_arr1[total];

	$tot_query2="select sum(re_member) total from ticket where re_member = '2' ";
    $tot_con2=mysql_query($tot_query2, $connect);
    $tot_arr2= mysql_fetch_array($tot_con2);
	$tot_op2=500-$tot_arr2[total];

    $tot_query3="select sum(re_member) total from ticket where re_member = '3' ";
    $tot_con3=mysql_query($tot_query3, $connect);
    $tot_arr3= mysql_fetch_array($tot_con3);
	$tot_op3=1000-$tot_arr3[total];


?>


<div align='center'>
잔여 티켓 확인
<table border='1px'>
<tr>
<td>1일차 자유이용권</td><td><?echo $tot_op1?>명</td>
</tr>
<tr>
<td>2일차 자유이용권</td><td><?echo $tot_op2?>명</td>
</tr>
<tr>
<td>전일 자유이용권</td><td><?echo $tot_op3?>명</td>
</tr>
</table>
</div>
<br><br>


<?
 $uid = $_SESSION[ses_uid];
$memb="select * from member where m_id = '$uid'";
	 //  where m_id=$uid
    $result=mysql_query($memb, $connect);
    $row=mysql_fetch_array($result);
    $no = $row[no];

	echo $tic_row;



	$tic_query = "select * from ticket where idno = '$uid'";
    $tic_result=mysql_query($tic_query, $connect);
	$tic_row=mysql_num_rows($tic_result);

	
	
	
	
	echo	"<div id='reservation' align='center'>
	티켓 수정
			<form name='reserv_form' method='post' action='reserv.php'>
				<div align='center'>
			         <span>티켓선택</span>
		   				 <select name='option'>
					     <option value=''>티켓선택</option>		  
					     <option value='1'>1일차 자유이용권</option>
	  				     <option value='2'>2일차 자유이용권</option>
						 <option value='3'>전일 자유이용권</option>
						 </select>
			     	 <span>인원</span>
					 <select name='re_member'>
					     <option value=''>선택</option>		  
					     <option value='1'>01</option>
	  				     <option value='2'>02</option>
						 <option value='3'>03</option>
						 <option value='4'>04</option>
					</select>    
						<span>명</span>
					 <span>연락처</span>
				        <span><input type='text' name='re_phone' value='$phone'></input></span>
						 <span>연락처</span>
				  	</div>
				<div align='center'>
					<input type='submit' value='예약하기'></input></div>
				</div>
		</div>
			  </form>"
			  ?>