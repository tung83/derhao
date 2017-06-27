<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2></div>
<div class="wrap-box-news">
	<div class="col-xs-12">
	<table class="table table-bordered table-hover">
	<thead><th>#</th><th><?=_name?></th><th width="20%">Download</th></thead>
	<?php
		$i=0;
		foreach($tintuc as $k=>$v){
			$i++;
			?>
				<tr class=" anim">
					<td><?=$i?></th>
					<td><?=$v['ten_'.$lang]?></td>
					<td><a href="<?=_upload_tintuc_l.$v['source']?>"><img height="30px" src="assets/img/icon_download.png" /></a></td>
				
				
						
				
			
			
			<?php
		}
	?>
	</table>
 	</div>
 <div class="clear"></div>    
</div><!---END .wrap-box-news-->
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>