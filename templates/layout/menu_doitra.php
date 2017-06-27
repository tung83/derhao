	<?php
	$d->query("select * from #_product_danhmuc where hienthi = 1 and noibat = 0  order by stt desc");
	$rs_product_danhmuc = $d->result_array();
	
?>

	
		<div class="container">
		<div class="row">
	<ul id="main-nav"  class="nav-request" >
				
				
				<?php 
				
					$d->query("select id,tenkhongdau,ten_$lang from #_product_danhmuc where hienthi = 1 order by stt desc");
					foreach($d->result_array() as $k=>$v){
						?><li <?=(($com=="hang-doi-tra" & @$_GET['id_danhmuc'] == $v['id'])) ? 'class="active"' : ''?> ><a href="hang-doi-tra/<?=$v['id']?>_<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>">
						
							<p><?=$v['ten_'.$lang]?> đổi trả</p>
							<span class="number">
								<?php 
									$d->query("select id from #_product where hienthi = 1 and is_request = 1 and id_danhmuc  = ".$v['id']);
									echo $d->num_rows();
								?>
								&nbsp;sản phẩm
							
							</span>
						</a>
						</li>
						<?php 
					}
				
				?>
				
				
				<div class="clearfix"></div>
				
				
				
	</ul>

	
	

	<div class="clearfix"></div>

<div class="clearfix"></div>
</div>
</div>