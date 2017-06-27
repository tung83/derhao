<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=_search_result?></h2></div>
<div class="wrap-box-news">
 	<?php foreach($rs_sv as $k=>$v){ ?>
        <div class="col-xs-12 news-item">
			<div class="row">
				<div class="col-xs-2">
					<div class="row">
					
					
						<?php
						
							$photo = ($v['photo']) ? $v['photo'] : 'images/noimage.gif';
							if(!checkValidUrl($photo)){
								$photo = _upload_tintuc_l.$photo;
							}
						
						?>
						
						<a href="dich-vu/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>"><img class="img-thumbnail" src="<?=$photo?>" /></a>
					</div>
				</div>
				<div class="col-xs-10">
					<a href="dich-vu/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>"><h2><?=$v['ten_'.$lang]?></h2></a>                  
					<div class='date'><?=date("d/m/Y",$v['ngaytao'])?></div>
					<p><?=cutString(strip_tags($v['mota_'.$lang]),200,"...")?></p>
					<a class="chitiet" href="dich-vu/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html"><?=_read_cotinue?></a>
				</div>	
				
			</div><!-- end row -->
        </div><!---END .box_new-->
    
    <?php } ?>
	<?php foreach($rs_news as $k=>$v){ ?>
        <div class="col-xs-12 news-item">
			<div class="row">
				<div class="col-xs-2">
					<div class="row">
					
					
						<?php
						
							$photo = ($v['photo']) ? $v['photo'] : 'images/noimage.gif';
							if(!checkValidUrl($photo)){
								$photo = _upload_tintuc_l.$photo;
							}
						
						?>
						
						<a href="tin-tuc/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>"><img class="img-thumbnail" src="<?=$photo?>" /></a>
					</div>
				</div>
				<div class="col-xs-10">
					<a href="tin-tuc/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>"><h2><?=$v['ten_'.$lang]?></h2></a>                  
					<div class='date'><?=date("d/m/Y",$v['ngaytao'])?></div>
					<p><?=cutString(strip_tags($v['mota_'.$lang]),200,"...")?></p>
					<a class="chitiet" href="tin-tuc/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html"><?=_read_cotinue?></a>
				</div>	
				
			</div><!-- end row -->
        </div><!---END .box_new-->
    
    <?php } ?>
 <div class="clear"></div>    
</div><!---END .wrap-box-news-->
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>