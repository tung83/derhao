<?php
	$d->reset();
	$d->query("select * from #_social where hienthi = 1"); 
	$social = $d->result_array();
	?>
	
	<div id="social-air">
		<?php foreach($social as $k=>$v){
			echo '<a href="'.$v['link'].'" title="'.$v['ten'].'" target="_blank" title="'.$v['ten'].'"  data-placement="bottom"><img src="'._upload_hinhanh_l.$v['small_image'].'" alt="" /></a>';		
		}
		?>
	
	</div>	