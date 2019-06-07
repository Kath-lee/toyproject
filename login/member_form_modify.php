<?	session_start();
		$uid = $_SESSION['ses_uid'];
		if(!$uid){
		echo("
		<script>
		window.alert('로그인 해주세요');
		location.href='login_form.php';
		</script>
		");
	};
	include "../lib/conn.php";
	$uid = $_SESSION[ses_uid];
	$sql = "select * from member where m_id = '$uid'";
	$result = mysql_query($sql,$connect);
	$memarr = mysql_fetch_array($result);
	
	?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- festival_form css/script -->
  <link rel="stylesheet" type="text/css" href="../css/member_form.css">
  <!--우편번호-->
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


<script>
	function validate(){
	
	
		//빈문자열 검사
		if(document.member_form_modify.fpasswd.value == ""){window.alert('변경할 비밀번호를 입력해주세요.');return;}
		if(document.member_form_modify.fpasswd_re.value == ""){window.alert('변경할 비밀번호를 다시 입력해주세요.');return;}
		if(document.member_form_modify.fname.value == ""){window.alert('이름을 입력해주세요.');return;}
		if(document.member_form_modify.fphone.value == ""){window.alert('휴대폰번호를 입력해주세요.');return;}
		if(document.member_form_modify.femail.value == ""){window.alert('이메일을 입력해주세요.');return;}
		if(document.member_form_modify.fpostcode1.value == ""){window.alert('주소를 입력해주세요.');return;}
		if(document.member_form_modify.fdetailaddr.value == ""){window.alert('상세주소를 입력해주세요.');return;}
	
	
	//비밀번호
	var pwval = /^[a-zA-Z0-9]*$/;
	if(!pwval.test(document.member_form_modify.fpasswd.value)){window.alert('비밀번호는 최대 16자 대,소문자,숫자,특수기호만 입력가능합니다.'); return;}
	
	
	//비번 일치
	if(document.member_form_modify.fpasswd.value != document.member_form_modify.fpasswd_re.value){window.alert('비밀번호가 일치하지 않습니다.'); return;}

	//이름
	var nameval = /[가-힣a-zA-Z]$/g;
	if(!nameval.test(document.member_form_modify.fname.value)){window.alert('이름은 한글,영문 10자리 입력가능합니다.'); return;}
	
	//휴대폰
	var phoneval = /^[0-9]*$/;
	if(!phoneval.test(document.member_form_modify.fphone.value)){window.alert('-제외한 11자리를 입력해주세요.'); return;}

	//이메일
	var emailval = /^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$/;
	if(!emailval.test(document.member_form_modify.femail.value)){window.alert('이메일 형식이 올바르지 않습니다.\nex) example@mail.com'); return;}

	//상세주소
	var detailaddrval = /^[]*$/;
	if(detailaddrval.test(document.member_form_modify.fdetailaddr.value)){window.alert('특수문자를 사용할수 없습니다.'); return;}

	document.member_form_modify.submit();
	}

	function drop() {
		location.href="drop_form.php";
	}

	</script>
</head>
<body class="a_menu2">
  <div id="wraper">
    <header>
     <nav>
	 <?php include "../lib/top_login2.php"; ?>
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	 </header>
    <div class="clear"></div>
    <section class="tab1">	
		<ul id="tab">
			<li><a class="tab1" href="my_info.php">나의 정보</a></li>
			<li><a class="tab2" href="../ticket/myticket.php">나의 예약</a></li>
			<li><a class="tab3" href="drop_form.php">회원 탈퇴</a></li>
		</ul>
		<div class="clear"></div>
		<div class="tab_content">
   		<h2>나의 정보</h2>
      	<h3>정보 수정 후 [수정하기]버튼 선택하시면, 수정된 정보를 저장합니다.</h3>
		<form name="member_form_modify" action="member_form_modify_action.php" method="post">
			<div class="input_400px">
				<p>아이디</p><span><?echo $memarr[m_id];?></span><br/>
				<p>비밀번호 수정</p><input type="password" name="fpasswd" id="fpasswd" placeholder="최대 16자 대,소문자,숫자, 특수기호를 사용해주세요." size="12" maxlength="10"value="<?echo $memarr[m_pass];?>"><br/>
				<p>비밀번호 확인</p><input type="password" name="fpasswd_re" id="fpasswd_re" placeholder="사용할 비밀번호를 다시 입력해주세요."size="12" maxlength="10" value="<?echo $memarr[m_pass];?>"><br/>
				<p>이름</p><input type="text" name="fname" id="fname" size="12" maxlength="10" value="<?echo $memarr[m_name];?>"> <br/>
				<p>휴대폰</p><input type="text" name="fphone" id="fphone" placeholder= "- 제외한 휴대폰 번호 11자리를 입력해주세요." size="12" maxlength="11" value="<?echo $memarr[m_phone];?>"><br/>
				<p>이메일</p><input type="email" name="femail" placeholder="아이디나 비밀번호 찾기에 사용할 이메일을 입력해주세요." size="30" maxlength="30" value="<?echo $memarr[m_email];?>"> <br/>
			</div>
			<div class="input_190px">
				<p>주소</p><input type="text" name="fpostcode1" id="sample4_postcode1" value="<?echo $memarr[m_postcode1];?>"><p class="dashline" >-</p><input type="text" name="fpostcode2" id="sample4_postcode2" value="<?echo $memarr[m_postcode2];?>">
				<input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기">
			</div>
			<div class="input_400px2">
				<input type="text" name="froadaddr" id="sample4_roadAddress" placeholder="[우편번호 찾기]로 도로명주소를 입력해주세요." value="<?echo $memarr[m_roadaddr];?>">
				<input type="text" name="fjibunaddr" id="sample4_jibunAddress" placeholder="[우편번호 찾기]로 지번주소를 입력해주세요." value="<?echo $memarr[m_jibunaddr];?>">
				<input type="text" name="fdetailaddr" id="detailaddr" placeholder="나머지 주소를 직접 입력해주세요." size="30" value="<?echo $memarr[m_detailaddr];?>">
			</div>
			<span id="guide" style="color:#999"></span>
			<div class="subbtn">
				<!--<input type="reset" name="reset" value="내용 비우기"/>-->
				<input type="button" name="button" name="cancel" value="수정 취소하기" onclick="location.href='./my_info.php'"> <input type="button" name="button" value="수정하기" onclick="javascript:validate();">
				<!--<input type="button" name="button" value="탈퇴하기" onclick="javascript:drop();">-->
			</div>
			<div class="clear"></div>
		</form>

    </section>
    <footer>
        <?php include "../lib/footer.php"; ?>
    </footer>
  </div>
</body>
</html>
