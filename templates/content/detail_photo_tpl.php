<script src="assets/plugins/mansory/masonry.pkgd.min.js"></script>
<link href="assets/plugins/light-gallery/css/lightGallery.css" type='text/css' rel='stylesheet' />
<script src="assets/plugins/light-gallery/js/lightGallery.min.js"></script>
<script src="assets/plugins/lazyload/jquery.lazyload.js"></script>
<script src="assets/plugins/mansory/imagesloaded.js"></script>
<link href="assets/css/pure-css.css" type='text/css' rel='stylesheet' />

<div class="box_containerlienhe">
<div class="">
<div class="title-global"><h2><?=$title_cat?></h2><div class="clearfix"></div><?php include _template."layout/share.php" ?></div>

<div class="clearfix"></div>
<div class="">

			
			<?=$tintuc_detail['noidung_'.$lang]?><br />     
			<div class="row-8">
<ul id="light-gallery" class="grid" style="width:100%">
				
		  <!-- width of .grid-sizer used for columnWidth -->
		 
			<?php
				$gal = objectToArray(json_decode($tintuc_detail['gallery']));
				$i=0;
				foreach($gal as $k=>$v){
					
					echo '<li class="grid-item col-xs-6 col-md-4 col-lg-4 col-sm-4" data-src="'.$config_url."/".$v.'"><div class="row-8"><div class="inner"><a href="#"><img class="img-responsive lazy" src="assets/img/grey.gif" data-original="'.$config_url."/".$v.'" /></a></div></div></li>';
				
					
					
				}
			
			?>
				
			
			
			
		</ul>
		</div>
</div>
<div class="clear"></div>
</div>
</div>
<script>
$().ready(function(){
	 $("img.lazy").lazyload({
    effect: 'fadeIn',
    effectspeed: 1000,
    threshold: 200
});

$('img.lazy').load(function() {
    masonry_update();
});

function masonry_update() {     
    var $works_list = $("#light-gallery");
    $works_list.imagesLoaded(function(){
        $works_list.masonry({
            itemSelector: '.grid-item',
            
            
        });
    });
 }    
$("#light-gallery").lightGallery();
})

</script>
