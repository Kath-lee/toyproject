<meta charset="utf-8">
<?
session_start();
include "../lib/conn.php";

$uid = $_SESSION[ses_uid];
$no = $_GET['no'];

$cnt_qurey = "select *  from review where 1 $search";
$cnt_result = mysql_query($cnt_qurey,$connect);
$row =mysql_num_rows($cnt_result);

$re_qry = "select * from re_review where parent = '$no' order by date desc";
$re_result = mysql_query($re_qry,$connect);
$row1 =mysql_num_rows($re_result); 

echo
"<script>
  function check_input1(){
    if(!document.re_board_form.content.value){
      alert('내용을 입력하세요');
      document.board_form.content.focus();
      return;
    }
  if(".$row1." > 10){
      alert('더이상 댓글을 작성하실 수 없습니다.');
	 location.href= 'view.php?no=".$no."';
      return;
    }
    document.re_board_form.submit();
  }
  </script>";

  echo
"<script>
  function check_input2(){
    if(!document.reple_modi_form.content.value){
      alert('수정할 내용을 입력하세요.');
      document.reple_modi_form.content.focus();
      return;
    }
    document.reple_modi_form.submit();
  }
  </script>";
?>
	<input type="button" onClick=" location.href='./view.php?mode=ripple&no=<?=$no?>'" value="덧글 달기"/>
	<?if($_GET['mode'] == ripple ){?>
	<input type="button" onClick=" location.href='./view.php?mode=no&no=<?=$no?>'" value="덧글 접기"/>
        <form name="re_board_form" method="post" action="re_write.php" enctype="multipart/form-data">
			<input type="hidden" name="no" value="<?=$no?>">
			<p class="title_sub">아이디 | <strong><?=$uid?></strong>
			<div class="reple_input">
				<textarea rows="2" cols="80" name="content"><?=$item_content?></textarea><input type="button" onclick="check_input1()" value="마무리">
			</div>
			<div clear="both"></div>
		</form><!--form re_board_form-->
	<?}?>	
			<?
			if($row1 == 0) {
			?>
				<div class="noreple">
				덧글이 없습니다.
				</div>
			<?
				} else { 
			for ($i = 0; $i < $row1; $i++){
			$number = mysql_result($re_result, $i, 0); 
			$id = mysql_result($re_result, $i, 2);
			$content = mysql_result($re_result, $i, 5);
			$date = mysql_result($re_result, $i, 6);
			$inum = $i + 1;
			?>
						<div class="reple">
							<p class="title_sub"><strong>&nbsp;<?=$inum?></strong>&nbsp;<?=$id?>&nbsp;|&nbsp;<?=$date?></p>
							<div class="reple_con"><?=$content?></div>
							<?
							if($uid == $id){?>
								<div class="reple_btn">
								<input type="button" onClick=" location.href='./view.php?num=<?=$number?>&no=<?=$no?>' " value="수정하기"/>
								<?}?>
								<?if($uid == $id){?><input type="button" onClick="test(<?=$number?>)" value="삭제하기"/>
									<?echo   "<script>
									function test(num){
									if(confirm('정말 삭제하시겠습니까?')){
									location.href='./reple_del.php?num='+num+'&no=".$no."';
									}else{ 
									}};
									</script>"?>
								</div><!--div reple_btn-->
						<? } ?>
							<?if($_GET['num'] == $number){
								echo ('<form name="reple_modi_form" method="post" action="reple_modi.php?num='.$number.'">
										  <div class="reple_modi_form">
											<input type = "hidden" name="no" value='.$no.'></input>
											<div class="reple_input"><textarea rows="2" name="content">'.$content.'</textarea></div>
											<p class="title_sub"></p>&nbsp;
										
											<input  type="button" onclick="check_input2()" value="수정하기" />
										  </div>
										  <div clear="both"></div>
										</form> 
								
									');
								$display ="display:none;";}?>
						</div><!--div reple-->
				<?php } ?>
			<?php } ?>






	

