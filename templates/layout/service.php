<div class="col-xs-12">
		<div class="row service-top" >
			<?php
				$d->query("select * from #_service where hienthi = 1 and noibat = 1 order by stt desc");
				$rs_service = $d->result_array();
				foreach($rs_service as $k=>$v){
					echo '<div class="col-xs-3 service-item">';
						echo '<a href="dich-vu/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'"><img src="'._upload_tintuc_l.$v['thumb'].'"></a>';
						echo '<p><a href="dich-vu/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></p>';
					echo '</div>';
				}
			?>
		</div>
</div>