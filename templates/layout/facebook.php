<div id="fancy" class="hidden-xs">
<img src="images/facebook.png" />
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
	
    <div class="fb-like-box" data-href="<?=$rs_hotline['facebook']?>" data-width="240" data-height="300" data-colorscheme="light" data-show-faces="true" 
    data-header="true" data-stream="false" data-show-border="true" ></div>
</div>
<style>
/*-----------------------Fancy----------------------------*/
#fancy{
	position:fixed;
	top:200px;
	right:0px;
	width:292px;
	transition:0.7s;
	z-index:170;
	height:180px;
	margin-right:-245px;
	color:#111 !important;
}
#fancy *{color:#111 !important}
#fancy:hover{
	transition:0.7s;
	margin-right:0px;
}
#fancy img{
	float:left;
	margin-top:10px;
}
</style>