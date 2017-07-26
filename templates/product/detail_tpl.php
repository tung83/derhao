<!-- <link href="assets/plugins/zoom/css/zoom.css" rel="stylesheet">
<script src="assets/plugins/zoom/js/zoom.js"></script>-->
<div class='container' id='product-detail-outter'>
	<div class="container wrap-all-product">
<div class="category-list">
		<ul>
		<?php
                    if($com=='product'){
                        $link=changeTitle(_product);
                        foreach($_list_product_danhmuc as $k=>$v){
                            $cls ='';
                            if($id_danhmuc==$v['id']){
                                    $cls = " class='active' ";
                            }
                            echo '<li'.$cls.'><a href="'.$link.'/'.$v['tenkhongdau'].'-'.$v['id'].'/" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
                        }
                    }
                                
		?>
		</ul>
    </div>	


<link href="assets/plugins/bxslider/jquery.bxslider.css" type="text/css" rel="stylesheet" />
 <script type="text/javascript" src="assets/plugins/elevatezoom-master/jquery.elevateZoom-3.0.8.min.js"></script> 
 <script type="text/javascript" src="assets/plugins/bxslider/jquery.bxslider.min.js"></script> 
 <script type="text/javascript" src="assets/js/product_detail.js"></script> 
<div class="" id="product-detail">
	<div id="detail">
		
			<div class="row">
			<div class="col-xs-12 col-md-5 col-sm-6 col-md-offset-1" id="main-detail">
						<?php 
						
                                                
                                                if($com=='product'){
                                                                $link=changeTitle(_product);
                                                }else if($com=='instock'){
                                                        $link=changeTitle(_promotion);
                                                }
                                                else{
                                                                $link=changeTitle(_fabric);
                                                }
						
						$ar = json_decode($row_detail['gallery2'],true);
						$im = _upload_sanpham_l.$row_detail['photo'];
						
						if(count($ar) > 0){
							$im = $config_url.$ar[0][0]['photo'];
							$desc = $ar[0][0]['desc'];
						}
						?>
						
						
						
						
						<div id="x_refesh">   
							<div class="wrap-on-image">	
								<img id="img_01" class="img-thumbnail" src="<?=$im?>" data-zoom-image="<?=$im?>"/>
								<div class="desc">
									<?=$desc?>
								</div>
							</div>
							<?php
								
									
									if(count($ar) > 0){
										?>
							<div id="gal1">
							<ul id="carousel" class="bx-slides">
							
							<?php 
                                                        
					foreach($ar as $k1=>$v1){
													foreach($v1 as $k2=>$v2){?>
														<li><a href="javascript:void(0)" data-name="<?=$v['desc']?>" data-image="<?=$config_url.$v2['photo']?>" data-zoom-image="<?=$config_url.$v2['photo']?>">
														<img id="img_01" src="<?=$config_url.$v2['photo']?>" class="img-responsive"/>
														</a></li>
													<?php
													}
                                        }
									
									?>
									</ul>
							</div>
							<?php } ?>
							</div>
					
				</div>
				
				<div class="col-xs-12 col-md-5 col-sm-6  main-product-detail">
				
					<div class="global-title"><h1><?=$row_detail['ten_'.$lang]?><?=($row_detail['maso']) ? '<br /><span class="code">'.$row_detail['maso'].'</span>' : ''?></h1><div class="clearfix"></div>
					</div>
					<?php include _template."/layout/share.php"?>
					<div class="clearfix"></div>
					<div class="content">
					<?php 
					$sizes = array();
					foreach(getSizeByProductId($row_detail['id']) as $k=>$v){
						$sizes[$v['id_danhmuc']][] = $v;
					}
					
					$d->query("select id,ten_$lang from #_product_size_danhmuc where hienthi = 1 order by stt desc");
					foreach($d->result_array() as $k2=>$v2){
							if(isset($sizes[$v2['id']])){
								?>
								<div class="attr-group">
									<div class="label2"><?=$v2['ten_'.$lang]?></div>
									<div class="content">
										<?php 
										foreach($sizes[$v2['id']] as $k=>$v){
											echo '<div class="size_item" data-id="'.$v['id_size'].'">';
												echo '<a href="javascript:void(0)" ><img data-toggle="tooltip"  title="'.$v['ten'].'" src="'._upload_sanpham_l.$v['photo'].'" alt="'.$v['ten'].'" /></a>';
											echo '</div>';
										}
										
										?>
									
									
									
									</div>
								
								</div>
								<div class="clearfix"></div>
								
								
								
								
								
								
								<?php 
							}
						
						
						
						?>
						
						
						
						<?php 
					}
						
							
						?>
						
							<div class="contact-link">
								<a href="<?=getLink(changeTitle(_contact).".html")?>" title="<?=_contact?>"><?=_contact?></a>
							</div>
							<div class="desc-place">
							<div class='clearfix'></div>
							<div class="wrap">
                                                                <?=$row_detail['noibat_'.$lang]?>
							</div>
							
							</div><!-- end desc-place -->
							
					
				</div><!-- end main-product-detail -->
				</div>
	</div>
	</div>
				<div class="clearfix"></div>
				<div class="mx-br">
				<div class="row-5">
				
				
				</div>
				<div class="clearfix"></div>
				</div>
				
				
				<div class="clearfix">
				</div>
				</div>
<div class="clearfix"></div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home"><?=_feature?></a></li>
  
    <?php 
        if(!($com=='product')){
    ?>
  <li><a data-toggle="tab" href="#menu1"><?=_wavetype?></a></li>
  <li><a data-toggle="tab" href="#menu2"><?=_productdetails?></a></li>
  
   <?php } ?>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
      <?php echo nl2br($row_detail['mota_'.$lang])?>
  </div>
    <?php 
        if(!($com=='product')){
    ?>
  <div id="menu1" class="tab-pane fade">
      <?php echo nl2br($row_detail['hoavan_'.$lang])?>
  </div>
  <div id="menu2" class="tab-pane fade">
      <?php echo nl2br($row_detail['noidung_'.$lang])?>
  </div>
   <?php } ?>
</div>

	
			<script>
			
				$().ready(function(){
				
					$(".mx-br .item-x a").click(function(){
						$for = $(this).data("for");
						$data = eval("_list_"+$for);
						$str = "";
						$.each($data,function(index,item){
							if(!$index){
									first = item.photo;
									desc = item.desc;
								//$(".wrap-on-image").find("img").attr("src",$url);
							//	$(".wrap-on-image").find("img").attr("data-zoom-image",$url);
							}
								$str+='<li><a  data-name="'+item.desc+'" href="javascript:void(0)" data-image="<?=$config_url?>'+item.photo+'" data-zoom-image="<?=$config_url?>'+item.photo+'"><img id="img_01" src="<?=$config_url?>'+item.photo+'" /> </a></li>';
						})
						$strx= '<div class="wrap-on-image"><img id="img_01" class="img-thumbnail" src="<?=$config_url?>'+first+'" data-zoom-image="<?=$config_url?>'+first+'"/><div class="desc">'+desc+'</div></div>';
						$strx+='<div id="gal1"><ul id="carousel" class="bx-slides">';
						$strx+=$str+"</ul></div>";
						$("#x_refesh").html($strx);
						
						
						$("#img_01").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: false,
		 loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});
		 //pass the images to Fancybox
		 $("#img_01").bind("click", function(e) {
		 var ez = $('#img_01').data('elevateZoom');
		 
	
		 $.fancybox(ez.getGalleryList()); 
		 return false; });
		

						
						
						
						
						
						
						initProduct();
						
							setTimeout(function(){
								 $("#x_refesh .bx-wrapper .bx-slides li a").click(function(){
									$name = $(this).data("name");
									$(".wrap-on-image .desc").html($name);
									return false;
								 })
							},500);
						
						
						
						return false;
						
					})
					
				})
			
			
			
			</script>
					<?php
						$d->query("select * from #_product where id_danhmuc = ".$row_detail['id_danhmuc'].' and id != '.$row_detail['id']." and hienthi  = 1 limit 8");
						$product = $d->result_array();										
					?>	
					
					
					
					<div class="wrap-all-product">
						
							<div class="global-title title2">
								<h2><?=_otherproducts?></h2>
								<div class='clearfix'></div>
							</div>
						
						<div class="clearfix"></div>
						<div id="product-wrap">
							
								<div class="row">
									<?php foreach($product as $k=>$v){ 
				?>
				<div class=" col-xs-B-6 col-xs-12 col-md-3 col-sm-4">
				<div class="new-product">
					<?php 
						if($v['new']){
							echo '<div class="new-rb"></div>';
						}
						if($v['sale']){
									echo '<div class="sale-rb"></div>';
								}
						
                                                        if($com=='product'){
                                                                        $link=changeTitle(_product);
                                                        }else if($com=='instock'){
                                                                $link=changeTitle(_promotion);
                                                        }
                                                        else{
                                                                        $link=changeTitle(_fabric);
                                                        }
					?>
					<a href="<?=$link?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
						<img src="thumb/340x240/1/<?=_upload_sanpham_l.$v['photo']?>"  alt="<?=$v['ten_'.$lang]?>" />
					</a>
					<div class="name-wrap">
						<div class="name">
						<h2><a href="<?=$link?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
							<?=$v['ten_'.$lang]?>
						</a></h2>
						</div>
					</div>
				</div>
				</div>
				
				
				<?php } ?>
									<div class="clearfix"></div>
								</div>
							
							<!-- end col-xs-12-->
							<div class="clearfix"></div>
						</div>
					</div>
					
					</div><!-- end container -->
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
			
	<script>
	function initProduct(){
			$("#carousel").bxSlider({
				
			
				slideMargin: 5,
				minSlides:5,
				maxSlides:5,
				moveSlides:1,
				slideWidth:($("#main-detail").width()/4),
				pager:0,
				auto:1,
				pause:2000,
				onSlideAfter:function($slideElement, oldIndex, newIndex){
					
					$("#carousel li").eq(newIndex).find("a").click();
					$("#carousel li").eq(newIndex).find("a").find("img").click();
					//alert("X");
					$img = $("#carousel li").eq(newIndex).find("a").data("image");
					$(".wrap-on-image > img").attr("src",$img);
					$(".wrap-on-image > img").attr("data-zoom-image",$img);
					
				
				
				}
			});
			
			
			
			
			
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

		</script>
			<script>
			function refreshImage($image){
					
					if($image.length > 0){
						first = false;
						$str = '';
						$.each($image,function(index,item){
							if(!index){
							first = item;
							}
							$str+='<li><a href="javascript:void(0)" data-image="<?=$config_url?>'+item+'" data-zoom-image="<?=$config_url?>'+item+'"><img id="img_01" src="<?=$config_url?>'+item+'" /> </a></li>';
							
							
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
				
				$(".product-bx").bxSlider({
					minSlides:4,
					maxSlides:4,
					moveSlides:1,
					slideWidth:$("#main-detail").width()/4,
					pager:0,
					
				})
				
			})
			
			</script>



</div>