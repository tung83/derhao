<div class="wrap-all-product">
    
        <div class="global-title">
            <h2><?=$title_cat?></h2>
            <div class='clearfix'></div>
        </div>
    
    <div class="clearfix"></div>
    <div id="product-wrap">
        <div class='col-xs-12'>
            <div class="row">
                <?php foreach($product as $k=>$v){ showProduct($v); } ?>
                <div class="clearfix"></div>
            </div>
			<?=$paging[ 'paging']?>
        </div>
        <!-- end col-xs-12-->
        <div class="clearfix"></div>
    </div>
</div>