<?php
  session_start();
	include "../lib/conn.php";
	$uid = $_SESSION['ses_uid'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- member_form css/script -->
  <link rel="stylesheet" type="text/css" href="../css/member_form.css">
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
	if(document.member_form.fuserid.value == ""){window.alert('아이디를 입력해주세요.');return;}
	if(document.member_form.fpasswd.value == ""){window.alert('비밀번호를 입력해주세요.');return;}
	if(document.member_form.fpasswd_re.value == ""){window.alert('비밀번호를 다시 입력해주세요.');return;}
	if(document.member_form.fname.value == ""){window.alert('이름을 입력해주세요.');return;}
	if(document.member_form.fphone.value == ""){window.alert('휴대폰번호를 입력해주세요.');return;}
	if(document.member_form.femail.value == ""){window.alert('이메일을 입력해주세요.');return;}

	//아이디 유효성 검사
	var idval = /^[a-z][a-z0-9]{3,11}$/; //첫 글자는 반드시 영문 소문자, 4~12자, 숫자하나이상포함
	if(!idval.test(document.member_form.fuserid.value)){window.alert('아이디는 최대 20자 영문,소문자,숫자, 특수기호 (_)(-)만 사용가능합니다.'); return;}
	
	//비밀번호
	var pwval = /^[@_-~!#%&*+()a-zA-Z0-9]{6,}$/;//소문자+숫자 6~16자?
	if(!pwval.test(document.member_form.fpasswd.value)){window.alert('비밀번호는 최대 16자 대,소문자,숫자,특수기호만 입력가능합니다.'); return;}
	
	
	//비번 일치
	if(document.member_form.fpasswd.value != document.member_form.fpasswd_re.value){window.alert('비밀번호가 일치하지 않습니다.'); return;}

	//이름
	var nameval = /^[가-힣a-zA-Z]{2,}$/g;//최소2자 이상
	if(!nameval.test(document.member_form.fname.value)){window.alert('이름은 한글,영문 10자리 입력가능합니다.'); return;}

	
	//휴대폰
	var phoneval = /^[0-9]*$/;
	if(!phoneval.test(document.member_form.fphone.value)){window.alert('-제외한 11자리를 입력해주세요.'); return;}

	//이메일
	var emailval = /^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$/;
	if(!emailval.test(document.member_form.femail.value)){window.alert('이메일 형식이 올바르지 않습니다.\nex) example@mail.com'); return;}
	
	document.member_form.submit();
	}

	function check_id(){
		if(!document.member_form.fuserid.value){window.alert('아이디를 입력하세요'); return;}
	else{
			var idval = /^[a-zA-Z0-9]*$/;
		if(!idval.test(document.member_form.fuserid.value)){window.alert('아이디는 5~20자 영문,소문자,숫자, 특수기호 (_)(-)만 사용가능합니다.'); return;}
	}
	window.open("check_id.php?id="+document.member_form.fuserid.value,"IDcheck","left=200,top=200,width=350,height=60,scrollbars=no,resizable=yes");
	}
	
	</script>
</head>
<body class="log_m2">
  <div id="wraper">
    <header>
      <nav>
	  <?php include "../lib/top_login2.php"; ?> 
      <?php include "../lib/top_menu2.php"; ?>
    </nav>
	</header>
    <section>
      	<h2>회원가입</h2>
      	<h3>환영합니다! Uranos에 가입하시면 다양한 소식과 예매 서비스를 이용하실 수 있습니다.</h3>
		<form name="member_form" action="member_form_action.php" method="post">
		<div class="input_400px">
			<p>아이디</p><input type="text" name="fuserid" id="fuserid" size="30" maxlength="20" placeholder="4~20자의 영문 소문자, 숫자와 특수기호(_),(-)만 사용 가능합니다."/><input type="button" name="button" value="중복확인" onclick="javascript:check_id();"/><br />
			<p>비밀번호</p><input type="password" name="fpasswd" id="fpasswd" size="30" maxlength="16" placeholder="4~16자 영문 대 소문자, 숫자, 특수문자를 사용하세요.
"> <br />
			<p>비밀번호 확인</p><input type="password" name="fpasswd_re" id="fpasswd_re" size="12" maxlength="16" placeholder="사용할 비밀번호를 다시 입력해주세요."> <br/>
			<p>이름</p><input type="text" name="fname" id="fname" size="30" maxlength="10"placeholder="이름을 입력해주세요."> <br />
			<p>휴대폰</p><input type="text" name="fphone" id="fphone" size="30" maxlength="11"  placeholder="- 제외한 휴대폰 번호 11자리를 입력해주세요."> <br />
			<p>이메일</p><input type="email" name="femail" size="30" maxlength="30" placeholder="아이디나 비밀번호 찾기에 사용할 이메일을 입력해주세요."> <br />
		</div>
		<div class="input_190px">
			<p>주소</p><input type="text" name="fpostcode1" id="sample4_postcode1" readonly='readonly'><p class="dashline">-</p><input type="text" name="fpostcode2" id="sample4_postcode2" readonly='readonly'> <input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기">
		</div>
		<div class="input_400px2">
			<input type="text" name="froadaddr" id="sample4_roadAddress" placeholder="[우편번호 찾기]를 이용해주세요." readonly='readonly'>
			<input type="text" name="fjibunaddr" id="sample4_jibunAddress" placeholder="[우편번호 찾기]를 이용해주세요." readonly='readonly'>
			<input type="text" name="fdetailaddr" id="detailaddr" placeholder="상세 주소를 직접 입력해주세요." size="30">
		</div>
		<span id="guide" style="color:#999"></span>
		
		<div class="subbtn">
			<input type="button" name="button" name="cancel" value="가입 취소하기" onclick="javascript:history.go(-1);" > <input type="button" name="button" value="가입하기" onclick="javascript:validate();"/>
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