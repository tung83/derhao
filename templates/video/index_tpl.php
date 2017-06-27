<link href="assets/css/pure-css.css" type='text/css' rel='stylesheet' />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2><div class="clearfix"></div></div>
<div class="clearfix"></div>
<div class="row" id="news-index">


<?php 
				$effect = array("","rotated","twisted","rotated-left");
				$i=0;
				foreach($tintuc as $k=>$v){
					echo '<div class="col-xs-12 col-md-6">';

					echo '<div class="pro-item smart" >';
					$photo = 'http://img.youtube.com/vi/'.getYoutubeIdFromUrl($v['link']).'/0.jpg';
							echo '<div class="stack '.$effect[$i].'">';
							echo '<div class="stackoverfow">';
							echo '<h2 class="anim-05"><a class="anim-05" href="'.$com.'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></h2>';
							echo '<a href="'.$com.'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">';
							echo '<img class="img-responsive" src="timthumb.php?src='.$photo.'&w=620&h=400" alt="'.$v['ten_'.$lang].'" />';
							echo '</a>';
							echo '</div>';
							echo '</div>';
							
						echo '</div>';
					echo '</div>';	
					$i++;
					if($i==4){
						$i=0;
					}
					
					
				}
			
			?>


</div>
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