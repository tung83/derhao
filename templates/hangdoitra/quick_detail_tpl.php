<script type="text/javascript" src="assets/plugins/elevatezoom-master/jquery.elevateZoom-3.0.8.min.js"></script> 

<div class="" id="product-detail">
	<div id="detail">
		<div class="title"><?=_product_detail?> <a href="san-pham/<?=$row_detail['id']?>/<?=$row_detail['tenkhongdau']?>.html" class="view-detail">Xem chi tiết</a></div>
		<div class="col-xs-5" id="main-detail">
			<div class="row">
				<div id="x_refesh">   
					<div class="wrap-on-image">
						<img id="img_01" class="img-thumbnail" src="<?=_upload_sanpham_l.$row_detail['photo']?>" data-zoom-image="<?=_upload_sanpham_l.$row_detail['photo']?>"/>
					</div>
					<div id="gal1">
					<ul id="carousel" class="bx-slides">
					<li><a href="#" data-image="<?=_upload_sanpham_l.$row_detail['photo']?>" data-zoom-image="<?=_upload_sanpham_l.$row_detail['photo']?>"><img id="img_01" src="<?=_upload_sanpham_l.$row_detail['thumb']?>" /> </a></li>
					<?php
						
							$ar = json_decode($row_detail['gallery']);
							if(count($ar) > 0){
											foreach($ar as $k=>$v){?>
												<li><a href="#" data-image="<?=$config_url.$v?>" data-zoom-image="<?=$config_url.$v?>">
												<img id="img_01" src="<?=$config_url.$v?>" class="img-responsive"/>
												</a></li>
											<?php
											}										
							}
							?>
							</ul>
					</div>
				</div>
			</div><!--zoom-section end-->
	</div><!-- end main-detail -->		
	<div class="col-xs-7 main-product-detail">
		<div class="title"><h1><?=$row_detail['ten_'.$lang]?></h1></div>
		<div class="clearfix"></div>
		<div class="content">
			<ul class="ul-list-product-detail">
				<?php 
				if($row_detail['maso']){?>
				<li><?=_masp?>: <span class="code"><?=$row_detail['maso']?></span></li>
				<?php } ?>
				<?php 
					if($row_detail['giacu']){
						echo '<li class="old-price">'._giacu.': <span>'.myformat($row_detail['giacu']).'</span></li>';
						echo '<li class="new-price">'._giamoi.': <span>'.myformat($row_detail['gia']).'</span><span class="percent">'._tietkiem.' <strong class="red">'.getPercent($row_detail['giacu'],$row_detail['gia']).'%</strong></li>';
					}else{
						echo '<li>'._gia.': <span>'.(($row_detail['gia']) ? myformat($row_detail['gia']) : '<a href="lien-he.html">'._contact.'</a>').'</span></li>';
						
					}
				
				?>
				<li><?=_luotxem?>: <span class="fnr"><?=$row_detail['luotxem']?></span></li>
		   </ul>
			<div class="product-qty">
				<label>Chọn số lượng:</label>
				<div><input type="text" value="1" id="qty2" /></div>
				<div><button id="add-cart2" data-id="<?=$row_detail['id']?>" data-name="<?=$row_detail['ten_'.$lang]?>">Thêm vào giỏ <i class="glyphicon glyphicon-play"></i></button>  </div>
			</div>
			<div class="add-cart hide">
				<?=_addcart?> <input type="number" id="qty" value="1">
				<button class="addcart" onclick="addToCart(<?=$row_detail['id']?>,'<?=$row_detail['ten_'.$lang]?>',true)"><i class="glyphicon glyphicon-shopping-cart"></i></button>
			</div>
			<?php
				$d->query("select * from #_product where id_danhmuc = ".$row_detail['id_danhmuc'].' and id != '.$row_detail['id']." and hienthi  = 1 limit 6");
				$product = $d->result_array();										
			?>	
			<div class="title"><h2>SẢN PHẨM CÙNG LOẠI</h2></div>
			<div class="wrap-product row">
				<div class="product-group" id="quick-same-product">
						<?php
						echo '<ul>';
						foreach ($product as $k => $v) {
							echo '<li class="col-xs-4 col-md-3 col-sm-3"><div>';
								echo '<a data-toggle="tooltip" href="san-pham/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">';
									echo '<img src="timthumb.php?src='.$config_url."/"._upload_sanpham_l.$v['thumb'].'&w=100&h=150" class="img-responsive"/>';
								
								echo '</a>';
							echo '</div></li>';
						   
						}
						echo '</ul>';
						?>
				<div class="clearfix"></div>
				</div>
			</div>	
		</div>
	</div><!-- end main-product-detail -->
	<div class="clearfix"></div>
	</div>					
</div>
	<script>
	
	$("#add-cart2").click(function(){
		$color = 0;
		$size = 0;
		$id = $(this).data("id");
		$qty = parseInt($("#qty2").val());
		if($("#p_color").length){
			if($("#p_color .color_item.active").length){
				$color = $("#p_color .color_item.active").data("id");
			}else{
				showMsg("warning","Vui lòng chọn màu cho sản phẩm!");
				$("html, body").animate({ scrollTop: $("#p_color").offset().top }, 500);
				return false;
			}
			
		}
		if($("#p_size").length){
			if($("#p_size .size_item.active").length){
				$size = $("#p_size .size_item.active").data("id");
			}else{
				showMsg("warning","Vui lòng chọn kích thước cho sản phẩm!");
				$("html, body").animate({ scrollTop: $("#p_size").offset().top }, 500);
				return false;
			}
			
		}
		doAddCart($(this).data("name"),$id,$qty,$color,$size);
		return false;
});  
	
	
	
			$().ready(function(){				
				$("#qty2").change(function(){
					if(!parseInt($(this).val(), 10)){
							$(this).val(1);									
					}
					if(parseInt($(this).val()) < 1){
						$(this).val(1);
					}
				})
				$(".tab-category li a").click(function(){
					$(".tab-category li").removeClass("active");
					$id = $(this).attr("href");
					$(this).parent().addClass("active");
					$(".tab-category .tab").fadeOut(function(){
						$(".tab-category .tab").removeClass("active");
						$(".tab-category .tab"+$id).fadeIn().addClass("active");
						
					})
					
					return false;
				})
				
			})
		
function initProduct(){
$("#carousel").bxSlider({
	

	slideMargin: 5,
	minSlides:5,
	maxSlides:5,
	moveSlides:1,
	slideWidth:($("#main-detail").width()/4),
	pager:0,
	
});



$("#img_01").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: false,
 });
 //pass the images to Fancybox
 $("#img_01").bind("click", function(e) {
 var ez = $('#img_01').data('elevateZoom');
 $.fancybox(ez.getGalleryList()); 
 return false; });
				}
$(document).ready(function(){
	initProduct();
				$(".color_item").click(function(){
					$(".color_item").removeClass("active");
					$(this).addClass("active");
					refreshImage(eval("color_image_"+$(this).data("id")));
					
				})
				$(".size_item").click(function(){
					$(".size_item").removeClass("active");
					$(this).addClass("active");
					
				})
				

})


			
			function refreshImage($image){
					
					if($image.length > 0){
						first = false;
						$str = '';
						$.each($image,function(index,item){
							if(!index){
							first = item;
							}
							$str+='<li><a href="#" data-image="<?=$config_url?>'+item+'" data-zoom-image="<?=$config_url?>'+item+'"><img id="img_01" src="<?=$config_url?>'+item+'" /> </a></li>';
							
							
						})
						$strx= '<div class="wrap-on-image"><img id="img_01" class="img-thumbnail" src="<?=$config_url?>'+first+'" data-zoom-image="<?=$config_url?>'+first+'"/></div>';
						$strx+='<div id="gal1"><ul id="carousel" class="bx-slides">';
						$strx+=$str+"</ul></div>";
					$("#x_refesh").html($strx);
					initProduct();
					}else{
						refreshImage(color_image_default);
						
						
					}
					
				
			}
			$().ready(function(){
				$h = $("#product-detail .desc-place").height();
				if($h > 200){
					$("#product-detail .desc-place").css({"overflow-y":"scroll"});
				}
				$("#product-detail .desc-place").css({visibility:"visible"});

				$(".product-bx").bxSlider({
					minSlides:4,
					maxSlides:4,
					moveSlides:1,
					slideWidth:$("#main-detail").width()/4,
					pager:0,
					
				})
				
			})
			
			</script>
