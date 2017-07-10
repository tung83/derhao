<?php
	session_start();
	$session=session_id();
	@define ( '_source' , './sources/');
	@define ( '_lib' , './admin/lib/');
	@define ( '_template' , './templates/');
	@define ( '_assets' , './assets/');
	include_once _lib."config.php";	
	//include_once _lib."cache/phpfastcache.php";	
	include_once _lib."constant.php";
	include_once _lib."class.database.php";
	include_once _lib."functions.php";	
	include_once _lib."functions_giohang.php";
	include_once _lib."model.php";	
	include_once _lib."file_requick.php";
	include_once _lib."libraries.php";	
	
?>
<!DOCTYPE html>
<html lang="vi|en">
<head>
<meta charset="utf-8">
<base href="<?=$config_url?>/"  />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="<?=$keyword?>" />
<meta name="description" content="<?=$description?>" />
<meta name="author" content="" />
<meta name="copyright" content="" />
<meta name="robots" content="noodp,index,follow" />
<meta name="DC.title" content="" />
<meta name="ICBM" content="" />
<meta name='revisit-after' content='1 days' />
    <link rel="icon" type="image/png" href="images/logo.png"/>   
<?=$global_setting['meta_top']?>
<?=$global_setting['google_analytics']?>
<?php 
$img = $config_url."/"._upload_hinhanh_l.$global_setting['share_image'];
if(isset($product_detail)){
$img  = ($product_detail) ?  $config_url."/"._upload_sanpham_l.$product_detail['thumb'] : $img ;
}
if(isset($tintuc_detail)){
$img = ($tintuc_detail) ? $config_url."/"._upload_news_l.$tintuc_detail['thumb'] : $img ;
}
?>
<meta property="article:author" content="<?=getCurrentPageUrl()?>" />
<meta property="og:image" content="<?=$img?>" />
<meta property="og:url" content="<?=getCurrentPageUrl() ?>" />
<meta property="og:description" content="<?=($description) ? $description : $title_bar.$row_title['ten']  ?>" />
<meta property="og:site_name" content="<?=$title?>" />
<title><?=$title_bar?>Derhao Textile (Viet Nam). Co., Ltd</title> <!--<?=$title?> -->
<script>var base_url = '<?=$config_url?>';  </script>
<script src="assets/js/jquery-1.11.2.min.js" type="text/javascript" ></script>
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
<script src="assets/plugins/wow/dist/wow.min.js" type="text/javascript" ></script>
<script src="assets/plugins/notify/js/jquery.notify.min.js" type="text/javascript" ></script>
<script src="assets/js/jquery.stellar.js" type="text/javascript"></script>
<script>
jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
</script>
<script type="text/javascript" src="assets/plugins/fancybox-v3/v2/jquery.fancybox.js"></script>
<link href="assets/css/normalize.css" type="text/css" rel="stylesheet" />
<link href="assets/bootstrap/css/boostrap.compiler.min.css" type="text/css" rel="stylesheet" />
<link href="assets/plugins/fancybox-v3/v2/jquery.fancybox.css" type="text/css" rel="stylesheet" />
<script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>
<link href="assets/plugins/owlcarousel/assets/owl.carousel.css" type="text/css" rel="stylesheet" />
<link href="assets/plugins/wow/css/libs/animate.css" type="text/css" rel="stylesheet" />
<link href="assets/plugins/notify/css/jquery.notify.css" type="text/css" rel="stylesheet" />
<link href="assets/css/product.css" type="text/css" rel="stylesheet" />
<link href="assets/css/product_detail.css" type="text/css" rel="stylesheet" />
<link href="assets/fonts/font-awesome-4.5.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
</head>
<?php if($maintenance){echo $maintenance;die;}?>
<body class="status js-status <?=$template?>"  itemscope itemtype=http://schema.org/WebPage> 
	<div class="visible-xs visible-sm">
    <?php include _template."layout/responsive-menu.php" ?>
            </div>	
			<?php include _template."layout/header.php";?>		
			<div id="xmen">	
	
	<div class="clearfix"></div>
	<?php 
	$ar_ = array("where-to-buys");
	if(!in_array(@$_GET['com'],$ar_)){
		
		include _template."layout/slider.php"; 
	}
?>
		
		
	
<div id="page-wrapper">		

		

	<div id="page">
		
			<div id="content-center" class="">									
				<?php 
					if($template!="index"){
					
					}
					include _template.$template."_tpl.php";
					if($template!="index"){
					
					}
					?>
			</div>			
		
		<div class="clearfix"></div>				
		
	</div><!-- #page -->
	<div class="clearfix"></div>	
	</div><!--end page-wrapper-->
	
	
	<div class="clearfix"></div>
	<?php include _template."layout/footer.php";?>
	
	
	</div>
	<?php include _template."layout/footer_tools.php";?>

<script src="assets/js/less-1.7.3.min.js" type="text/javascript" ></script>
<script src="assets/js/script.js" type="text/javascript" ></script>
<?=$global_setting['meta_bottom']?>
<script>
 new WOW().init();
 $().ready(function(){
	 //$(window).trigger("scrool");

	 })
	$(window).stellar({
		horizontalScrolling: true,
		verticalScrolling:  true, 
		hideDistantElements: false
	});	
 </script>
</body>
</html>