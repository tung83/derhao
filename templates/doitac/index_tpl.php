<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2></div>
<div class="wrap-box-news">
	<div class="col-xs-12">
	<?php
		$i=0;
		foreach($tintuc as $k=>$v){
			$i++;
			?>
				<div class="col-xs-4 partner-logo-item ">
					<div class="fix-row">
						<figure>
						
							<a href="<?=$v['mota']?>" target="_blank" ><img class="img-thumbnail" src="<?=_upload_hinhanh_l.$v['photo']?>" alt="<?=$v['ten']?>">
							<figcaption>
								<a href="<?=$v['mota']?>" target="_blank"><?=$v['ten']?></a>
							</figcaption>
						</figure>
					
					
					</div>
				
				</div>
			
			
			
			<?php
		
			if($i==3){
				echo '<div class="clearfix"></div>';
				$i=0;
			}
		}
	?>
 	</div>
 <div class="clear"></div>    
</div><!---END .wrap-box-news-->
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>