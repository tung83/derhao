<link href="assets/css/box-special.css" rel="stylesheet" type="text/css" />
<div class="container">
	<div class="row">
		<div class="row" id="box-footer">
			<div class="col-xs-3">
				<div class="box box-special">
					<div class="title">CAM KẾT CỦA CHÚNG TÔI</div>
					<div class='clearfix'></div>
					<div class='content'>
						<ul>
						<?php 
							$d->query("select ten_$lang,id,tenkhongdau from #_content where hienthi = 1 and noibat = 1 and type='commit' order by stt desc");
							foreach($d->result_array() as $k=>$v){
								echo '<li><a href="cam-ket/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
							}
						
						?>
						</ul>
					</div>
				</div>
			</div><!-- end box -->
			
			<div class="col-xs-3">
				<div class="box ">
					<div class="title">HỖ TRỢ KHÁCH HÀNG</div>
					<div class='clearfix'></div>
					<div class='content'>
						<ul>
						<?php 
							$d->query("select ten_$lang,id,tenkhongdau from #_content where hienthi = 1 and noibat = 1 and type='support' order by stt desc");
							foreach($d->result_array() as $k=>$v){
								echo '<li><a href="ho-tro/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
							}
						
						?>
						</ul>
					</div>
				</div>
			</div><!-- end box -->
			
			<div class="col-xs-3">
				<div class="box ">
					<div class="title">THÔNG TIN CÔNG TY</div>
					<div class='clearfix'></div>
					<div class='content'>
						<ul>
						<?php 
							$d->query("select ten_$lang,id,tenkhongdau from #_content where hienthi = 1 and noibat = 1 and type='info' order by stt desc");
							foreach($d->result_array() as $k=>$v){
								echo '<li><a href="thong-tin/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
							}
						
						?>
						</ul>
					</div>
				</div>
			</div><!-- end box -->
			
			<div class="col-xs-3">
				<div class="box ">
					<div class="title">TỔNG ĐÀI TƯ VẤN HỖ TRỢ</div>
					<div class='clearfix'></div>
					<div class='content support'>
					<?php 
						$d->query("select * from #_hotline");
						$rs_hotline = $d->fetch_array();
					
					?>
						<div class="left-icon">
							<img src="assets/img/support-icon.png" class="img-circle" />
						</div>
						<div class="right-tv">
							Tư vấn bán hàng:
							<div>
								<span><?=$rs_hotline['tuvan_'.$lang]?></span>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="hotline">
							<div>Hotline: <span><?=$rs_hotline['hotline_'.$lang]?></span></div>
							<div>Email: <span class="email"><?=$rs_hotline['email_'.$lang]?></span></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div><!-- end box -->
			
			
		</div>
	</div>

</div>