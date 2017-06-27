<?php
	
	$d->reset();
	$sql_product_danhmuc="select ten,tenkhongdau,id from #_product_danhmuc where hienthi=1 order by stt,id desc";
	$d->query($sql_product_danhmuc);
	$product_danhmuc=$d->result_array();
	
	$d->reset();
	$sql_hotro="select ten,yahoo from #_yahoo where hienthi=1 order by stt,id desc";
	$d->query($sql_hotro);
	$result_hotro=$d->result_array();
	
	$d->reset();
	$sql_phone="select dienthoai,email from #_hotline";
	$d->query($sql_phone);
	$phone=$d->fetch_array();
	
	$d->reset();
	$sql_quangcao="select photo,mota from #_quangcao where hienthi=1 order by stt,id desc";
	$d->query($sql_quangcao);
	$result_quangcao=$d->result_array();	
	

?>
<div id="danhmuc" class="danhmuc">
	<div id="visitor">
		<div class="title">
			
		</div>
		<table class="statistics">
		<?php
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_week = '".date("W")."'";
		$d->query($sql);
		$statistics['week'] = $d->num_rows();
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".date("m")."'";
		$d->query($sql);
		$statistics['month'] = $d->num_rows();
		$sql = $sql = "select * from #_statistics";
		$d->query($sql);
		$statistics['all'] = $d->num_rows();
		$c = count_online();
		?>
									<tr><td><img src="images/on1.png" /></td><td><?=_visit_online?>: <?=$c['dangxem']?></td></tr>
									<tr><td><img src="images/on2.png" /></td><td><?=_visit_week?>: <?=$statistics['week']?></td></tr>
									<tr><td><img src="images/on3.png" /></td><td><?=_visit_month?>: <?=$statistics['month']?></td></tr>
									<tr><td><img src="images/on4.png" /></td><td><?=_visit_all?>: <?=$statistics['all']?></td></tr>
								</table>
		<div class="bottom-block"></div>
		<div class="ext-visitor">
		<?php
		/*
		$browser = getBrowser(); ?>
			<p>Online (20 minutes ago) 3</p>
			<p>Your IP : <?=getIP()?></p>
			
			
			<p>Online (20 minutes ago) 3</p>
			<p>Online (20 minutes ago) 3</p>
			,*/
			?>
		</div>
	</div>
	

 </div><!---END #danhmuc-->
 