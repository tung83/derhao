<?php
	$d->reset();
	$d->query("select * from #_social where hienthi = 1"); 
	$social = $d->result_array();
	?>
	
	<div id="social-air" class="pull-right">
		<?php foreach($social as $k=>$v){
			echo '<a href="'.$v['link'].'" title="'.$v['ten'].'" target="_blank"><img src="'._upload_hinhanh_l.$v['photo'].'" alt="" /></a>';		
		}
		?>
	
	</div>	
	<script>
		$().ready(function(){
			$("#social-air a").wrap("<div class='social-item anim-05'></div>");
			$("#social-air .social-item").each(function(){
				$img = $(this).find("img");
				$haft = $img.height()/2;
				$w = $img.width();
				console.log($w);
				$(this).attr("data-height",$img.height());
				
				$(this).find("img").remove();
				$(this).css({"background":"url("+$img.attr("src")+") no-repeat","height":$haft,"width":$w});
			})
			$("#social-air").css({display:"none","visibility":"visible"}).fadeIn();
			
		})
		
	
	</script>