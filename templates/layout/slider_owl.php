<?php
$d->reset();
$d->query("select * from #_slider where hienthi = 1	and type='slider' order by stt,id desc");
$slider = $d->result_array();

?>
<link href="assets/plugins/owlcarousel/owl-carousel/custom.css" type="text/css" rel="stylesheet" />
<div class="">
<div class="">
<div id="wrap-slider">
<div id="owl-carousel-max" style="margin-bottom:15px" class="owl-carousel owl-theme">
 <?php 

	foreach($slider as $k=>$v){
		echo ' <div class="item"><img class="img-responsive" src="'.$config_url.'/'._upload_hinhanh_l.$v['photo'].'" alt="'.$v['ten'].'"></div>';
		
		
	}
 
 
 ?>

</div>
</div>
</div>
</div>
<script>
$(document).ready(function() {
 
  $("#owl-carousel-max").owlCarousel({
 
		navigation : true, // Show next and prev buttons
		slideSpeed : 300,
		pagination:false,
		paginationSpeed : 400,
		singleItem:true,
		
		autoPlay:5000,
		loop:true,
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });
 
});
</script>