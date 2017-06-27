<link rel="stylesheet/less" type="text/css" href="assets/css/less/news.less">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="news-content">
	<div class="col-xs-12">
		<div class="header">
			<h2><?=$tintuc_detail['ten_'.$lang]?></h2>
			<div class="date"><?=date("d-m-Y",$tintuc_detail['ngaytao'])?></div>
			<?php include _template."layout/share.php";?>
		</div>
		<div class="description">
			<?=$tintuc_detail['mota_'.$lang]?>
		</div>   
		<div class="content">   
			
			<?=$tintuc_detail['noidung_'.$lang]?><br />           
			<?php
			  if(count($tintuc_khac) > 0) { ?>
				<div class="other-news">
					 <h3><?=$more?></h3>
					 <ul>          
						<?php foreach($tintuc_khac as $tinkhac){?>
						<li>&raquo;&nbsp;<a href="<?=$com?>/<?=$tinkhac['id']?>/<?=$tinkhac['tenkhongdau']?>.html" style="text-decoration:none;" title="<?=htmlentities($tinkhac['ten_'.$lang], ENT_QUOTES, "UTF-8")?>"><?=$tinkhac['ten_'.$lang]?></a> <span class="date">(<?=make_date($tinkhac['ngaytao'])?>)</span></li>
						<?php }?>
					 </ul>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
