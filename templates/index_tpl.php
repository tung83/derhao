<link href="assets/css/index.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
	<div class="row">
    <section>
	<div class="global-title">
		<h2><?=_new_collection?></h2>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
	<div class="content">
		<ul id="list-collection">
			<?php 
				$d->query("select ten_$lang,tenkhongdau,new,type,photo,id,sale from #_product where type = 'fabric' and hienthi = 1 and noibat = 1 order by stt desc limit 8");
				foreach($d->result_array() as $k=>$v){
					$link=changeTitle(_fabric);
					?>
					<li class="col-md-3">
						<div class="new-product">
							<?php 
							
								if($v['new']){
									echo '<div class="new-rb"></div>';
								}
								
								if($v['sale']){
									echo '<div class="sale-rb"></div>';
								}
							?>
							
							<a href="<?=$link?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
								<img src="thumb/340x240/1/<?=_upload_sanpham_l.$v['photo']?>" alt="<?=$v['ten_'.$lang]?>" />
							</a>
							<div class="name-wrap">
								<div class="name">
								<h2><a href="<?=$link?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
									<?=$v['ten_'.$lang]?>
								</a></h2>
								</div>
							</div>
						</div>
					
					</li>
					<?php 
				}
			?>
		
		</ul>
		
	</div>
	
	
    </section>
<div class="clearfix"></div>

<section>
	<div class="global-title">
		<h2><?=_product?></h2>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
	<div class="content">
		<ul id="list-home-product">
			<?php 
				$d->query("select ten_$lang,tenkhongdau,new,type,photo,id,sale from #_product where type = 'product' and hienthi = 1 and noibat = 1 order by stt desc limit 8");
				foreach($d->result_array() as $k=>$v){
					$link=changeTitle(_product);
					?>
					<li class="col-md-3">
						<div class="new-product">
							<?php 
							
								if($v['new']){
									echo '<div class="new-rb"></div>';
								}
								
								if($v['sale']){
									echo '<div class="sale-rb"></div>';
								}
							?>
							
							<a href="<?=$link?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
								<img src="thumb/340x240/1/<?=_upload_sanpham_l.$v['photo']?>" alt="<?=$v['ten_'.$lang]?>" />
							</a>
							<div class="name-wrap">
								<div class="name">
								<h2><a href="<?=$link?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
									<?=$v['ten_'.$lang]?>
								</a></h2>
								</div>
							</div>
						</div>
					
					</li>
					<?php 
				}
			?>
		
		</ul>
		
	</div>
	
	
    </section>
<div class="clearfix"></div>
</div>
</div>
<script>	
	$().ready(function(){
            if($( window ).width() <= 768){
		$("#list-collection").owlCarousel({items:2,loop:true,nav:false,autoplay:true,responsive:{
                400:{
                    items:2,

                },
                         600:{
                    items:2,

                },
                768:{
                    items:2,

                }
                }});
                
                $("#list-home-product").owlCarousel({items:2,loop:true,nav:false,autoplay:true,responsive:{
                400:{
                    items:2,

                },
                         600:{
                    items:2,

                },
                768:{
                    items:2,

                }
                }});
            }
        })

</script>


