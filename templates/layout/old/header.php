<?php
	$d->reset();
	$sql_banner_giua = "select photo from #_photo where com='banner_top' order by id desc";
	$d->query($sql_banner_giua);
	$row_banner_giua = $d->result_array();	
	
	$d->reset();
	$sql_hotline="select diachi,dienthoai,email,ten,fax from #_hotline limit 0,1";
	$d->query($sql_hotline);
	$result_hotline=$d->fetch_array();
	
	
	$is_add = 0;
	$d->query("select * from #_statistics where st_ip='".@$_SERVER['REMOTE_ADDR']."' and st_week = '".date("W")."' and st_day = '".date("d")."' order by st_time desc");
	if($d->num_rows() == 0){
			$is_add = 1;
	}else{
		$rs = $d->fetch_array();
		if($rs['st_time']+300 < time()){
			$is_add = 1;
		}
	}
	if($is_add){
		$sql = "insert into #_statistics(st_time,st_week,st_month,st_day,st_year,st_ip,st_url) value(".time().",".date("W").",".date("m").",".date("d").",".date("Y").",'".$_SERVER['REMOTE_ADDR']."','".current_url()."')";
		$d->query($sql);
	}	

?>
<div class="wrap-header">
			<div class="home">
				<a href="index.html" title="Home"><img src="assets/css/img/home-icon.png" alt="home" /></a>
			</div>
			<div id="menu"> 	
			<ul>
				<li ><a class="<?php if((!isset($_REQUEST['com'])) or ($_REQUEST['com']==NULL) or ($_REQUEST['com']=='about') or $_REQUEST['com']=='index') echo 'active'; ?>"  href="about.html"><?=_about_?></a></li>
				<li><a class="<?php if($_REQUEST['com'] == 'service') echo 'active'; ?>" href="service.html"><?=_service_?></a></li>
				<li><a class="<?php if($_REQUEST['com'] == 'wedding') echo 'active'; ?>" href="wedding.html"><?=_wedding_?></a></li>
				<li><a class="<?php if($_REQUEST['com'] == 'fashion') echo 'active'; ?>" href="fashion.html"><?=_fashion_?></a></li>
				<li><a class="<?php if($_REQUEST['com'] == 'advirtising') echo 'active'; ?>" href="advirtising.html"><?=_advirtising_?></a></li>
				 <li><a class="<?php if($_REQUEST['com'] == 'another-album') echo 'active'; ?>" href="another-album.html"><?=_another_album_?></a></li>
				<li><a class="<?php if($_REQUEST['com'] == 'promotion') echo 'active'; ?>" href="promotion.html"><?=_promotion_?></a></li>
				<li><a class="" href="forum.html"><?=_4rum_?></a></li>
				<li><a class="<?php if($_REQUEST['com'] == 'contact') echo 'active'; ?>" href="contact.html"><?=_contact_us_?></a></li>
			</ul>
			<div class="clear"></div>  
			</div><!---END #menu-->
			
			<div class="lang-bar">
			<a href="index.php?com=ngonngu&amp;lang=en" title="English"><img src="images/en.png" alt="English"></a>
			<a href="index.php?com=ngonngu&amp;lang=vi" title="Tiếng Việt"><img src="images/vi.png" alt="Tiếng Việt"></a>
			</div>
			<div class="clear"></div>
			<div class="logo-anim">
		<a href="" ><img src="images/logo.png" /></a>
	</div>
		</div><!-- end wrap-header -->


