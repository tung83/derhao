<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<link href="assets/css/news_special.css" type="text/css" rel="stylesheet" />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2><div class="clearfix"></div></div>
<div class="wrap-box-news">
	<div class="">
	<?php 
		foreach($tintuc as $k=>$v){
			echo '<div class="col-xs-12 col-md-4 col-sm-6 col-lg-4"><div class="row">';
				echo '<div class="wrap-image">';
					echo '<a href="'.$com.'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">';
						echo '<img class="img-responsive image-thumb" src="timthumb.php?src='.$config_url."/"._upload_news_l.$v['photo'].'&w=600&h=400" alt="'.$v['ten_'.$lang].'" />';
					echo '</a>';
					echo '<div class="wrap-desc anim-05">';
						echo '<div class="name">';
							echo '<h2><a class="anim-05" href="'.$com.'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></h2>';
						echo '</div>';
						echo '<div class="desc hide">';
							echo convertString($v['mota_'.$lang]);
						echo '</div>';
						
					echo '</div>';
					
				echo '</div>';
			
			
			echo '</div></div>';
			
		}	
	?>
	</div>
</div><!---END .wrap-box-news-->
<div class='clearfix'></div>
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>
<script>
	$().ready(function(){
		$(".wrap-image").click(function(){
			window.location.href=$(this).find("a").attr("href");
		})
	})
</script>