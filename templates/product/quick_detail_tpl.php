
<div class="" id="product-detail">
	<div id="detail">
	
		<div class="col-xs-12 col-md-5" id="main-detail">
			<div class="row">
				<div id="x_refesh">   
					<div class="wrap-on-image">
						<img id="img_01" class="img-thumbnail" src="<?=_upload_sanpham_l.$row_detail['photo']?>" data-zoom-image="<?=_upload_sanpham_l.$row_detail['photo']?>"/>
					</div>

				</div>
			</div><!--zoom-section end-->
	</div><!-- end main-detail -->		
	<div class="col-xs-12 col-md-7 main-product-detail">
		<div class="title"><h1><?=$row_detail['ten_'.$lang]?></h1></div>
		<div class="clearfix"></div>
		<div class="content">
			<ul class="ul-list-product-detail">
			<li><div class="raty" data-score="<?=$row_detail['score']?>" data-big="1"></div></li>
				<?php 
				if($row_detail['maso']){?>
				<li><?=_masp?>: <span class="code"><?=$row_detail['maso']?></span></li>
				<?php } ?>
				<?php 
					if($row_detail['giacu']){
						echo '<li class="old-price">'._giacu.': <span>'.myformat($row_detail['giacu']).'</span></li>';
						echo '<li class="new-price">'._giamoi.': <span>'.myformat($row_detail['gia']).'</span><span class="percent">'._tietkiem.' <strong class="red">'.getPercent($row_detail['giacu'],$row_detail['gia']).'%</strong></li>';
					}else{
						echo '<li>'._gia.': <span>'.(($row_detail['gia']) ? myformat($row_detail['gia']) : '<a href="'.getLink(changeTitle(_contact).".html".'">'._contact.'</a>').'</span></li>';
						
					}
				
				?>
				<li><?=_luotxem?>: <span class="fnr"><?=$row_detail['luotxem']?></span></li>
		   </ul>
			<div class="product-qty ">
									<div class="show"><label><?=_addcart?>:</label></div>
									<div>
									<div class="controls"><button class="fa fa-arrow-down"></button><input type="text" value="1" readonly id="qty" /><button class="fa fa-arrow-up is-up"></button></div>
									<div class="cart"><button class="add-cart" id="add-cart" data-id="<?=$row_detail['id']?>" data-name="<?=$row_detail['ten_'.$lang]?>"><?=_addcart?> <i class="fa fa-cart-plus"></i></button>  </div>
									</div>
								</div>
			<div class="add-cart hide">
				<?=_addcart?> <input type="number" id="qty" value="1">
				<button class="addcart" onclick="addToCart(<?=$row_detail['id']?>,'<?=$row_detail['ten_'.$lang]?>',true)"><i class="glyphicon glyphicon-shopping-cart"></i></button>
			</div>
			
		</div>
	</div><!-- end main-product-detail -->
	<div class="clearfix"></div>
	</div>					
</div>
	<script>
controlProductQty();
setRaty();
</script>