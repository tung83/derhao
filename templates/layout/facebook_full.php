<div class="container" id="facebook-full">

<?php 


?>
	<div id="sec-fanpage" style="max-height:265px;overflow:hidden;background:url(assets/img/ajax-loader.gif) no-repeat center center">
		
		<div class="clearfix"></div>
		<div class="content">
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=580130358671180&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like-box" style="background:#fff" data-href="<?=$result_hotline['facebook']?>" data-width="1200" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
		
		</div>
	</div>
	</div>

</section>