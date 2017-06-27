
					<div class="title"><?=_new_product_?></div>
					<div class="content col-xs-12 content-new-product">	
							<script src="assets/carousel/js/jquery.flexisel.js" type="text/javascript"></script>
<link href="assets/carousel/css/style.css" rel="stylesheet" type="text/css" />
<section>
<?php
	$d->reset();
	$d->query("select * from #_product where hienthi = 1 and spmoi = 1 order by stt,id desc");
	$logo = $d->result_array();

	
?>	
	<div style="position:relative">
	<a href="" class="ar-fl" onclick="$('.nbs-flexisel-nav-left').click();return false"><img src="assets/img/left.png"></a>
	<a href="" class="ar-fl right-nav" onclick="$('.nbs-flexisel-nav-right').click();return false"><img src="assets/img/right.png"></a>
	<div style="overflow: hidden;
background: #FFFFFF;
border-radius: 7px;
width: 637px;
margin-left: 32px;
margin-top: 25px;
padding-bottom: 26px;
margin-bottom: 30px;">
		<ul id="flexiselDemo3">
		<?php
			foreach($logo as $k=>$v){
				echo '<li><a href="san-pham/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'"><img src="'._upload_sanpham_l.$v['thumb'].'" /></a>';
				echo '<div class="name">'.$v['ten_'.$lang].'</div>';
				echo '<div class=""><a href="javascript:void(0)" onclick="addtocart('.$v['id'].')"><img style="width:105px; height:30px" src="assets/ico/cart_'.$lang.'.png" /></a></div>';
				
				
				
				
				
				
				
				echo '</li>';
				
			}
		
		
		?>
			
			
		</ul>    
		<div class="clearfix"></div>
	</div>	
		<div class="clearfix"></div>
	</div>
		<div class="clearfix"></div>
		
		</section>
		<script>
		$().ready(function(){
			 $("#flexiselDemo3").flexisel({
				visibleItems: 5,
				animationSpeed: 600,
				autoPlay: true,
				autoPlaySpeed: 3000,            
				pauseOnHover: true,
				enableResponsiveBreakpoints: false,
				responsiveBreakpoints: { 
					
				}
			});
		})
		</script>
		<style>

</style>
					
					</div>
					<div class="clearfix"></div>
		
			