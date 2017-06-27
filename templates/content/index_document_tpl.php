<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<link href="assets/css/news_special.css" type="text/css" rel="stylesheet" />
<div class="row">
	<div class="col-xs-12 col-md-4 pull-right">
		
		<?php include _template."layout/left-navigation.php" ?>	
	
	
	
	
	</div>
	
	<div class="con-xs-12 col-md-8">
	
	<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2><div class="clearfix"></div></div>
<div class="wrap-box-news">
	<section id="section-block-envi">
	
	<div class="row" >
	<div id="block-envi">
	<?php 
		foreach($tintuc as $k=>$v){
			?>
				<div class="col-xs-12 col-md-6 envi-item  wow fadeInUp " data-wow-offset="100" data-wow-duration="1" data-wow-delay="<?=(0.2*$k)?>s">
					<div class="item">
					<div class="image wow fadeInUp " data-wow-offset="100" data-wow-duration="1" data-wow-delay="<?=(0.2*$k)?>s">
						<a href="<?=$_GET['com']?>/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>" >
							<img src="timthumb.php?src=<?=$config_url."/"._upload_news_l.$v['thumb']?>&w=370&h=210" class="img-responsive" />
						</a>
					</div>
					<div class="desc wow fadeInUp " data-wow-offset="100" data-wow-duration="1" data-wow-delay="<?=(0.2*$k)?>s">
						<h2><a class="anim-05" href="<?=$_GET['com']?>/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>" >
							<?=$v['ten_'.$lang]?>
						</a></h2>
						<div class="inner-desc hide data-wow-offset="100" data-wow-duration="1" data-wow-delay="<?=(0.2*$k)?>s">
							<?=convertString($v['noidung_'.$lang])?>
						
						</div>
						<a href="<?=$_GET['com']?>/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" class="anim-05 view  wow fadeInUp " data-wow-offset="100" data-wow-duration="1" data-wow-delay="<?=(0.2*$k)?>s">
							<i class="glyphicon glyphicon-menu-right anim-05"></i>
						</a>
					</div>
					
					</div>
				</div>
			
			
			<?php 
		}
	
	
	?>
	<div class="clearfix"></div>
	</div><!-- end block-envi -->
	</div><!-- end row -->
	</section>
</div><!---END .wrap-box-news-->
<div class='clearfix'></div>
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>
	
	
	</div>











</div>


<script>
	$().ready(function(){
		$(".wrap-image").click(function(){
			window.location.href=$(this).find("a").attr("href");
		})
	})
</script>