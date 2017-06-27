<link href="assets/plugins/camera/css/camera.css" type="text/css" rel="stylesheet" />
<link href="assets/plugins/camera/css/slider.css" type="text/css" rel="stylesheet" />
<script src="assets/plugins/camera/scripts/camera.min.js"></script>
<script src="assets/plugins/camera/scripts/jquery.easing.1.3.js"></script>
<?php
$d->reset();
$d->query("select * from #_slider where hienthi = 1	and type='slider' order by stt,id desc");
$slider = $d->result_array();
?>
<div id="slider-camera-wrapper">


<div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
<?php 
	foreach($slider as $k=>$v){
		?>
		<div data-thumb="" data-src="<?=_upload_hinhanh_l.$v['photo']?>">
		<div class="camera_caption fadeFromBottom hide">
                    <h2><a class="anim-05" href="<?=$v['link']?>" title="<?=$v['ten']?>">
					<?=$v['ten']?>
					</a></h2>
					<div class="desc">
						<?=convertString($v['mota'])?>
					
					</div>
                </div>
		</div>
		<?php 
	}

?>

        </div><!-- #camera_wrap_1 -->





<div class="clearfix"></div>


</div>
<script>
	$().ready(function(){
		
			$('#camera_wrap_1').camera({
				thumbnails: true,
				autoAdvance:true,
				time:4000,
			});
			$('#camera_wrap_1 .cameraContents').addClass("container");
			

			
	
	})
</script>