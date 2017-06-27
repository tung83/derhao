<?php
$d->reset();
	$sql_product_danhmuc="select ten,tenkhongdau,id from #_product_danhmuc where hienthi=1 and noibat=1 order by stt,id desc";
	$d->query($sql_product_danhmuc);
	$product_danhmuc=$d->result_array();
	for($i=0;$i<count($product_danhmuc);$i++){
?>
	<div class="dm">
    	<a href="san-pham/<?=$product_danhmuc[$i]['id']?>/<?=$product_danhmuc[$i]['tenkhongdau']?>.html">
        <?=$product_danhmuc[$i]['ten'];?>
        </a>
    </div>
<?php 
	}
?>