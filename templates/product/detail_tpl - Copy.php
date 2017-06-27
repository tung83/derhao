<!--<script type="text/javascript" src="assets/cloudzoom/js/cloud-zoom.1.0.2.min.js"></script> -->
 <script type="text/javascript" src="assets/etalage/jquery.etalage.min.js"></script> 
 <link href="assets/etalage/etalage.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53a83dd63e4b5e75"></script>
<script language="javascript">
	function addtocart(pid){
		document.form1.productid.value=pid;
		document.form1.command.value='add';
		document.form1.submit();
	}
</script>

<form name="form1" action="index.php">
	<input type="hidden" name="productid" />
    <input type="hidden" name="command" />
</form>

<div class="" id="product-detail">
	
	
	<div class="col-xs-12" id="detail">
		<div class="row">
		<div class="title"><?=_product_detail?></div>
			<div class="col-xs-12" id="main-detail">
					<div class="row">
						<div class="">    	

							<ul id="etalage">
								<li>
									<!-- Put the lightbox destination for this frame in the anchor tag -->
									
									
									<a href="<?=_upload_sanpham_l.$row_detail['photo']?>">
										<img class="etalage_thumb_image img-thumbnails" src="<?=_upload_sanpham_l.$row_detail['thumb']?>"  />
										<img class="etalage_source_image" src="<?=_upload_sanpham_l.$row_detail['photo']?>" title="<?=$row_detail['ten_'.$lang]?>" />
									</a>
								</li>
								<?php
									$ar = json_decode($row_detail['gallery']);
									if(count($ar) > 0){
										
													foreach($ar as $k=>$v){?>
														<li>
														<a href="<?=$config_url.$v?>">
															<img class="etalage_thumb_image" src="timthumb.php?src=<?=$v?>&w=400&h=300" />
															<img class="etalage_source_image" src="<?=$config_url.$v?>" title="<?=$row_detail['ten_'.$lang]?>" />
														</a>
														</li>
														
													<?php
													}
												
										
									}
									?>
								
								
							</ul>








						
							
								
							</div>
						</div><!--zoom-section end-->
				</div>
				
				<div class="col-xs-12 main-product-detail">
				<div class="row">
					<div class="title"><h1><?=$row_detail['ten_'.$lang]?></h1></div>
					<div class="clearfix"></div>
					<div class="content">
							<?php if($row_detail['maso']){
							echo '<p>'._masp.'<strong> '.$row_detail['maso'].'</strong></p>';
							}?>
							
							<div><?php echo $row_detail['mota_'.$lang]?></div>
							<div class="clearfix"></div>
							<!-- Go to www.addthis.com/dashboard to customize your tools -->
							<div class="addthis_native_toolbox"></div>
							
							
							<?php
								$gallery = json_decode($row_detail['gallery']);
								if(count($gallery) > 0){
									foreach($gallery as $k=>$v){
										?>
										 <div class="box photo col2" >
												<a href="<?=$config_url.$v?>">
												<img src="<?=$config_url.$v?>" alt="<?=$row_detail['ten_'.$lang]?>" /></a>
										</div>
										
										
										<?php
									
									
									}
								?>
								
							
					</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<p>&nbsp;</p>
				<div class="col-xs-12">
				<div class="row">
				<!-- Nav tabs -->
	<div class="title-global"><h3><?=_thongso?></div>
        <div class="thongso-kt">
            

  <?=$row_detail['noidung_'.$lang]?>
  
  </div>
  </div>
				</div><!-- end row -->
				
			
				
				
				
				
				
				
				
				
				
				
				<div class="clearfix">
				
					
					
					
						
				</div>
		</div>
		<!-- end row -->

		
		
		
		
		
		
		
		
		
		
		
		
	</div>
	



<div class="clearfix"></div>


	
</div>
<script>

					Galleria.loadTheme('assets/image_anim/galleria.folio.min.js');
								$("#container1").galleria({
									
									height:100,
									imageCrop: false,
									maxScaleRatio: 1,
									preload: 3,
									fullscreenTransition:'slide'
								});
								Galleria.run('#container1', {
								  height: parseInt($('#container1').css('height')),
								  wait: true
								 });
								
								
  $(function(){

    var $container = $('#container1');
  
    $container.imagesLoaded( function(){
      $container.masonry({
        itemSelector : '.box'
      });
    });
  
  });


						</script>
	<script>
			$(document).ready(function(){
				$('#etalage').etalage({thumb_image_width: 350,
					
				
					zoom_area_width: 548,});
			});

			// Invoke the Fancybox plugin when an image is clicked
			function etalage_click_callback(image_anchor, instance_id){
				$.fancybox({
					href: image_anchor
				});
			}
		</script>
