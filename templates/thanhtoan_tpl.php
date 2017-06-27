<link href="assets/css/cart.css" type="text/css" rel="stylesheet" />

<style>
	table#tt td
	{
		height:30px;
	}
	table#tt td input.t
	{
		width:300px;
		height:20px;
		margin:3px 0px 5px 0px;
		border:1px solid #DDD;
	}
	table#tt span
	{
		color:red;
x;
	}
</style>

<div class="box_containerlienhe shop">
<div class="title-global"><h2>Đặt hàng và thanh toán</h2><div class="clearfix"></div></div> 
	<div class="content ">
	
	
	
	
	<div class="cus-info">
	
    <form method="post" class="form-horizontal from-thanhtoan" name="frm_order" action="" enctype="multipart/form-data" role="form" >          
	<div class="row">
		<div class="col-xs-12 col-lg-6 bill_form">
			<div class="title">Thông tin thanh toán</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label"><?=_fullname?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="bill[name]" id="ten" required type="text" value="<?=@$m['fullname']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label"><?=_phone?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="bill[phone]" id="dienthoai" type="text" required  value="<?=@$m['contact_phone']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label" ><?=_address?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="bill[address]"  id="diachi" type="text" required value="<?=@$m['contact_address']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">E-Mail<span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="bill[email]" id="email" type="email" required value="<?=@$m['email']?>" />
				
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">&nbsp;</label>
				<div class="col-sm-9">
					 <div class="checkbox">
				<label>
				  <input type="checkbox" name="same-address" checked value="1"> Giống thông tin người nhận
				</label>
			</div>
				</div>
			</div>
			
			
		</div>
		
		
		<div class="col-xs-12 col-lg-6 receive_form">
			<div class="title">Thông tin nhận hàng</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label"><?=_fullname?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="receive[name]" id="ten"  type="text" value="<?=@$m['fullname']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label"><?=_phone?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="receive[phone]" id="dienthoai" type="text"   value="<?=@$m['contact_phone']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label" ><?=_address?><span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="receive[address]"  id="diachi" type="text"  value="<?=@$m['contact_address']?>" />
				
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">E-Mail<span>*</span></label>
				<div class="col-sm-9">
					<input class="t form-control" name="receive[email]" id="email" type="email"  value="<?=@$m['email']?>" />
				
				</div>
			</div>
			<div  class="col-xs-offset-3" >
			 <div class="checkbox" style="margin-left:9px">
				<label>
				
				</label>
			</div>
			</div>
			
		</div>
	<div class='clearfix'></div>
	</div>
	
	
	<hr />
	
	<div class="row">
		
	<div class="col-xs-12 col-lg-6 payment">
			<div class="title">Hình thức thanh toán</div>
			<?php 
			
			
			
			$d->query("select ten_$lang,id,mota_$lang from #_hinhthucthanhtoan where hienthi = 1 order by stt desc");
			$pay = $d->result_array();
			foreach($pay as $k=>$v){?>
			<div class="radio">
			  <label>
				<input type="radio" name="trans" id="optionsRadios1" value="<?=$v['id']?>" <?=(!$k) ? 'checked' : ''?>>
				<?=$v['ten_'.$lang]?>
			  </label>
			</div>
			<?php } ?>
			<div class="desc">
				<?php 
					foreach($pay as $k=>$v){?>
						<div class="desc-payments desc-<?=$v['id']?> <?=($k) ? 'hide' : ''?>">
							<p><strong><?=$v['ten_'.$lang]?></strong></p>
							<?=convertString($v['mota_'.$lang])?>
						</div>
					<?php 
					}
				
				?>
			
			</div>
			
	</div>
	<script>	
		$(".payment input").click(function(){
			$(".payment .desc-payments").addClass("hide");
			$(".payment .desc-"+$(this).val()).removeClass("hide");
		})
	
	</script>
		<div class="col-xs-12 col-lg-6 trans-type">
			<div class="title">Hình thức vận chuyển</div>
			<?php 
			
			
			
			$d->query("select ten_$lang,id,gia from #_hinhthucvanchuyen where hienthi = 1 order by stt desc");
			$pay = $d->result_array();
			foreach($pay as $k=>$v){?>
			<div class="radio">
			  <label>
				<input type="radio" name="trans2" data-price="<?=$v['gia']?>" id="optionsRadios1" value="<?=$v['id']?>" <?=(!$k) ? 'checked' : ''?>>
				<?=$v['ten_'.$lang]?> - <strong><?=myformat($v['gia'])?></strong>
			  </label>
			</div>
			<?php } ?>
			
	</div>
	
	</div>
	<script>
		$().ready(function(){
			
			$(".bill_form input").keyup(function(){
				if($("input[name=same-address]").is(":checked")){
				$id = $(this).attr("id");
				
				$val = $(this).val();
				$(".receive_form #"+$id).val($val);
				}
			})
			$("input[name=same-address]").change(function(){
				$(".bill_form input").trigger("keyup");
			})
			$(".trans-type input").click(function(){
				NProgress.start();
				$price = $(this).data("price");
				$.ajax({
					url:"ajax/update-transtype.html",
					data:{price:$price,id:$(this).val()},
					type:"post",
					dataType:"json",
					success:function(data){
						$(".total_cart_max .all-price .price").html(data.price);
						$(".total_cart_max .all-ship .price").html(data.ship);
						$(".total_cart_max .all-price-all .price").html(data.all);
						NProgress.done();
						
					}
				})
			})
			$(".trans-type input").first().trigger("click");
			
		})
	
	</script>
	
  
      
    
	</div>
	
	
	
	
	<div class="clearfix"></div>
	
	
	<hr />
	
	
	
	
	
	
	
	
	
	<div class="">
           <table id="giohang" class="table table-bordered " style="margin-top:10px">
                    <?
                    if(is_array($_SESSION['cart'])){
                    echo '<thead><th class="hidden-xs" align="center"></th><th>'._pname.'</th><th align="center">'._price.'</th><th align="center">'._quantity.'</th><th align="center">'._total_price.'</th></thead>';
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
                    $image = $config_url.$img;
                    }
                    }
                    if($q==0) continue;
                    ?>
                    <tr bgcolor="#FFFFFF"><td class="hidden-xs" width="10%" align="center"><a target="_blank"  href="san-pham/<?= $info['id'] ?>/<?= $info['tenkhongdau'] ?>.html"><img src="<?= $image ?>" class='img-responsive' /></a></td>
                        <td width="35%"><a class="name" target="_blank" href="san-pham/<?= $info['id'] ?>/<?= $info['tenkhongdau'] ?>.html"><?= $pname ?></a>
<?php
if ($color) {
    $colors = getColorByProductId($pid);
    echo '<div class="product-option"><label>Màu sắc: </label>';
    
    foreach ($colors as $k2 => $v2) {
		if($v2['id_color'] == $color){
			echo "<strong class='red'>".$v2['ten']."</strong>";
		}
    }
    echo '<div class="clearfix"></div></div>';
}
if ($size) {
    $sizes = getSizeByProductId($pid);
    echo '<div class="product-option"><label>Kích thước: </label>';
   
    foreach ($sizes as $k2 => $v2) {
        if($v2['id_size'] == $size){
			echo "<strong class='red'>".$v2['ten']."</strong>";
		}
    }
   

    echo '<div class="clearfix"></div></div>';
}
?>


                        </td>
                        <td width="10%" align="center">
                            <?php
                            if ($info['giacu'] > 0) {
                                echo '<div class="price-old">' . myformat($info['giacu']) . '</div>';
                            }
                            echo '<div class="price-real">' . myformat($info['gia']) . '</div>';
                            ?>
                        <td width="10%" align="center"><input type="text" name="product[<?=$code?>]" value="<?= $q ?>" maxlength="3" size="2" style="text-align:center; border:1px solid #F0F0F0" />&nbsp;</td>                    
                        <td width="18%" align="center" class="price-total"><?= number_format(get_price($pid) * $q, 0, ',', '.') ?>&nbsp;VNĐ</td>
                       
                    </tr>
<?php
}
?>
                    <tr><td colspan="6" style="padding:0" class="total_cart_max">	
							<div class="all-price"><span>Tổng giá: </span><span class="price"><?= number_format(get_order_total(), 0, ',', '.') ?></span></div>
							<div class="all-ship"><span>Ship: </span><span class="price">0</span></div>
							<div class="all-price-all"><span>Thành tiền: </span><span class="price"><?= number_format(get_order_total(), 0, ',', '.') ?></span></div>
                           
                        </td></tr>
                   
                    <?
                    }
                    else{
                    echo "<tr bgColor='#FFFFFF'><td class='empty'>Không có sản phẩm nào trong giỏ hàng!</td>";
                    }
                    ?>
                </table>	
				<?php 
				
					$m = $_SESSION['member_log'];
				
				?>
				</div>
		
		<div class="clearfix"></div>
   <div style="text-align: right; padding-top:20px;">
      
        <button title='tiếp tục' class="btn xbtn" type="submit"  value="" style="cursor:pointer;"/>Xác nhận và thanh toán <i class="fa fa-sign-in"></i></button>
    </div>
		
		</form>
		
 </div>  
 
 </div>