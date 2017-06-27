<link href="assets/css/video-widget.css" rel='stylesheet' type='text/css' />
<div class="container">
	<div class="" id="widget-video">
	<div class="col-md-8 col-sm-8 col-xs-12">
		<div class="row fix-about">
			
			<div class="clearfix"></div>
			<div class="content">
				<?php	
					$d->query("select ten_$lang,thumb,id,mota_$lang,tenkhongdau from #_content where type='about' and hienthi = 1 and noibat = 1 order by stt desc limit 1");
					if($d->num_rows()){
					$rs_about = $d->fetch_array();
					echo '<h1 class="x-about-text">'.$rs_about['ten_'.$lang].'</h1>';
					echo '<img style="max-width:266px;margin-right:7px" class="pull-left img-thumbnail" src="'._upload_news_l.$rs_about['thumb'].'" alt="Giới thiệu">';
					echo convertString($rs_about['mota_'.$lang]);
					echo '<div class="clearfix"></div>';
					echo '<a href="gioi-thieu/'.$rs_about['id'].'/'.$rs_about['tenkhongdau'].'.html" class="view-more" title="Xem thêm">Xem thêm &raquo;&raquo;</a>';
					}
				?>
				
			
			</div>
		
		</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="row">
			
			<div class="clearfix"></div>
			<div class="content">
		<?php 
								$d->query("select * from #_video where hienthi = 1 order by stt desc");
								$rs_video  =$d->result_array();
								
								echo '<div class="video-wrapper"><iframe id="iframe"  src="https://www.youtube.com/embed/'.getYoutubeIdFromUrl($rs_video[0]['link']).'" frameborder="0" allowfullscreen></iframe></div>';
							?>
							<select class="form-control" id="video-control">
								<?php 
									foreach($rs_video as $k=>$v){
										
										echo '<option value="'.getYoutubeIdFromUrl($v['link']).'">'.$v['ten_'.$lang].'</option>';
									}
								
								?>
							</select>
							<script>
								$().ready(function(){
									$("#video-control").change(function(){
										$("#iframe").attr("src","https://www.youtube.com/embed/"+$(this).val()+"?autoplay=1");									})
								})
							</script>
		
		</div>
		</div>
		</div>
		
		
	
	</div>

</div>