<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Poltfolio-Uranos Festival</title>
  <link rel="stylesheet" type="text/css" href="../css/common.css">
  <!-- lineup css/script -->
  <link rel="stylesheet" href="../css/lineup.css" type="text/css" media="screen">
  	<link rel="stylesheet" href="../css/responsive.css" type="text/css" media="screen">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="../js/timeliner.min.js"></script>
  <script type="text/javascript" src="../js/timeliner.js"></script>
  <script type="text/javascript" src="../js/colorbox.js"></script>
  <script>
		$(document).ready(function() {
			$.timeliner({
				/*startOpen:['#19550828', '#19630828', '#19570904', '#19551201', '#19540517']*/
			});
			$.timeliner({
				timelineContainer: '#timeline-js',
				timelineSectionMarker: '.milestone',
				oneOpen: true,
				startState: 'open',
				expandAllText: '+ 펼쳐보기',
				collapseAllText: '- 간단보기'
			});
			// Colorbox Modal
			$(".CBmodal").colorbox({inline:true, initialWidth:100, maxWidth:682, initialHeight:100, transition:"elastic",speed:750});
		});
  </script>
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
		<h2>라인업</h2>
		<h3>요즘 가장 핫한, Uranos 라인업!<br/>페스티벌에 참여하는 뮤지션들을 확인해보세요.</h3><br/>
		 <div id="timeline" class="timeline-container">
			<button class="timeline-toggle expanded">- 간단보기</button>
			<br class="clear">

			<div class="timeline-wrapper">
				<h2 class="timeline-time"><span>Session.1 낮</span></h2>
				<dl class="timeline-series">
					<dt id="19540517" class="timeline-event"><a>체리필터</a></dt>
					<dd class="timeline-event-content" id="19540517EX">
						<h3>한국 모던록의 대표주자! 체리필터와 함께 락스피릿 발산!</h3>
						<div class="media">
							<img src="../img/lineup1.png">
						</div><!-- /.media -->
						<p>보컬 조유진, 기타 정우진, 베이스 연윤근, 드럼 손상혁으로 이뤄진 혼성 4인조 록 그룹. 1997년 결성 이후 지난 13년간 록이라는 장르 안에서 다양한 스펙트럼을 펼쳐 보여 온 한국 록음악계의 명실상부한 대표주자다.여성보컬 조유진의 독보적인 목소리가 귓가에 남는 체리필터는 경쾌한 모던 록만 아니라, 파워풀하면서 감정의 고저가 뚜렷한 개성 넘치는 음악으로 그동안 음악계에 강렬한 행보를 남겨왔다. 지금까지 다섯 장의 앨범을 발표한 체리필터는 늘 호기심을 자극할만큼 새로워진 음악을 선보이며 꾸준히 변화발전해가고 있다.</p>
						<br class="clear">
					</dd><!-- /.timeline-event-content -->
					<dt id="19550828" class="timeline-event"><a>슈퍼키드</a></dt>
					<dd class="timeline-event-content" id="19550828EX">
						<h3>공연장을 들썩들썩! 관객을 들었다놨다, 롤러코스터처럼 흥미진진한 밴드!</h3>
						<div class="media">
							<img src="../img/lineup2.png">
						</div><!-- /.media -->
						<p>5인조 록 밴드 슈퍼 키드(Super Kidd). 보컬은 허첵, 징고, 베이스는 헤비포터가 맡고 있다.<br/>신인답지 않은 실력과 끈끈한 우정으로 뭉쳐 활발한 활동을 펼치고 있으며, 지난 2007년 8월에는 대학로 질러홀에서 전석 매진의 기록을 세우며 성황리에 공연을 마친 바 있다.처음 밴드를 결성한 지 2년 6개월 만에 500회가 넘는 라이브 무대를 소화하며 언더 씬에서 놀라운 인기몰이를 하며 실력을 인정받던 그들이 대중에게 널리 알려지게 된 계기는 무엇보다 MBC “쇼바이벌” 무대. 참신한 신인들이 토너먼트 방식으로 경쟁을 하며 음악방송 출연권을 놓고 끼와 재능을 선보이는 이 프로그램을 통해 평단과 대중 모두에게 큰 지지를 얻었다. 매주 새로운 공연을 선보인 후 관객들의 호응도로 승자를 가리는 서바이벌 프로그램에서 늘 최고의 무대를 선보이며 벌써부터 수많은 매니아층을 확보하고 있다.</p>
						<br class="clear">
					</dd><!-- /.timeline-event-content -->
				</dl><!-- /.timeline-series -->
			</div><!-- /.timeline-wrapper -->

			<div class="timeline-wrapper">
				<h2 class="timeline-time"><span>Session.2 밤</span></h2>
				<dl class="timeline-series">
					<dt id="19570904" class="timeline-event"><a>Cold play</a></dt>
					<dd class="timeline-event-content" id="19570904EX">
						<h3>얼터너티브 록의 진수!</h3>
						<div class="media">
							<img src="../img/lineup3.png">
						</div><!-- /.media -->
						<p>전 세계 6천만 장의 앨범 판매 기록, 지금까지 발매했던 앨범이 멀티-플래티넘을 달성, 7개의 그래미 수상과 함께 전 세계를 아우르는 공감대와 대중들을 끌어당기는 보편적인 감성으로 이 시대 최고의 록 밴드라 평가되고 있다. 특히 이번 공연에서 관객과 함께할 앨범[Ghost Stories]는 신비로우면서 수려한 선율과 섬세하면서 시적인 가사가 담긴 트랙들로 구성되어 있다. 매체로부터 받은 '데뷔 이후 가장 감동적인 콜드플레이 앨범'이라는 평가대로, 앨범을 준비하면서 겪었던 프론트맨의 상처는 무한한 영감으로 승화되었고, 성찰의 과정에서 얻은 깨달음은 동이 트기 전 가장 어두웠던 시간을 밝히며, 더 나아가 듣는 이들을 별빛 가득한 초현실의 세계로 인도하였다. 이는 라이브에도 곧장 적용되었다.</p>

						<br class="clear">
					</dd><!-- /.timeline-event-content -->
					<dt id="19551201" class="timeline-event"><a>U2</a></dt>
					<dd class="timeline-event-content" id="19551201EX">
						<h3>메시지와 음악성을 두루 갖춘 현존 최고의 라이브 밴드!</h3>
						<div class="media">
							<img src="../img/lineup4.png">
						</div><!-- /.media -->
						<p> 아일랜드가 배출해낸 최고의 록 밴드 유투는 정치색 짙은 메시지를 음악에 담아내는 것으로 유명하지만 그러면서도 대중들을 열광시키는 상업성까지 겸비한 밴드로 잘 알려져 있다. 하지만 유투는 투어 때마다 선보여온 환상적인 라이브 무대로도 유명하다. 아마도 많은 공연 기획자들이 끈질기게 추진해온 유투의 공연이 이 땅에서 펼쳐진다면, 이는 아마도 지금껏 한국에서 펼쳐진 내한 공연 중 최고의 무대가 될 것이 틀림 없다. 왜냐고? 그 답은 유투의 공연을 담아낸 라이브</p>


							<div class="clear"></div>
					</dd><!-- /.timeline-event-content -->
				</dl><!-- /.timeline-series -->
			</div><!-- /.timeline-wrapper -->
			<button class="timeline-toggle">+ 펼쳐보기</button>
			<br class="clear">
		</div><!-- /#timelineContainer -->
		<br/><br/>
		<div class="reserve_btn"><a href="../ticket/reserv_list.php">예매하기</a></div>
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