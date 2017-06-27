<script type="text/javascript" src="assets/iView-master/js/raphael-min.js"></script>
<script type="text/javascript" src="assets/iView-master/js/jquery.easing.js"></script>
<script type="text/javascript" src="assets/iView-master/js/iview.min.js"></script>

<link rel="stylesheet" href="assets/iView-master/css/skin4/style.css" type="text/css"/>
<link rel="stylesheet" href="assets/iView-master/css/iview.css" type="text/css"/>
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
			echo '<img src="'._upload_news_l.$v['photo'].'" class="img-responsive" title="'.$v['ten_'.$lang].'" />';
			echo '<div class="name"><a href="'.$v['mota_'.$lang].'">'.$v['ten_'.$lang].'</a></div>';
			echo '<span class="mt"><img src="assets/img/arrow-index.png" /></span>';
			echo '</div>';
		echo '</div>';
	
	
	}
	echo '<div class="clearfix"></div>';

	echo '</div>';
	





?>




</div>
<style>
#index-puple .title{
	text-align:center;
	margin:10px auto;
	margin-top:20px;
}
#slider{height:475px;box-shadow:0 10px 10px -7px rgba(0, 0, 0, 0.2)}
#index-puple{
		margin:auto;
		position: relative;
		top: -135px;
		z-index:123;
		
		

}
#index-puple .index-item img{


left: 0px;
position: absolute;
top:0;
left:0;
bottom:0;
right:0;
margin:auto
}

#index-puple .index-item .x-wrap{

border-radius: 50%;
height: 208px;
width: 209px;
overflow: hidden;
position: relative;
margin-top: 7px;
/* background: red; */
margin-left: 7px;
}
#index-puple .index-item:hover{
	top:-10px;
	opacity:0.9;
}
#index-puple .index-item .mt img{
	
border-radius: 0;
}
#index-puple .index-item .mt{
width: 23px;
height: 21px;
position: absolute;
bottom: 4px;
left: 44%;
-moz-transition: all 0.3s ease;
-o-transition: all 0.3s ease;
-ms-transition: all 0.3s ease;
transition: all 0.3s ease;
}
#index-puple .index-item:hover .mt{
	left:50%;
}
#index-puple .index-item{
	
	top:10px;
		-moz-transition: all 0.3s ease;
-o-transition: all 0.3s ease;
-ms-transition: all 0.3s ease;
transition: all 0.3s ease;
	width:225px;
	height:244px;
	overflow:hidden;
	float:left;
	position:relative;
	margin:0 2px;
	background:url(assets/img/label2.png) no-repeat;

}
#index-puple .index-item:hover{cursor:hand;cursor:pointer}
#index-puple .index-item .name:hover a{color:#333;text-decoration:none}
#index-puple .index-item .name a{font-family: dinhtran;
color: #454545;
/* font-weight: bold; */
text-transform: capitalize;
-moz-transition: all 0.3s ease;
-o-transition: all 0.3s ease;
-ms-transition: all 0.3s ease;
transition: all 0.3s ease;
font-size: 28px;
}
#index-puple .index-item .name{position: absolute;
bottom: 0px;
line-height: 32px;
/* background: rgba(187, 255, 33, 0.48); */
width: 100%;
height: 32px;
bottom: 23px;
text-align: center;
left: 0;
}
</style>
<script>
$().ready(function(){
$("#index-puple").width($("#index-puple").find(".index-item").length *($("#index-puple").find(".index-item").first().outerWidth()+4));
})
</script>