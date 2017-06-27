<?php

$d->query("select * from #_index where hienthi = 1 and location  = 2 order by stt desc");
$rs_ = $d->result_array();
?>
<div class="footer-link">
	<?php 
		foreach($rs_ as $k=>$v){
			echo '<div class="item-link">';
				echo '<a href="'.$v['mota'.$lang].'" target="_blank" title="'.$v['ten_'.$lang].'">';
					echo '<img src="'._upload_news_l.$v['thumb'].'" alt="'.$v['ten_'.$lang].'" />';
				echo '</a>';
				echo '<div class="name"><a href="'.$v['mota'.$lang].'" target="_blank" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></div>';
			
			echo '</div>';
			
		
		
		}
	
	?>

</div>
