<div id="bottom-page-wrapper">
<div  class="container" >

<div class='row'>
<section>
	<div class="col-xs-6 facebook-wrap">
		<div class="box row">
			<div class="inner-box">
				<div class="title">
					FACEBOOK FANPAGE
				</div>
				<div class="content">
				<div id="fb-root"></div>
	<script type="text/javascript">
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		
		window.fbAsyncInit = function() {
		  FB.Event.subscribe('edge.create', function(response) {
				document.cookie="security=ON";
				document.location='dev_face.php';
			});
		};
    </script>
	
    <div class="fb-like-box" data-href="<?=$rs_hotline['facebook']?>" data-width="530" data-height="350" data-colorscheme="light" data-show-faces="true" 
    data-header="false" data-stream="false" data-show-border="false"  style=""></div>
				</div>
			</div>
		</div>
		
	</div>
	
	
	
	
	
	
	<div class="col-xs-6 video-wrap">
		<div class="box row">
			<div class="inner-box">
				<div class="title">
					VIDEO - CLIPS
				</div>
				<div class="content">
				
				<?php 
								$d->query("select * from #_video where hienthi = 1 order by stt desc");
								$rs_video  =$d->result_array();
								
								echo '<div class="video-wrapper"><iframe id="iframe"  src="https://www.youtube.com/embed/'.getYoutubeIdFromUrl($rs_video[0]['link']).'" frameborder="0" allowfullscreen></iframe></div>';
							?>
							<select class="form-control" id="video-controls">
								<?php 
									foreach($rs_video as $k=>$v){
										
										echo '<option value="'.getYoutubeIdFromUrl($v['link']).'">'.$v['ten_'.$lang].'</option>';
									}
								
								?>
							</select>
							<script>
								$().ready(function(){
									$("#video-controls").change(function(){
									
										$("#iframe").attr("src","https://www.youtube.com/embed/"+$(this).val()+"?autoplay=1");									})
								})
							</script>
		
				
				</div>
			</div>
		</div>
		
	</div>
	
	
	
	
	
	

</section>
</div>
</div>

</div>
