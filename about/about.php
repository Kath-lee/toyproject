<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- about css/script -->
  <link rel="stylesheet" href="../css/about.css" type="text/css" media="screen">
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
</head>
<body class="menu2">
  <div id="wraper">
    <header>
		<nav>
		  <?php include "../lib/top_login2.php"; ?>
		  <?php include "../lib/top_menu2.php"; ?>
		</nav>
    </header>
	<div class="clear"></div>
    <section>
		<h2>URANOS는?</h2>
		<h3>안녕하세요! URANOS입니다.</h3>
		<div class="introduce">
			<img src="../img/about_logo.png" alt="우라노스 소개 이미지" title="우라노스 소개 이미지"><br><br>			
			<p><strong>인천 항만에서 펼쳐지는 락 페스티벌!</strong>
			<br/>자연이 펼쳐진 공간 속에서 국내외 밴드의 음악적 철학을 느끼고, 그들과 소통할 수 있는 행사입니다.<br/>도심에서 벗어나 여러분들이 좋아하는 음악에, 열정을 쏟을 수 있는 문화의 장을 선사하겠습니다.<br/>장르를 구분하지 않고 다양성을 추구하며, 아티스트가 진실된 음악성을 쏟아 관객과 소통하는 URANOS와 함께 하세요!</p>
		</div><br><br>
		
		


		<div class="map">
			<div id="map" style="width:880px;height:350px;"></div>
				<script src="//apis.daum.net/maps/maps3.js?apikey=5f63a72f1f5e6b504465d3d6a8c8d419"></script>
				<script>
					var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
						mapOption = {
							center: new daum.maps.LatLng(37.39318, 126.66176), // 지도의 중심좌표
							level: 4, // 지도의 확대 레벨
							mapTypeId : daum.maps.MapTypeId.ROADMAP // 지도종류
						}; 

					// 지도를 생성한다 
					var map = new daum.maps.Map(mapContainer, mapOption); 
					// 마커 이미지의 주소
					var markerImageUrl = '../img/marker.png', 
						markerImageSize = new daum.maps.Size(80, 100), // 마커 이미지의 크기
						markerImageOptions = { 
							offset : new daum.maps.Point(40, 100)// 마커 좌표에 일치시킬 이미지 안의 좌표
						};

					// 마커 이미지를 생성한다
					var markerImage = new daum.maps.MarkerImage(markerImageUrl, markerImageSize, markerImageOptions);

					// 지도에 마커를 생성하고 표시한다
					var marker = new daum.maps.Marker({
						position: new daum.maps.LatLng(37.39302, 126.66165), // 마커의 좌표
						image : markerImage, // 마커의 이미지
						map: map // 마커를 표시할 지도 객체
					});

			</script>
			

			<div class="road"><p><strong>오시는 길</strong></p>
				<span> ▶&nbsp;1호선 국제 업무지구역 <br> 
				▶&nbsp;인천타워대로를 따라 103m 이동 <br> 
				▶&nbsp;센트럴로를 따라 521m 이동 <br> 
				▶&nbsp;송도 달빛 축제 공원 <br>
				※ 주차공간이 부족하오니 가능한 대중교통을 이용하세요.</span>
			</div>

			<div class="map-info">
				<p><strong>상세정보</strong></p><br/>
				<p><img src="../img/about_time.png" alt="주소" title="주소">&nbsp;&nbsp;평일 09:00 - 18:00 문의상담</p><br/>
				<p><img src="../img/about_location.png" alt="주소" title="주소">&nbsp;&nbsp;인천 송도국제도시 달빛축제공원</p><br/>
				<p><img src="../img/about_tablet.png" alt="연락처" title="연락처">&nbsp;&nbsp;032-1234-5678</p><br/>
				<p><img src="../img/about_mail.png" alt="연락처" title="연락처">&nbsp;&nbsp;connect@uranos.com</p><br/>
			</div>

		</div>
    </section>
	<div class="clear"></div>
    <footer>
      <div id="bot_copy">
        <?php include "../lib/footer.php"; ?>
      </div>
    </footer>
  </div>
</body>
</html>