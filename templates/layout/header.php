<?php
$d->reset();
$d->query("select * from #_hotline ");
$rs_hotline = $d->fetch_array();
$sql = "select * from #_lienhe";
$d->query($sql);
$rs_lienhe = $d->fetch_array();
$sql = "select * from #_photo where com='banner_top' and mota = '" . $lang . "'";
$d->query($sql);
$rs_banner = $d->fetch_array();

	
?>
<header>
	<div class="top-header">
		<div class="container">	
			<div class="row">
				<div class="col-xs-12 col-md-6 col-sm-5">
					<div class="top-link-fb">
						<a href="<?=$rs_hotline['facebook']?>" target="_blank"><i class="fa fa-facebook-f"></i> | <?=_welcome_to_our_facebook?></a>
					</div>
				</div>	
				
				<div class="col-xs-12 col-md-3 col-sm-3 login">
					<?php
						if($_SESSION['member_log']!=''){
					 ?>
					  <div class="member pull-right">&nbsp;&nbsp;
					  Chào! <span style="color:#1100b8"><a href="thanh-vien/thay-doi-thong-tin.html"><?=$_SESSION["member_log"]['fullname']?></a></span>
						|&nbsp;&nbsp;<a style="color:#fff" href="thanh-vien/logout.html">Đăng xuất</a>
					  </div>
					 
					   <?php }?>
				</div>
				<div class="col-xs-12 col-md-3 col-sm-3 hotline-block">
				<?php 
						$ob_lang = ($lang=="vi") ? 'en' : 'vi';
					?>
					<div class="holtline"><span class=" <?=($global_setting['visible_hotline']) ? '' : 'hide'?>">Hotline: <a href="tel:<?=$rs_hotline['hotline_'.$lang]?>"><?=$rs_hotline['hotline_'.$lang]?></a></span> <span><?=_language?>&nbsp;<a href="index.php?com=ngonngu&lang=<?=$ob_lang?>"><?=strtoupper($ob_lang)?></a></span></div>
					
					
					<div class="search-bar hidden-xs hidden-sm">
						<form method="get" class="search-box">
							<input type="text" name="keyword" required />
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<script>
						$().ready(function(){
							$(".search-bar button").click(function(){
								$input = $(this).parent().find("input");
								if($input.width() > 50){
									if($input.val()){
											
										$("form.search-box").trigger("submit");
									}else{
										alert("<?=_please_enter_keyword?>");
										$input.focus();
									}
									
										
								}else{ 
									$input.animate({width:"228px"});
								}
								return false;
							})
						})	
					</script>
				</div>
				<div class="clearfix"></div>
				
			</div>
		</div>
	</div>
    <div class="container  rel">
        <div class='row'>
			<div class="col-xs-12 col-md-5">
				<div class="banner wow fadeInUp" data-wow-offset="0" data-wow-duration="1" data-wow-delay="0.3s">
			<?php
				$photo = _upload_hinhanh_l . $rs_banner['photo'];
			?>
                    <a href="" title="Home"><img class="header img-responsive "  src="<?= _upload_hinhanh_l . $rs_banner['photo'] ?>" /></a>

                </div>
			</div>	
			<div class="clearfix visible-sm visible-xs"></div>
			<div class="visible-sm visible-xs clearfix">
			
			<div class="search-bar-mini">
						<form method="get" class="search-box2">
							<input type="text" name="keyword" required />
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
			
			
			
			</div>
			<div class="hidden-xs col-md-7">
				<?php include _template . "layout/menu.php" ?>
			</div>
			
                <div class="clearfix"></div>
        </div>
    </div>
</header>
<script>
$().ready(function(){
$("form.search-box,form.search-box2").submit(function(){
	$val = $(this).find("input").val();
	window.location.href="search.html/keyword="+$val;
	return false;
	
})
})

</script>