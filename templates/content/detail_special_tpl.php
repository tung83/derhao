<link rel="stylesheet/less" type="text/css" href="assets/css/less/news.less">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="row">
	
	
	<div class="con-xs-12 col-md-8">
	<div class="news-content">
	<div class="">
		<div class="header">
			<h2><?=$tintuc_detail['ten_'.$lang]?></h2>
			<div class="date"><?=date("d-m-Y",$tintuc_detail['ngaytao'])?></div>
			<?php include _template."layout/share.php";?>
		</div>
		<?php 
			if($tintuc_detail['file']){
				?>
					<div class="download-wrapper">
						<a href="download.php?file=<?=$tintuc_detail['file']?>"><i  class="glyphicon glyphicon-download-alt"></i>&nbsp; Tải về <?=$tintuc_detail['file']?></a>
					
					</div>
				
				
				<?php 
				
				
			}
			
		
		?>
		<div class="description">
			<?=$tintuc_detail['mota_'.$lang]?>
		</div>   
		<div class="content">   
			
			<?=$model->autoAddSeoTags($tintuc_detail['noidung_'.$lang])?><br />  




<?php 
	$gal = json_decode($tintuc_detail['gallery'],true);
	
	if(count($gal)){
		?>
		<script src="assets/plugins/mansory/masonry.pkgd.min.js"></script>
<link href="assets/plugins/light-gallery/css/lightGallery.css" type='text/css' rel='stylesheet' />
<script src="assets/plugins/light-gallery/js/lightGallery.min.js"></script>
<script src="assets/plugins/lazyload/jquery.lazyload.js"></script>
<script src="assets/plugins/mansory/imagesloaded.js"></script>
<link href="assets/css/pure-css.css" type='text/css' rel='stylesheet' />

<div class="box_containerlienhe">
<div class="">
<div class="title-global"><h2>Hình ảnh</h2><div class="clearfix"></div></div>

<div class="clearfix"></div>
<div class="">

			
			  
			<div class="row-8">
<ul id="light-gallery" class="grid" style="width:100%;padding:10px 0;border:1px solid #ccc;border-left:0;border-right:0">
				
		  <!-- width of .grid-sizer used for columnWidth -->
		 
			<?php
				$gal = objectToArray(json_decode($tintuc_detail['gallery']));
				$i=0;
				foreach($gal as $k=>$v){
					
					echo '<li class="grid-item col-xs-6 col-md-4 col-lg-4 col-sm-4" data-src="'.$config_url."/".$v.'"><div class="row-8"><div class="inner"><a href="#"><img class="img-responsive lazy" src="assets/img/grey.gif" data-original="thumb/400x600/3'.$v.'" /></a></div></div></li>';
				
					
					
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

<?php 
	}
		
	?>

	











			
<div class="clearfix">

</div>

			<?php
			  if(count($tintuc_khac) > 0) { ?>
				<div class="other-news">
					 <h3><?=$more?></h3>
					 <ul>          
						<?php foreach($tintuc_khac as $tinkhac){?>
						<li>&raquo;&nbsp;<a href="<?=$com?>/<?=$tinkhac['id']?>/<?=$tinkhac['tenkhongdau']?>.html"  title="<?=htmlentities($tinkhac['ten_'.$lang], ENT_QUOTES, "UTF-8")?>"><?=$tinkhac['ten_'.$lang]?></a> <span class="date">(<?=make_date($tinkhac['ngaytao'])?>)</span></li>
						<?php }?>
					 </ul>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
	
	
	</div>





<div class="col-xs-12 col-md-4 pull-right">
		
		<?php include _template."layout/left-navigation.php" ?>	
	
	
	
	
	</div>





</div>
<script>
$().ready(function(){
	$(".news-content img").addClass("wow fadeIn").attr({'data-wow-offset':'100','data-wow-duration':'1'});
})
</script>




