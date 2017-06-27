<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2><div class="clearfix"></div></div>
<div class="wrap-box-news">
	<section>
	
	<div class="content lsd2" id="top-sld">	
		<div class="row">
		<?php 
			
		
			foreach($tintuc as $k=>$v){
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


</section>
</div><!---END .wrap-box-news-->
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>