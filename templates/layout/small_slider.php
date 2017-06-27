<link rel="stylesheet" href="assets/idangeros/idangerous.swiper.css" type="text/css" media="screen" charset="utf-8" />

<script src="assets/idangeros/idangerous.swiper.js" type="text/javascript" ></script>
<div class="device">

<div class="swiper-container">
      <div class="swiper-wrapper">
	  <?php foreach($rs_slider as $k=>$v){ ?>
        <div class="swiper-slide"> <img class="img-responsive" src="<?=_upload_hinhanh_l.$v['photo']?>"> </div>
		<?php } ?>
  </div>
  <div class="pagination"></div>
</div>
</div>


<style>
.swiper-container {margin:auto;border: 3px solid white;}
.swiper-container .pagination{}
.device {
  width: 100%;
  
 padding:5px;

  background: #111;
  
  position: relative;
  box-shadow: 0px 0px 5px #000;
}
.device .arrow-left {
  background: url(img/arrows.png) no-repeat left top;
  position: absolute;
  left: 10px;
  top: 50%;
  margin-top: -15px;
  width: 17px;
  height: 30px;
}
.device .arrow-right {
  background: url(img/arrows.png) no-repeat left bottom;
  position: absolute;
  right: 10px;
  top: 50%;
  margin-top: -15px;
  width: 17px;
  height: 30px;
}

.content-slide {
  padding: 20px;
  color: #fff;
}
.title {
  font-size: 25px;
  margin-bottom: 10px;
}
.pagination {
  position: absolute;
  left: 0;
  text-align: center;
  bottom:5px;
  width: 100%;
}
.swiper-pagination-switch {
  display: inline-block;
  width: 10px;
  height: 10px;
  border-radius: 10px;
  background: #999;
  box-shadow: 0px 1px 2px #555 inset;
  margin: 0 3px;
  cursor: pointer;
}
.swiper-active-switch {
  background: #fff;
}
</style>
<script>
function initSmallSlider(){
	if($(".swiper-container").length){
		if($(".container").width() < 768){
			$l = $(".container")/110; 
			$r_width = $(window).width();
			
			$slider_width = $r_width;
			$slider_height = $slider_width/1.77864583;
			$(".device").css({width:"100%",height:$slider_height});
			$(".swiper-container").css({height:$slider_height-16});
			$("#owl-demo").removeClass("position-bottom");
			
		}else{
			$("#owl-demo").addClass("position-bottom");
		
		}
		var mySwiper = new Swiper('.swiper-container',{
		 pagination: '.pagination',
		loop:true,
		
		grabCursor: true,
		paginationClickable: true
	  })

  }
  }
  
  $().ready(function(){
  

	initSmallSlider();
  
  })
  </script>