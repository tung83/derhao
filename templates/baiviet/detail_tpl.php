<div class="container">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="news-content">
	
		
				<div class="title-global"><h2><?=$title_cat?></h2><div class="clearfix"></div>
				<span><?=strip_tags($tintuc_detail['mota_'.$lang])?></span>
				
				</div>
				
			
			
		<div class="content">   
		
			<?=$tintuc_detail['noidung_'.$lang]?><br />           
		</div>
	<?php include _template."layout/share.php";?>
	<div class="clearfix"></div>
</div>
</div>
