<div class="container">
<div class="wrap-all-product">
    <div class="">
        <div class="global-title">
            <h2><?=_search_result?></h2>
            <div class='clearfix'></div>
        </div>
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
						if($v['type']=="instock"){
							$v['type'] = "promotion";
						}	
					?>
					<a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
						<img src="thumb/340x240/1/<?=_upload_sanpham_l.$v['photo']?>"  alt="<?=$v['ten_'.$lang]?>" />
					</a>
					<div class="name-wrap">
						<div class="name">
						<h2><a href="<?=$v['type']?>/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html" title="<?=$v['ten_'.$lang]?>">
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
			<input type="hidden" name="keyword" id="control" value="<?=$_GET['keyword']?>">
			
		</form>
		
		<div class="view-more-product">
			<a href="" class="anim-05"><?=_xemthem?>&nbsp;<i class="fa fa-arrow-down"></i></a>
			
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
							history.pushState(stateObj, "", "search.html/keyword=<?=$_GET['keyword']?>&p="+data.page);
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
					$str+= '<a href="'+item.type+'/'+item.tenkhongdau+'-'+item.id+'.html" title="'+item.ten_<?=$lang?>+'">';
					$str+= '<img src="thumb/340x240/1/<?=_upload_sanpham_l?>'+item.photo+'"  alt="'+item.ten_<?=$lang?>+'" />';
					$str+= '</a>';
					$str+= '<div class="name-wrap">';
					$str+= '<div class="name">';
					$str+= '<h2><a href="'+item.type+'/'+item.tenkhongdau+'-'+item.id+'.html" title="'+item.ten_<?=$lang?>+'">';
					$str+= item.ten_<?=$lang?>+'</a></h2></div></div></div></div>';
					return $str;
				}
			})
		</script>
        <!-- end col-xs-12-->
        <div class="clearfix"></div>
    </div>
</div>
</div>