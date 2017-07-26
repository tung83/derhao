<div class="container">
<div class="wrap-all-product">
    <div class="category-list">
		<ul>
		<?php
                    if($v['type']=='product'){
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
    <div class="clearfix"></div>
    <div id="product-wrap">
        
            <div class="row">
				<div id="info-wrap">
                <?php foreach($product as $k=>$v){ 
				?>
				<div class=" col-xs-B-6 col-xs-6 col-md-3 col-sm-4">
				<div class="new-product">
					<?php 
						if($v['new']){
							echo '<div class="new-rb"></div>';
						}
						if($v['sale']){
									echo '<div class="sale-rb"></div>';
						}
						if($v['type']=='product'){
							$link=changeTitle(_product);
						}else if($v['type']=='instock'){
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
				</div>
                <div class="clearfix"></div>
            </div>
			<?php 
				
				$page = (@$_GET['p']) ? $_GET['page'] : 1;
				$max = $paging['totalPage'];
			
			?>
		<form id="form-controller" class="hide">
		
			<input type="hidden" name="current_page" id="current_page" value="<?=(@$_GET['p']) ? $_GET['page'] : 1?>">
			<input type="hidden" name="max_page" id="max_page" value="<?=$paging['totalPage']?>">
			<input type="hidden" name="perpage" id="perpage" value="<?=$paging['perPage']?>">
			<input type="hidden" name="com" id="control" value="<?=$com?>">
			<input type="hidden" name="type" id="type" value="<?=$stype?>">
			<input type="hidden" name="category" id="category" value="<?=@$_GET['id_danhmuc']?>">
		</form>
		
		<div class="view-more-product">
			<a href="" class="anim-05"><?=_xemthem?></a>
			
		</div>
		<script>
			$().ready(function(){
				function checkViewmoreAvailable(){
					$f = $("#form-controller");
					$m = $f.find("#max_page").val();
					$c = $f.find("#current_page").val();
					if(parseInt($m) > parseInt($c)){
						$(".view-more-product").fadeIn();
					}else{
						$(".view-more-product").fadeOut();
					}
					
				}
				checkViewmoreAvailable();
				$(".view-more-product a").click(function(){
					$form = $("#form-controller");
					$.ajax({
						url:"index.php",
						data:$form.serialize(),
						dataType:"json",
						success:function(data){
							$.each(data.data,function(index,item){
								$("#info-wrap").append(addToProduct(item));
							})
							var stateObj = { foo: "bar" };
							history.pushState(stateObj, "", "<?=trim(getCurrentPageUrl(), "/")?>/p="+data.page);
							setCenterName();
							$form.find("#current_page").val(data.page);
							checkViewmoreAvailable();
						}
					})
					return false;
				})
				function addToProduct(item){
					$str = '<div class="col-xs-B-6 col-xs-12 col-md-3 col-sm-4">';
					$str+= '<div class="new-product">';					
					if(item.new==1){
						$str+=  '<div class="new-rb"></div>';
					}
					if(item.sale==1){
						$str+=  '<div class="sale-rb"></div>';
					}
					$str+= '<a href="<?=$com?>/'+item.tenkhongdau+'-'+item.id+'.html" title="'+item.ten+'">';
					$str+= '<img src="thumb/340x240/1/<?=_upload_sanpham_l?>'+item.photo+'"  alt="'+item.ten+'" />';
					$str+= '</a>';
					$str+= '<div class="name-wrap">';
					$str+= '<div class="name">';
					$str+= '<h2><a href="<?=$com?>/'+item.tenkhongdau+'-'+item.id+'.html" title="'+item.ten+'">';
					$str+= item.ten+'</a></h2></div></div></div></div>';
					return $str;
				}
			})
		</script>
        <!-- end col-xs-12-->
        <div class="clearfix"></div>
    </div>
</div>
</div>
<?php 
	$arr['product']['name'] = _wheretobuy;
	$arr['product']['id'] = 15;
	$arr['product']['link'] = 'where-to-buy.html';
	
	$arr['fabric']['name'] = _fabric_and_product;
	$arr['fabric']['id'] = 14;
	$arr['fabric']['link'] = 'product.html';
	
	$arr['promotion']['name'] = _contact;
	$arr['promotion']['id'] = 16;
	$arr['promotion']['link'] = 'contact.html';
	
	
	$img = getoXimg($arr[$com]['id']);
	$fix_com = $com;
	
	if($com=="product"){
		$fix_com = "fabric";
	}
	if($com=="fabric"){
		$fix_com = "product";
	}
	
	

?>
