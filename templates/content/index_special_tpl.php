<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<link href="assets/css/news_special.css" type="text/css" rel="stylesheet" />
<div class="">
	
	
	<div class="con-xs-12 col-md-8">
	
	<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2><div class="clearfix"></div></div>
<div class="wrap-box-news">
	<div class="">
	<?php 
		foreach($tintuc as $k=>$v){
			?>
			<div class="news-item fadeInDown wow" data-wow-offset="50" data-wow-duration="3" data-wow-delay="0.2s">
			<div class="header">
				<div class="date">
					<?php 
						$date = explode(",",date("d,m",$v['ngaytao']));
						echo '<div>'.$date[0].'</div>';
						echo '<div>Tháng '.$date[1].'</div>';
					?>
				
				</div>
				<div class="name">
					<h3><a href="<?=$com?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a></h3>
					<div class="clearfix"></div>
					<div class="tool"><i class="glyphicon glyphicon-user"></i>&nbsp;By Admin &nbsp;<i class="glyphicon glyphicon-comment"></i>&nbsp;<span class="fb-comments-count" data-href="<?=$config_url."/".$com?>/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html">  </span> <?=_comment?></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="content">
				<div class="row-8">
					<div class="col-xs-5 col-8">
						<a href="<?=$com?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
						<?='<img class="img-responsive image-thumb" src="thumb/600x400/1/'._upload_news_l.$v['photo'].'" alt="'.$v['ten_'.$lang].'" />'?>
						</a>
					</div>
					<div class="col-xs-7 col-8">
						<?=cutString(strip_tags($v['mota_'.$lang]),200)?>
						
					</div>
					<div class="left-position-link col-xs-offet-5">
							<a  href="<?=$com?>/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>"><?=_chitiet?></a>
					</div>
				</div>	
			</div>
			<div class="clearfix"></div>
			
			
			
			</div>
			
<?php 
		}	
	?>
	</div>
</div><!---END .wrap-box-news-->
<div class='clearfix'></div>
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>
	
	
	</div>
<div class="col-xs-12 col-md-4 pull-right">
		
		<?php include _template."layout/left-navigation.php" ?>	
	
	
	
	
	</div>
	<div class="clearfix"></div>










</div>


<script>
	$().ready(function(){
		$(".wrap-image").click(function(){
			window.location.href=$(this).find("a").attr("href");
		})
	})
</script>