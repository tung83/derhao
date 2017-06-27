<script type="text/javascript" src="assets/iView-master/js/raphael-min.js"></script>
<script type="text/javascript" src="assets/iView-master/js/jquery.easing.js"></script>
<script type="text/javascript" src="assets/iView-master/js/iview.min.js"></script>

<link rel="stylesheet" href="assets/iView-master/css/skin1/style.css" type="text/css"/>
<link rel="stylesheet" href="assets/iView-master/css/iview.css" type="text/css"/>
<link rel="stylesheet" href="assets/css/pp.css" type="text/css"/>
<script>
			$(document).ready(function(){
				$('#iview').iView({
					pauseTime: 3000,
					pauseOnHover: true,
					directionNav: true,
					directionNavHide: false,
					directionNavHoverOpacity: 0,
					controlNav: false,
					
					timer: "360Bar",
					timerPadding: 3,
					timerColor: "#0F0"
				});

				})
				</script>
	<?php
	$d->reset();
	$d->query("select * from #_slider where hienthi = 1 order by stt,id desc");
	$slider = $d->result_array();
	?>
	<div class="" id="slider-wrapper">		
<div id="slider" >
		<div id="iview">
		<?php
			foreach($slider as $k=>$v){
				echo '<div data-iview:image="'._upload_hinhanh_l.$v['photo'].'" ><a class="" href="'.$v['link'].'" target="_blank" style="position:absolute;width:100%;height:100%;top:0;left:0;z-index:1234""></a></div>';			
			}		
		?>			
		</div>
	</div><!-- end  slider -->	
<div id="slogan-wrap">
	<div class="container wrap-hotline">
		<div class="">
		<h2><?=$result_hotline['slogan_'.$lang]?></h2>
		</div>
	</div>

</div>
</div>

