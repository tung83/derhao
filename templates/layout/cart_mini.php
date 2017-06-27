<div class="cart-epx"><a href="gio-hang.html"><span class="red">(<span class="cart-num-2"><?=get_total()?></span>)&nbsp;</span>sản phẩm</a></div>
<div class="cart-mini" id="cart_mini" style="display: block;">	
<div class="mini-cart-title">
<a href="gio-hang.html">
	<i class="fa fa-shopping-bag"></i> <span class="wrap">[<span class="num-cart"><?=get_total()?></span>]</span>
</a>	
</div>
<h3 class="title">Giỏ hàng mini</h3>
<span class="close" title="Đóng lại"></span>
<div id="cart_loader"><div class="inner"><ul>	

<?php

 if(is_array($_SESSION['cart'])){
	foreach($_SESSION['cart'] as $k=>$v){
					$code  =$k;
                    $pid=$v['productid'];
                    $q=$v['qty'];					
                    $color = $v['color'];
                    $size = $v['size'];
                    $info=getProductInfo($pid);
                    $pname=get_product_name($pid);
                    $image = _upload_sanpham_l.$info['thumb'];
                    if($color){
                    $img = getProductThumbnailWidthColor($pid,$color);
                    if($img){
                    $image = $img;
                    }
                    }
                    if($q==0) continue;


?>

<li id="gio_hang_sp_<?=$k?>">	
	<a href="san-pham/<?= $info['id'] ?>/<?= $info['tenkhongdau'] ?>.html" target="_blank">
		<img src="thumb/60x60/1/<?=$image?>"  alt="<?=$pname?>" class="cart-img"></a>
	<h3><a href="san-pham/<?= $info['tenkhongdau'] ?>-<?= $info['id'] ?>.html" target="_blank" title="<?=$pname?>"><?=cutString($pname,70)?></a></h3>
	<h2>
	<?php 
					
                            echo  myformat($info['gia']);
	
	?><u></u>
	</h2>
	<a href="javascript:;" class="cart-remove" onclick="delorder_gh('<?=$k?>');" title="Xóa sản phẩm">Xóa</a>
	<div class="clearfix"></div>
	</li>



<?php 








	}					
	 
	 
	 
 }





?>











</ul>
</div>
<div class="empty-cart hide" style="border:1px solid #ccc;text-align:center">Không có sản phẩm nào trong giỏ hàng</div>
<p class="total">Tổng đơn hàng : <b id="gio_hang_tong"><?=myformat(get_order_total())?></b></p>
 </div>
<a href="gio-hang.html" class="cart-enter">Vào giỏ hàng</a>
</div>
<link href="assets/css/cart-mini.css" type="text/css" rel="stylesheet" />

<script>

</script>