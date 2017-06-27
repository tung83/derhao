<link rel="stylesheet/less" type="text/css" href="assets/css/less/news.less">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="news-content">
	<div class="">
		<div class="header">
			<h2><?=$tintuc_detail['ten_'.$lang]?></h2>
			<div class="date"><?=date("d-m-Y",$tintuc_detail['ngaytao'])?></div>
			<?php include _template."layout/share.php";?>
		</div>
		<div class="description">
			<?=$tintuc_detail['mota_'.$lang]?>
		</div>   
		<div class="content">   
			
			<?=$tintuc_detail['noidung_'.$lang]?><br />    
<div class="clearfix">

</div>
<div id="fb-root"></div>
								<script>(function(d, s, id) {
								  var js, fjs = d.getElementsByTagName(s)[0];
								  if (d.getElementById(id)) return;
								  js = d.createElement(s); js.id = id;
								  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=580130358671180&version=v2.3";
								  fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
								
								<div class="fb-comments" data-href="<?=getCurrentPageUrl()?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>			
			<?php
			  if(count($tintuc_khac) > 0) { ?>
				<div class="other-news">
					 <h3><?=$more?></h3>
					 <div class="content lsd2" id="top-sld">	
		<div class="row">
		<?php 
			
		
			foreach($tintuc_khac as $k=>$v){
				echo '<div class="col-xs-6 col-md-4 col-sm-6 col-lg-4">';
				echo '<div class="owl-item-inner">';
				
					echo '<div class="service-item"><div class="wrap">';
						echo '<a href="'.$com.'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">
							<img class="img-responsive" src="timthumb.php?src='.$config_url."/"._upload_news_l.$v['photo'].'&w=260&h=380" alt="'.$v['ten_'.$lang].'" />
						</a>';
						echo '<div class="desc"><div class="inner rel">';
							echo '<h2><a href="'.$com.'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></h2>';
							
							
						
						echo '</div></div>';
					
					echo '</div>';
				
				echo '</div></div>';
				echo '</div>';
				
			}
		
		?>
		</div>
		
	</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
