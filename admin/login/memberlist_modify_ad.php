<?php
  session_start();
  include "../lib/conn.php";

$id=$_GET['id'];
$page = $_GET[page];
$ulv = $_SESSION[ses_ulevel];
   if($ulv !== '3'){
      echo("
         <script>
         window.alert('관리자가 아니면 사용하실 수 없습니다.');
         location.href='../index.php';
         </script>
      ");
   };
$sql = "select * from member where m_id = '$id'";
$result = mysql_query($sql,$connect);
$memarr = mysql_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival/관리자 페이지</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- member css/script -->
  <link rel="stylesheet" type="text/css" href="../css/member_form.css">
</head>
<body class="a_menu2">
  <div id="wraper">
    <header>
      <?php include "../lib/top_login2.php"; ?>
    </header>
    <nav>
      <?php include "../lib/top_menu2.php"; ?>
	  <div class="clear"></div>
    </nav>
    <section>
	<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
     <script>
    function sample4_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 도로명 조합형 주소 변수

                // 법정동명이 있을 경우 추가한다.
                if(data.bname !== ''){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있을 경우 추가한다.
                if(data.buildingName !== ''){
                    extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }
                // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                if(fullRoadAddr !== ''){
                    fullRoadAddr += extraRoadAddr;
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById("sample4_postcode1").value = data.postcode1;
                document.getElementById("sample4_postcode2").value = data.postcode2;
                document.getElementById("sample4_roadAddress").value = fullRoadAddr;
                document.getElementById("sample4_jibunAddress").value = data.jibunAddress;

                // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                if(data.autoRoadAddress) {
                    //예상되는 도로명 주소에 조합형 주소를 추가한다.
                    var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                    document.getElementById("guide").innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';

                } else if(data.autoJibunAddress) {
                    var expJibunAddr = data.autoJibunAddress;
                    document.getElementById("guide").innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';

                } else {
                    document.getElementById("guide").innerHTML = '';
                }
            }
        }).open();
    }
</script>

	</head>
	<body>
	<h2>회원정보 보기</h2>
	<!--<h3>관리자가 일부 회원정보 직접 수정할 수 있습니다.</h3>--><br/><br/>
	<form name="member_list" action="memberlist_modify_ad_action.php?id=<?=$memarr[m_id];?>" method="post">
		<div class="input_400px">
			<p>아이디</p><span><?echo $memarr[m_id];?></span><br/>
			<!--<p>비밀번호 수정</p><input type="password" name="fpasswd" id="fpasswd" size="12" maxlength="10"value="<?echo $memarr[m_pass];?>"> <br />
			<p>비밀번호 확인</p><input type="password" name="fpasswd_re" id="fpasswd_re" size="12" maxlength="10" value="<?echo $memarr[m_pass];?>"> <br />-->
			<p>이름</p><input type="text" name="fname" id="fname" size="12" maxlength="10" value="<?echo $memarr[m_name];?>"> <br />
			<p>휴대폰</p><input type="text" name="fphone" id="fphone" size="12" maxlength="11" value="<?echo $memarr[m_phone];?>" > <br />
			<p>이메일</p><input type="email" name="femail" size="30" maxlength="30" value="<?echo $memarr[m_email];?>"> <br />
		</div>
		<div class="input_190px">
			<p>주소</p><input type="text" name="fpostcode1" id="sample4_postcode1" value="<?echo $memarr[m_postcode1];?>"><p class="dashline">-</p><input type="text" name="fpostcode2" id="sample4_postcode2" value="<?echo $memarr[m_postcode2];?>" ><input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기">
			</div>
			<div class="input_400px2">
			<input type="text" name="froadaddr" id="sample4_roadAddress" placeholder="[우편번호 찾기]로 도로명주소를 입력해주세요"  value="<?echo $memarr[m_roadaddr];?>"><br>
				<input type="text" name="fjibunaddr" id="sample4_jibunAddress" placeholder="[우편번호 찾기]로 지번주소를 입력해주세요"  value="<?echo $memarr[m_jibunaddr];?>" >
				<input type="text" name="fdetailaddr" id="detailaddr" placeholder="나머지 주소를 직접 입력해주세요" size="30" value="<?echo $memarr[m_detailaddr];?>" >
			</div>
			<span id="guide" style="color:#999"></span>
			<div class="mainbtn">
				<!--<input type="reset" name="reset" value="내용 비우기"/>-->
				<input type="button" name="button" name="cancel" value="목록으로" onclick="location.href='memberlist_admin.php?page=<?=$page?>'" ><input type="submit" name="submit" value="수정하기" ><input type="button" name="button" value="삭제하기" onClick="location.href='memberlist_del_ad.php?id=<?=$id?>'">
			</div>
	</form>
	<div class="clear"></div>
	</form>
<?
include "../ticket/memticket.php"
?>
    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>