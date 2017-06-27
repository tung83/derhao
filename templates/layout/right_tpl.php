<?php

$d->query("select * from #_product where hienthi = 1 and hot = 1 order by stt desc limit 5");
$product = $d->result_array();
?>
<div class="right-title">
<h2>Sản phẩm hot</h2>

</div>
 <?php
foreach ($product as $k => $v) {
  ?>
	<div class="product-item">
			<div class="">
				<div class="product-image">
					<a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>"><img class="img-responsive has-tt" src="<?php if ($v['thumb'] != NULL) echo _upload_sanpham_l . $v['thumb'];
else echo 'images/noimage.gif'; ?>" alt="" /></a>
				</div>
				<div class="product-name">
					<a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>"><?php echo $v['ten_' . $lang] ?></a>
				</div>
				<div class="product-price">
					Giá sản phẩm:&nbsp;<span><?=($v['gia']) ? myformat($v['gia']) : _contact?></span>
				</div>

				<!-- <div  class="cart"><a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>" >Giá sản phẩm</a></div>-->
			</div>
		</div><!-- product-item -->
   

	<?php
	
}
