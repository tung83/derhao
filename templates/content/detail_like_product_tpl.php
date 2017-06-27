<!-- <link href="assets/plugins/zoom/css/zoom.css" rel="stylesheet">
<script src="assets/plugins/zoom/js/zoom.js"></script>-->
<div class='container' id='product-detail-outter'>
<div class="title-global">
	<h2><?=_exhibition?></h2><div class="clearfix"></div>
	<span>Please send to our customers wishes and greetings health good.</span>				
</div>

	<div class="row">
		<div class="col-xs-12 col-md-4 col-sm-5 col-lg-3" id="left-product-detail" style="margin-top:0">
			<div class="global-title"><h2><?=$tintuc_detail['ten_'.$lang]?></h2><div class="clearfix"></div></div>
			<div class="clearfix"></div>
			<div class="detail-inner">
				<?=$tintuc_detail['noidung_'.$lang]?>
			
			</div>
		</div>
		<div class="col-xs-12 col-md-8 col-sm-7 col-lg-9" id="right-product-detail" style="height:0">
			<?php 
					$rgallery = json_decode($tintuc_detail['gallery'],true);
					if(count($rgallery)){
						?>
				
			<div id="example3" class="slider-pro">
		<div class="sp-slides">
			<?php 
			foreach($rgallery as $k=>$v){
				?>
				<div class="sp-slide">
				<img class="sp-image" src="../src/css/images/blank.gif" 
					data-src="<?=$config_url.$v?>"
					data-small="thumb/500x400/2<?=$v?>"
					data-medium="thumb/900x700/2<?=$v?>"
					data-large="<?=$config_url.$v?>"
					data-retina="<?=$config_url.$v?>"/>

				
				</div>
				
				
				
				
				
				<?php 
							echo '<div class="im-item"><img class="img-thumbnail" data-action="zoom" src="thumb/850x530/2/'.$v.'" alt="'.$row_detail['ten_'.$lang].'" /></div>';
							
						}
						?>
			

	        
		</div>

		<div class="sp-thumbnails">
		<?php 
			foreach($rgallery as $k=>$v){
				echo '<img class="sp-thumbnail" src="thumb/500x400/1'.$v.'" alt="'.$tintuc_detail['ten_'.$lang].'"/>';
			} ?>
		</div>
    </div>
					<?php } ?>

			
				
			
			
		</div>
		<div class="clearfix"></div>
	</div>


	<div class="more-exhibition">
		<div class="title"><?=_more_exhibition?></div>
		<div class="content">
		<div class="row">
			<?php 
				$d->query("select ten_$lang,id,tenkhongdau,photo from #_content where type='trienlam' and hienthi = 1 and id!='".$tintuc_detail['id']."' order by rand() limit 8");
				foreach($d->result_array() as $k=>$v){
					echo '<div class="col-xs-6 col-md-3 col-sm-4"><div class=" ex-item"><div class="wrap">';
						echo '<a href="'.$com.'/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">';
							echo '<img class="img-responsive" src="thumb/400x300/1/'._upload_news_l.$v['photo'].'" alt="'.$v['ten_'.$lang].'" />';
						echo '</a>';
					echo '<div class="oz-name">';
						echo '<a href="'.$com.'/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>';
					echo '</div>';
					echo '</div></div></div>';					
				}
			?>
		
		</div>                             
		</div>                             
	</div>

	
</div>
<?php 
if(count($rgallery)){?>
<script type="text/javascript" src="assets/plugins/slider-pro-master/dist/js/jquery.sliderPro.min.js"></script>
<link type="text/css" href="assets/plugins/slider-pro-master/dist/css/slider-pro.min.css" rel="stylesheet" />
<script>
$( document ).ready(function( $ ) {
		$( '#example3' ).sliderPro({
			width: 960,
			height: 500,
			fade: true,
			arrows: true,
			buttons: false,
			fullScreen: true,
			shuffle: true,
			smallSize: 500,
			mediumSize: 1000,
			largeSize: 3000,
			thumbnailArrows: true,
			autoplay: false
		});
		$("#right-product-detail").css({"height":"auto"});
	});

</script>
<?php } ?>

