<link href="assets/owl-carousel/owl.transitions.css" type="text/css" rel="stylesheet" />
<link href="assets/owl-carousel/owl.theme.css" type="text/css" rel="stylesheet" />
<link href="assets/owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" />
<script src="assets/js/jquery.mousewheel.min.js" type="text/javascript"></script>
<script src="assets/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

<div class="hidden-xs" id="marg-top"></div>
<div id="owl-demo" class="position-bottom owl-carousel owl-theme">
	<?php
		$d->query("select * from #_work_danhmuc where hienthi = 1 order by stt desc");
			foreach($d->result_array() as $k=>$v){
			
			echo '<div class="item shadow">
			<a href="'.$_GET['com'].'/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'"><img  class="img-responsive" src="'._upload_news_l.$v['thumb'].'" /></a>
			<div class="i-name">
				<a href="'.$_GET['com'].'/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>
			</div>
			
			</div>';
		
		}
	
	?>
</div>
<script>
$().ready(function(){
setTimeout(function(){
  var owl = $(".owl-carousel");
 
  owl.owlCarousel({
	   loop: true,
      //nav: true,
      margin: 10,
      items : 3, //10 items above 1000px browser width
      responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },            
        960:{
            items:3
        },
        1200:{
            items:4
        }
    },
	  autoPlay:true
  });

  $(".owl-carousel").mousewheel(function (e) {
	
    if (e.deltaY>0) {
        owl.trigger('next.owl');
    } else {
        owl.trigger('prev.owl');
    }
    e.preventDefault();
});
},500);
 })
 </script>

