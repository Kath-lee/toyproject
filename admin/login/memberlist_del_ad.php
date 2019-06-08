<meta charset="utf-8">
<?session_start();
	include "../lib/conn.php";

		$uid = $_SESSION['ses_uid'];
		$ulv = $_SESSION[ses_ulevel];
		 if($ulv !== '3'){
      echo("
         <script>
         window.alert('관리자가 아니면 사용하실 수 없습니다.');
         location.href='../index.php';
         </script>
      ");
   };
		$fid = $_GET['id'];
		$page = $_GET['page'];
		$mode =$_GET['mode'];

		$selname = "select m_id from member where m_id = '$fid'";
		$sql_que = mysql_query($selname,$connect);
		$sql_quearr = mysql_fetch_array($sql_que);
		$sql_name2 = $sql_quearr[m_id];

		$memtk = "select * from ticket where idno = '$memid' and ticket !=''";
		$sql_que2 = mysql_query($memtk,$connect);
		$sql_rows2 = mysql_num_rows($sql_que2);



		if($mode==1){
			$memdel = "delete from member where m_id= '$fid'";
			mysql_query($memdel,$connect);
			echo "<script>location.href='memberlist_admin.php?page=".$page."';</script>";		
		}else{
		
				if($sql_rows2){
			//예약중인 티켓 있을시 예약 리스트로
				echo "<script>
				alert('예약중인 티켓이 있습니다.');
				history.go(-1);
				</script>";
			}else{
				#$memdel = "delete from member where m_id= '$fid'";
				mysql_query($memdel,$connect);
				echo "<script>if(confirm('정말로 삭제하시겠습니까?')){location.href='memberlist_del_ad.php?mode=1&id=".$fid."';}else{location.href='memberlist_modify_ad.php?id=".$fid."&page=".$page."';}</script>";
				}
		}


mysql_close($connect);
?>
