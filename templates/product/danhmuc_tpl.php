<div class="title-global-root"><h2><?=$tmp['ten_'.$lang]?></h2>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="col-xs-12">
    <div class="">	
	<?php 
	
		foreach($product_list as $k2=>$v2){
		
		$d->query("select id,ten_$lang,tenkhongdau,photo,thumb from #_product where id_list = ".$v2['id']." and hienthi = 1 and noibat = 1 order by stt desc");
		$product = $d->result_array();
	?>
 <section>
		<div class="title-global"><h2><a href="san-pham/<?=$tmp['tenkhongdau']?>/<?=$v2['id']?>/<?=$v2['tenkhongdau']?>.html" title="<?=$v2['ten_'.$lang]?>"><?=$v2['ten_'.$lang]?></a></h2><div class='clearfix'></div></div>

                    
                    <div class="wrap-product row">
                       
								<div class='clearfix'></div>
								
                                    <div class="product-group ">
											
                                            <?php
                                           
                                            foreach ($product as $k => $v) {
                                              
                                               ?>
											   <div class="product-item-wrap col-xs-4">
                                                <div class="product-item ">
                                                        <div class="">	
														
                                                            <div class="product-image">
																 <a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>">
																<div class="wrap">
                                                               <img class="img-responsive has-tt" data-original="<?php if ($v['thumb'] != NULL) echo _upload_sanpham_l . $v['thumb'];
                                            else echo 'images/noimage.gif'; ?>" alt="" />
																</div></a>
															</div>
															<div class="product-code">
                                                                MSSP: <?=$v['maso']?>
                                                            </div>
                                                            <div class="product-name">
                                                                <h2><a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>"><?php echo $v['ten_' . $lang] ?></a></h2>
                                                            </div>
															<div class="clearfix"></div>
															<div class="view-detail">
																<div class="view-button anim">
																	<a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>">Xem chi tiết</a>
																
																</div>
															
															</div>
															<div class="product-price">
                                                                Giá :&nbsp;<span><?=($v['gia']) ? myformat($v['gia']) : _contact?></span>
                                                            </div>
															

                                                            <!-- <div  class="cart"><a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>" >Giá sản phẩm</a></div>-->
                                                        </div>
                                                    </div><!-- product-item -->
												</div>

                                                <?php
                                               
                                            }
                                            ?>
                                       

                                        <div class="clearfix"></div>

</div>
</div>
     </section>
		<?php } ?>

</div>
</div>