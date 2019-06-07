<div id="top_login">
<?php
	session_start();
  include "conn.php";
  

  if(!$_SESSION['ses_uid']){

?><!--0811 로그인 경로/class 수정-->
   <a class="log_m1" href="login/login_form.php">로그인</a><p>&nbsp;&nbsp;|&nbsp;&nbsp;</p><a class="log_m2" href="login/member_form.php">회원가입</a>
<?php
  }else{
?>

  <!-- (level:<?= $_SESSION['ses_ulevel'] ?>)-->
 <?=$_SESSION['ses_uid']."님"?> <p>&nbsp;&nbsp;|&nbsp;&nbsp;</p><a class="log_m1" href="login/logout.php">로그아웃</a><p>&nbsp;&nbsp;|&nbsp;&nbsp;</p>
 <?if($_SESSION['ses_ulevel'] == 3){?><a class="log_m2" href="admin/index.php">관리자페이지로</a>
<?}
else{?>
<a class="log_m2" href="login/my_info.php">나의정보</a><?}?>

<?php
  }
?>
</div>
