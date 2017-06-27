<link href="assets/css/pure-css.css" type='text/css' rel='stylesheet' />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2><div class="clearfix"></div></div>
<div class="clearfix"></div>
<div class="row" id="news-index">

<?php 
foreach($tintuc as $k=>$v){
				echo '<div class="col-xs-12 col-sm-6 col-md-4">';
					echo '<div class="owl-item-inner">';
				
						echo '<div class="album-item">';
							echo '<a href="'.$com.'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">
								<img class="img-responsive" src="timthumb.php?src='.$config_url."/"._upload_news_l.$v['photo'].'&w=375&h=290" alt="'.$v['ten_'.$lang].'" />
							</a>';
						echo '<div class="desc">
								<div class="inner">';
								echo '<h2><a href="'.$com.'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></h2>';
								echo '<div class="copyright">';
									echo _copyright;
								echo '</div>';
						echo '</div>
						</div>';
					
					echo '</div>';
				
					echo '</div></div>';
				
			}
		
		?>
<div class="clearfix"></div>
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>
</div>

<script>
	$().ready(function(){
		$(".wrap-image").click(function(){
			window.location.href=$(this).find("a").attr("href");
		})
	})
</script>