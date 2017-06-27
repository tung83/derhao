<script type="text/javascript" src="assets/iView-master/js/raphael-min.js"></script>
<script type="text/javascript" src="assets/iView-master/js/jquery.easing.js"></script>
<script type="text/javascript" src="assets/iView-master/js/iview.min.js"></script>

<link rel="stylesheet" href="assets/iView-master/css/skin4/style.css" type="text/css"/>
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
	$d->query("select * from #_slider order by stt,id desc");
	$slider = $d->result_array();
	?>
	<div class="" id="slider-wrapper">
		
<div id="slider" >
		<div id="iview">
		<?php
			foreach($slider as $k=>$v){
				echo '<div data-iview:image="'._upload_hinhanh_l.$v['photo'].'" ></div>';
			
			}
			
		?>
			
		</div>
	</div><!-- end  slider -->	
<?php
	$d->query("select * from #_index where hienthi = 1 and location = 1 order by stt desc");
	$rs_index_item = $d->result_array();
	echo "<div id='index-puple'>";
	
	foreach($rs_index_item as $k=>$v){
		echo '<div class="index-item">';
			echo '<div class="x-wrap">';
			echo '<div class="overlay">';
			echo '<a href="'.$v['mota_'.$lang].'"><div class="small-name"><h2>'.$v['ten_'.$lang].'</h2></div>';
			echo '<div class="big-name"><h2>'.$v['noidung_'.$lang].'</h2></div></a>';
			echo '</div>';
			echo '<img src="'._upload_news_l.$v['photo'].'" class="img-responsive" title="'.$v['ten_'.$lang].'" />';
			/*echo '<div class="name"><a href="'.$v['mota_'.$lang].'">'.$v['ten_'.$lang].'</a></div>';*/
			echo '<span class="mt"><img src="assets/img/arrow-index.png" /></span>';
			echo '</div>';
		echo '</div>';
	
	
	}
	echo '<div class="clearfix"></div>';

	echo '</div>';
	





?>




</div>
<script>
$().ready(function(){
$("#index-puple").width($("#index-puple").find(".index-item").length *($("#index-puple").find(".index-item").first().outerWidth()+6)+16);
})
</script>