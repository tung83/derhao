<?php
	if(isset($main_popup['photo'])){
			echo '<div id="my-overlay"  style="display:none;position:fixed;width:100%;height:100%;background:rgba(0,0,0,.9);top: 0;left: 0;z-index: 123;"></div>';
			echo '<div id="fancy-popup" class="" style="visibility: hidden;;position: fixed;top:50px;z-index:125"><div style="position:relative"><a href="" class="closeG" style="position: absolute;
right: -23px;
top: -23px;"><img src="assets/img/close-button-large.png" width="50px"/></a>';
				echo '<a href="'.$main_popup['link'].'">';
					echo '<img class="a" src="'._upload_news_l.$main_popup['photo'].'" />';
				echo '</a>';
			echo '</div>';
			echo '</div>';
			?>
				<script>
					$().ready(function(){
						setTimeout(function(){
						$img = $("#fancy-popup img.a");
						$w = $img[0].width;
						$h = $img[0].height;
						$("#fancy-popup").css({"width":$w,"height":$h,"right":-$w});
						$hw = $(window).width();
						
						$("#my-overlay").fadeIn(1000,function(){
						$("#fancy-popup").css({visibility:"visible"}).animate({"visibility":"inherit","right":(($hw - $w)/2)},700);
						});
					},2000);
					$(".closeG,body").click(function(){
						$("#fancy-popup").animate({right:-$w},700,function(){
						$("#fancy-popup").remove();
							$("#my-overlay").fadeOut(function(){
								$("#my-overlay").remove();
							});
						
						});
						
						return false;
					})
					
					})
					
				</script>
			
			
			<?php 

		//echo '<a class=" fancy-popup" href="#fancy-popup"></a>';
		//echo '<script>$().ready(function(){$(".fancy-popup").fancybox({padding:0,margin:0,wrapCSS:"defaul"});setTimeout(function(){$(".fancy-popup").click();},500);})</script>';
	}
?>