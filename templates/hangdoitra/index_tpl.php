<div class="wrap-all-product">
    <div class="">
	
	
	<div class="title-product-category is_cate">
		 <h2 class="first-root"><?=$title_cat?></h2>
		 <div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		
	
	
	
	
	
	
	
	
	
	
	
        
    </div>
    <div class="clearfix"></div>
    <div id="product-wrap">
        <div class='col-xs-12'>
            <div class="row">
                <?php foreach($product as $k=>$v){ showProduct($v,array("slug"=>"hang-doi-tra")); } ?>
                <div class="clearfix"></div>
            </div>
			<?=$paging[ 'paging']?>
        </div>
        <!-- end col-xs-12-->
        <div class="clearfix"></div>
    </div>
</div>