<!-- <link href="assets/plugins/zoom/css/zoom.css" rel="stylesheet">
<script src="assets/plugins/zoom/js/zoom.js"></script>-->
<div class='container' id='product-detail-outter'>
	<div class="row">
		<div class="col-xs-12 col-md-4 col-sm-5 col-lg-3" id="left-product-detail">
			<div class="global-title"><h2><?=$row_detail['ten_'.$lang]?></h2><div class="clearfix"></div></div>
			<div class="clearfix"></div>
			<div class="detail-inner">
				<?=$row_detail['noidung_'.$lang]?>
				<?php 
					if($row_detail['type']=='product'){
						$link=changeTitle(_product);
					}else if($row_detail['type']=='instock'){
						$link=changeTitle(_promotion);
					}
					else{
							$link=changeTitle(_fabric);
					}
				?>
				
			</div>
			<div class="quick-link">
				<h1><a href="<?=$link?>/detail/<?=$row_detail['tenkhongdau']?>-<?=$row_detail['id']?>.html" title="<?=$row_detail['ten_'.$lang]?> - <?=$row_detail['maso']?>">
				<?=$row_detail['ten_'.$lang]?><?=($row_detail['maso']) ? ' - '.$row_detail['maso'] : ''?>
				</a></h1>
				<div class="mdesc">
					<a href="<?=$link?>/detail/<?=$row_detail['tenkhongdau']?>-<?=$row_detail['id']?>.html" title="<?=$row_detail['ten_'.$lang]?> - <?=$row_detail['maso']?>">
						<?=_view_detail_order?>
					</a>
				</div>
				
			</div>
		</div>
		<div class="col-xs-12 col-md-8 col-sm-7 col-lg-9" id="right-product-detail">
			
			
				<?php 
					$r = json_decode($row_detail['gallery'],true);
					if(count($r)){
						foreach($r as $k=>$v){
							echo '<div class="im-item"><img class="img-responsive" data-action="zoom" src="'.$config_url.$v.'" alt="'.$row_detail['ten_'.$lang].'" /></div>';
							
						}
					}
				
				?>
				
			
			
		</div>
		<div class="clearfix"></div>
	</div>


</div>