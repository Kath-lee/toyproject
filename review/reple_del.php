<meta charset="utf-8">
<?php
 session_start();
$uid = $_SESSION[ses_uid];
$no = $_GET['no'];
$num =  $_GET['num'];
 
 include "../lib/conn.php";

if(!$uid){
	echo("
	<script>
		alert('로그인 하셔야 합니다.');
		location.replace('../login/login_form.php');
	</script>
	");
 };

//글 삭제
	
		$del_sql = 'delete from re_review where no = ' . $num;
		$del_result = mysql_query($del_sql, $connect);
		echo "<script>
         alert('삭제 되었습니다.');
         location.href='view.php?no=".$no."';
         </script>";

?>