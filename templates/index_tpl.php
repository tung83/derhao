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
				$d->query("select ten_$lang,tenkhongdau,new,type,photo,id,sale from #_product where hienthi = 1 and noibat = 1 order by stt desc limit 10");
				foreach($d->result_array() as $k=>$v){
					if($v['type']=='product'){
						$link=changeTitle(_product);
					}else{
						$link=changeTitle(_fabric);
					}
				
					?>
					<li>
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
		$("#list-collection").owlCarousel({items:2,loop:true,nav:false,autoplay:true,responsive:{
        400:{
            items:2,
           
        },
		 600:{
            items:2,
           
        },
        768:{
            items:2,
           
        },
        1000:{
            items:4,
           
        }
    }});
	})

</script>

<section>
	<div class="container-fluid">
		<div class="global-title double">
		<h2><?=_product?></h2>
		<div class="clearfix"></div>
		</div>
		<div class="content row">
			<div class="rel">
			<div class="content-view-image" >
			<?php 
				$d->query("select photo from #_baiviet where id = 7");
				$r = $d->fetch_array();
			
			?>
				<img src="<?=_upload_news_l.$r['photo']?>" alt="Home" class="img-responsive" />
				<div class="desc-view">
					<a href="product.html" title="Product" />FABRIC & <br /> PRODUCT</a>
				</div>
				
				
			</div>
			
			</div>
		</div>
		
	</div>
	

</section>

