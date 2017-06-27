<script src="assets/plugins/carousel/js/jquery.flexisel.js" type="text/javascript"></script>
<script src="assets/js/colorup_min.js" type="text/javascript"></script>
<link href="assets/plugins/carousel/css/style.css" rel="stylesheet" type="text/css" />
<section>

<?php
	$d->reset();
	$d->query("select * from #_doitac where hienthi = 1 order by stt,id desc");
	$logo = $d->result_array();

	
?>
<div class="container">
<div id="wrap-logo">
<div class="" id="logo-partne">
<div class="">


</div>
		<ul id="flexiselDemo3">
			<?php
			foreach($logo as $k=>$v){
				echo '<li class="wow fadeInUp " data-wow-offset="100" data-wow-duration="1" data-wow-delay="'.(0.2*$k).'s"><div><div class="inner-target"><a target="_blank" title="'.$v['mota'].'" href="'.$v['mota'].'"><img src="thumb/140x140/3/'._upload_hinhanh_l.$v['photo'].'" class="img-responsive colorup"  effect="Light" speed="300" inverse="true" alt="'.$v['ten'].'"/></a></div></div></li>';
			}
		
		
		?>
		
			
		</ul>    

		<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		</div>

		
		</div>
		
		<script>
		$().ready(function(){
			 $("#flexiselDemo3").flexisel({
				visibleItems:4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,            
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				portrait: { 
					changePoint:480,
					visibleItems: 2
				}, 
				landscape: { 
					changePoint:640,
					visibleItems: 2
				},
				tablet: { 
					changePoint:768,
					visibleItems: 3
				}
				
			});
		})
		</script>
		</section>