<link href="assets/css/product_detail.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="assets/plugins/elevatezoom-master/jquery.elevateZoom-3.0.8.min.js"></script>
<script type="text/javascript" src="assets/js/product_detail.js"></script>
<div class="" id="product-detail">
    <div id="detail">
        <div class="title">
            <?=_product_detail?>
        </div>
        <div class="col-xs-12 col-md-5 col-sm-5" id="main-detail">
            <div class="row">
                <div id="x_refesh">
                    <div class="wrap-on-image">
                        <img id="img_01" class="img-thumbnail" src="<?=_upload_sanpham_l.$row_detail['photo']?>"
                        data-zoom-image="<?=_upload_sanpham_l.$row_detail['photo']?>" />
                    </div>
                    <div id="gal1">
                        <ul id="carousel" class="bx-slides product-bx">
                            <li><a href="#" data-image="<?=_upload_sanpham_l.$row_detail['photo']?>" data-zoom-image="<?=_upload_sanpham_l.$row_detail['photo']?>"><img id="img_01" src="<?=_upload_sanpham_l.$row_detail['thumb']?>" /> </a>
                            </li>
                            <?php $ar=json_decode($row_detail[ 'gallery']); if(count($ar)>0){ foreach($ar as $k=>$v){?>
                            <li><a href="#" data-image="<?=$config_url.$v?>" data-zoom-image="<?=$config_url.$v?>">
														<img id="img_01" src="<?=$config_url.$v?>" class="img-responsive"/>
														</a>
                            </li>
                            <?php } } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!--zoom-section end-->
        </div>
        <div class="col-xs-12 col-md-7 col-sm-7  main-product-detail">
            <div class="fix-row">
                <div class="title">
                    <h1><?=$row_detail['ten_'.$lang]?></h1>
                </div>
                <?php include _template. "/layout/share.php"?>
                <div class="clearfix"></div>
                <div class="content">
                    <ul class="ul-list-product-detail">
                        <li>
                            <?php if(isset($brand)){ echo 'Hãng sản xuất: <a href="san-pham/'.$danhmuc[
                            'id']. '_'.$danhmuc[ 'tenkhongdau']. '/'.$brand[ 'tenkhongdau']. '.html">'.$brand[
                            'ten_'.$lang]. '</a>'; } ?>
                        </li>
                        <?php if($row_detail[ 'maso']){?>
                        <li>
                            <?=_masp?>: <span class="code"><?=$row_detail['maso']?></span>
                        </li>
                        <?php } ?>
                        <?php if($row_detail[ 'giacu']){ echo '<li class="old-price">'._giacu.
                        ': <span>'.myformat($row_detail[ 'giacu']). '</span></li>'; echo
                        '<li class="new-price">'._giamoi. ': <span>'.myformat($row_detail[ 'gia']).
                        '</span><span class="percent">'._tietkiem. ' <strong class="red">'.getPercent($row_detail[ 'giacu'],$row_detail[
                        'gia']). '%</strong></li>'; }else{ echo '<li>'._gia. ': <span>'.(($row_detail[
                        'gia']) ? myformat($row_detail[ 'gia']) : '<a href="lien-he.html">'._contact.
                        '</a>'). '</span></li>'; } ?>
                        <li>
                            <?=_luotxem?>: <span class="fnr"><?=$row_detail['luotxem']?></span>
                        </li>
                        <!-- <script>
						var color_image_default = <?=json_encode(array_merge(array("/"._upload_sanpham_l.$row_detail['photo']),objectToArray(json_decode($row_detail['gallery']))))?>;
						</script>
						<?php 
							$colors = getColorByProductId($row_detail['id']);
							
							if(count($colors) > 0){
								echo '<li id="p_color"><div class="pull-left">Màu sắc</div><div class="clearfix"></div>';
									foreach($colors as $k=>$v){
										echo '<script> var color_image_'.$v['id_color'].' = '.($v['image']).';</script>';
										echo '<div class="color_item" data-id="'.$v['id_color'].'" style="/*background:'.$v['bg_color'].';color:'.$v['text_color'].'*/">';
											echo $v['ten'];
										echo '</div>';
									}
									echo '<div class="clearfix"></div>';
								
								echo '</li>';
							}
						
						?>
						
						<?php 
							$sizes = getSizeByProductId($row_detail['id']);
							if(count($sizes) > 0){
								echo '<li id="p_size"><div class="pull-left">Kích cỡ</div><div class="clearfix"></div>';
									foreach($sizes as $k=>$v){
										echo '<div class="size_item" data-id="'.$v['id_size'].'">';
											echo $v['ten'];
										echo '</div>';
									}
									echo '<div class="clearfix"></div>';
								
								echo '</li>';
							}
						
						?>
						
						 -->
                    </ul>
                    <div class="product-qty hide">
                        <label>Chọn số lượng:</label>
                        <div>
                            <input type="text" value="1" id="qty" />
                        </div>
                        <div>
                            <button id="add-cart" data-id="<?=$row_detail['id']?>" data-name="<?=$row_detail['ten_'.$lang]?>">Thêm vào giỏ <i class="glyphicon glyphicon-play"></i>
                            </button>
                        </div>
                    </div>
                    <div class="desc-place">
                        <div class="tt">
                            <?=_mota?>
                        </div>
                        <div class='clearfix'></div>
                        <div class="wrap">
                            <?php echo convertString($row_detail[ 'mota_'.$lang])?>
                        </div>
                    </div>
                    <!-- end desc-place -->
                    <div class="add-cart hide">
                        <?=_addcart?>
                            <input type="number" id="qty" value="1">
                            <button class="addcart" onclick="addToCart(<?=$row_detail['id']?>,'<?=$row_detail['ten_'.$lang]?>',true)"><i class="glyphicon glyphicon-shopping-cart"></i>
                            </button>
                    </div>
                </div>
            </div>
            <!-- end main-product-detail -->
        </div>
    </div>
    <!-- end #detail -->
    <div class="clearfix"></div>
    <section>
        <div class="title">Thông số kỹ thuật</div>
        <div class="content">
            <?=$row_detail[ 'thongso_'.$lang]?>
        </div>
    </section>
	<section>
		<div class="row" id="xdetail">
			<div class='col-xs-8'>
				<div class="title">Đặc điểm nổi bật</div>
				<div class="content">
					<?=$row_detail[ 'noidung_'.$lang]?>
					<div class="clearfix"></div>
					<?php include _template."layout/comment.php" ?>
					
					
					
				</div>
			</div>
			<div class='col-xs-4 hide' id="product-other">
			<div class="xyz">
				<div class="title">Sản phẩm tương tự</div>
				<div class="content">
					<?php 
						$d->query("select * from #_product where id_danhmuc = ".$row_detail['id_danhmuc'].'
							and id != '.$row_detail['id']." and hienthi = 1 limit 6"); $product = $d->result_array();
							foreach($product as $k=>$v){ 
								?>
									<div class="product-mini">
										<div class="wrap-image">
											<a href="san-pham/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>">
												<img src="<?=_upload_sanpham_l.$v['thumb']?>" class="img-responsive" onerror="this.src='images/no_photo.png'"alt="<?=$v['ten_'.$lang]?>" />
											</a>
										</div>
										<div class="wrap-name">
											<h2><a href="san-pham/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html">
												<?=cutString($v['ten_'.$lang],25,"")?>
											</a></h2>
											<div class='clearfix'></div>
											<span class="price"><?=($v['gia']) ? myformat($v[ 'gia']) : '<a href="lien-he.html">'._contact.'</a>'?>
										
										</div>
									
									
									</div>
								
								
								<?php 
							
							
							}
							
					
					?>
				</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
    </section>
	<script>
		$().ready(function(){
			function fixTopSroll(){
				$body_top = $("body").scrollTop();
				$obj_top = $("#product-other").offset().top;
				if($body_top > $obj_top){	
				$fix_top = $body_top - $obj_top;
				$h1 = ($body_top - $obj_top)+$("#product-other .xyz").height();
				$h2 = $("#xdetail").height();
				if($h1 > $h2){
					$fix_top=$fix_top-($h1-$h2);
				}
				
				$("#product-other .xyz").addClass("fixed").css({marginTop:($fix_top+"px")});
				
				
				
				}else{
				$("#product-other .xyz").removeClass("fixed").css({marginTop:0});
				}
				
			}
			fixTopSroll();
			$(window).scroll(function(){
				
				fixTopSroll();
			})
		})
	
	</script>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<script>
    $(document).ready(function() {

        $(".color_item").click(function() {
            $(".color_item").removeClass("active");
            $(this).addClass("active");
            refreshImage(eval("color_image_" + $(this).data("id")));

        })
        $(".size_item").click(function() {
            $(".size_item").removeClass("active");
            $(this).addClass("active");

        })


    })
</script>
<script>
    function refreshImage($image) {

        if ($image.length > 0) {
            first = false;
            $str = '';
            $.each($image, function(index, item) {
                if (!index) {
                    first = item;
                }
                $str += '<li><a href="#" data-image="<?=$config_url?>' + item + '" data-zoom-image="<?=$config_url?>' + item + '"><img id="img_01" src="<?=$config_url?>' + item + '" /> </a></li>';


            })
            $strx = '<div class="wrap-on-image"><img id="img_01" class="img-thumbnail" src="<?=$config_url?>' + first + '" data-zoom-image="<?=$config_url?>' + first + '"/></div>';
            $strx += '<div id="gal1"><ul id="carousel" class="bx-slides">';
            $strx += $str + "</ul></div>";
            $("#x_refesh").html($strx);
            initProduct();
        } else {
            refreshImage(color_image_default);


        }


    }
</script>