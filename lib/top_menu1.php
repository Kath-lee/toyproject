<script>
	$(document).ready(function(){
		var $body = $(document.body), 
			$top = '';

		$top=$('<div>') 
				.addClass('scroll_top') 
				.hide()
				.click(function(){  
					$body.animate({ scrollTop: 0 }); 
				})
				.appendTo($body); 

		$(window).scroll(function(){

			var y = $(this).scrollTop();

			if(y >= 100){
				$top.fadeIn();
			}
			else {
				$top.fadeOut();
			}
		});
	});
</script>
<ul class="top_menu">
   <li><a href="./index.php"><img src="./img/logo.png" alt="Uranus Festival" title="Uranus Festival"></a></li><li><a class="menu1" href="./about/about.php">ABOUT</a></li><li><a class="menu2" href="./lineup/lineup.php">LINEUP</a></li><li><a class="menu3" href="./notice/list.php">NOTICE</a></li><li><a class="menu4" href="./ticket/reserv_list.php">TICKET</a></li><li><a class="menu5" href="./review/list.php">REVIEW</a></li><li><a class="menu6" href="./qna/list.php">QnA</a></li>
</ul> 