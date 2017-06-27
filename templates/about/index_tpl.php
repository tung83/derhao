<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2><div class='clearfix'></div></div>
<div class="wrap-box-news">
 	<?php for($i = 0, $count_tintuc = count($tintuc); $i < $count_tintuc; $i++){ ?>
        <div class="col-xs-6 news-item">
			<div class="row">
				<div class="col-xs-5">
					<div class="row">
					
					
						<?php
						
							$photo = ($tintuc[$i]['photo']) ? $tintuc[$i]['photo'] : 'images/noimage.gif';
							if(!checkValidUrl($photo)){
								$photo = _upload_tintuc_l.$photo;
							}
						
						?>
						
						<a href="<?=$com?>/<?=$tintuc[$i]['id']?>/<?=$tintuc[$i]['tenkhongdau']?>.html" title="<?=$tintuc[$i]['ten_'.$lang]?>"><img class="img-thumbnail" src="<?=$photo?>" /></a>
					</div>
				</div>
				<div class="col-xs-7">
					<a href="<?=$com?>/<?=$tintuc[$i]['id']?>/<?=$tintuc[$i]['tenkhongdau']?>.html" title="<?=$tintuc[$i]['ten_'.$lang]?>"><h2><?=$tintuc[$i]['ten_'.$lang]?></h2></a>                  
					<div class='date'><?=date("d/m/Y",$tintuc[$i]['ngaytao'])?></div>
					<p><?=cutString(strip_tags($tintuc[$i]['mota_'.$lang]),200,"...")?></p>
					<a class="chitiet" href="<?=$com?>/<?=$tintuc[$i]['id']?>/<?=$tintuc[$i]['tenkhongdau']?>.html"><?=_read_cotinue?></a>
				</div>	
				
			</div><!-- end row -->
        </div><!---END .box_new-->
       <?php if(($i+1)%2==0) echo '<div class="clearfix"></div>' ?>
    <?php } ?>
 <div class="clear"></div>    
</div><!---END .wrap-box-news-->
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>