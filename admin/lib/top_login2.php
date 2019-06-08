<div id="top_login">
<?php
  include "conn.php";
  $userid = $_SESSION["userid"];
  $usernick = $_SESSION["usernick"];
  $userlevel = $_SESSION["userlevel"];

  if(!$userid){
?>
    <a class="log_m1" href="../login/logout_admin.php">로그아웃</a><p>&nbsp;&nbsp;|&nbsp;&nbsp;</p><a class="log_m2" href="../../index.php">회원페이지로</a>
<?php
  }
?>
</div>