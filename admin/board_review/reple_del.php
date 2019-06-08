<meta charset="utf-8">
<?php
 session_start();
$uid = $_SESSION[ses_uid];
$no = $_GET['no'];
$num =  $_GET['num'];
 $ulv = $_SESSION[ses_ulevel];

	if($ulv !== '3'){
		echo("
			<script>
			window.alert('관리자가 아니면 사용하실 수 없습니다.');
			location.href='../index.php';
			</script>
		");
	};
 include "../lib/conn.php";


//글 삭제
	
		$del_sql = 'delete from re_review where no = ' . $num;
		$del_result = mysql_query($del_sql, $connect);
		echo "<script>
         alert('삭제 되었습니다.');
         location.href='view.php?no=".$no."';
         </script>";

?>