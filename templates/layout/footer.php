<?php	

	$d->reset();
	$sql_contact = "select * from #_hotline ";
	$d->query($sql_contact);
	$rs_hotline = $d->fetch_array();
	
	
	$d->reset();
	$d->query("select * from #_footer "); 
	$footer = $d->fetch_array();	
	
	$d->reset();
	$d->query("select * from #_background where id = 1");
	$r = $d->fetch_array();

?>


<div class="top-line-footer">
	<img src="assets/img/line1.png" />

</div>


<footer>
		<?php include _template."layout/logo.php";?>
	<div class="container top-footer">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-xs-12">
		<div class="row">
			
					<div class="col-xs-12 col-md-4">
						<div class="title"><h3><?=_contact_us?></h3></div>
						<div class="clearfix"></div>
						<div class="content contact">
							<?php /*<div class="c-item">
								<div class="left-icon">
									<i class="fa fa-map-marker"></i>
								</div>
								<div class="right-content">
									<?=$rs_hotline['diachi_'.$lang]?>
								</div>
							</div>
							<div class="c-item">
								<div class="left-icon">
									<i class="fa fa-phone"></i>
								</div>
								<div class="right-content">
									<div>Tel: <?=$rs_hotline['dienthoai_'.$lang]?></div>
									<div>Fax: <?=$rs_hotline['fax_'.$lang]?></div>
									
								</div>
							</div>
							<div class="c-item">
								<div class="left-icon">
									<i class="fa fa-envelope"></i>
								</div>
								<div class="right-content">
								<?=$rs_hotline['email_'.$lang]?>
									
								</div>
							</div>
							*/?>
							<?=$footer['noidung_'.$lang]?>
							
						</div>	
						<div class="follow">
							<div class="title"><h3><?=_follow_us?></h3></div>
							<div class="content">
								<div class="social">
										<?php 
									$d->query("select * from #_social where hienthi = 1 order by stt desc");
									foreach($d->result_array() as $k=>$v){
										echo '<a href="'.$v['link'].'" data-toggle="tooltip" target="_blank" onMouseOver="this.style.color=\''.$v['color'].'\'"  onMouseOut="this.style.color=\''.'#fff'.'\'" title="'.$v['ten'].'"><i class="fa fa-'.$v['small_image'].'" alt="'.$v['ten'].'"></i></a>';
									}
								
								?>
									</div>
							
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-md-4 hidden-xs">
						<div class="title"><h3><?=_about?></h3></div>
						<div class="clearfix"></div>
						<div class="content about">
							<div class="row">
								<div class="col-xs-10">
							<?php 
							
								$d->query("select mota_$lang from #_baiviet where id = 2");
								$r = $d->fetch_array();
								echo $r["mota_$lang"];
								
							
							
							?>
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="exhibition">
								<div class="text"><?=_exhibition_info?></div>
								<div class="row">
									<div class="col-md-10 col-xs-12">
									<?php 
										$d->query("select photo,id,ten_$lang,tenkhongdau from #_content where type='trienlam' and noibat = 1 and hienthi = 1 order by stt desc limit 6");
										foreach($d->result_array() as $k=>$v){
												echo '<div class="col-xs-4 "><div class="item-exhibition row anim-05">';
													echo '<a href="'.changeTitle(_exhibition).'/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">';
														echo '<img class="img-responsive" src="thumb/300x150/1/'._upload_news_l.$v['photo'].'" alt="'.$v['ten_'.$lang].'" />';
													echo '</a>';
												
												echo '</div></div>';
												
										}
									
									?>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							
							
						</div>	
					</div>
					<div class="visible-xs clearfix"></div>
					<div class="col-xs-12 col-md-4" id="form-rr">
						<div class="title"><h3><?=_register?></h3></div>
						<div class="clearfix"></div>
						<div class="content email">
							<span><?=_sign_up?></span>
							<div class="clearfix"></div>
							<div class="form-register">
								<form id="form-sub">
									<input type="email" required name="email" />
									<button><?=_sign_up_btn?></button>
								</form>
								<script>
										$("#form-sub").submit(function(){
											$.post("ajax/newsletter.html",{email:$("#form-sub input[type=email]").val()},function(){
												alert("Đăng ký thành công");
												location.reload();
											})
											return false;
											
										})
										</script>
							</div>
							<div class="clearfix"></div>
							
							<div class="award">
							<div class="row">
							<div class="">
								<div class="col-md-12 col-lg-12 col-xs-10 col-xs-offset-1 col-md-offset-0 col-lg-offset-0">
								<ul>
								
								<?php 
									$d->query("select photo,link,ten from #_slider where type='award' and hienthi = 1 order by stt desc");
									foreach($d->result_array() as $k=>$v){
										echo '<li><div><a href="'.$v['link'].'" title="'.$v['ten'].'" target="_blank"><img class="img-responsive" src="thumb/200x200/3/'._upload_hinhanh_l.$v['photo'].'" alt="'.$v['ten'].'" /></a></div></li>';
									}
								
								?>
								</ul>
								<script>
								$().ready(function(){
								$('.award ul').owlCarousel({
								loop:true,
								margin:30,
								items:3,
								dots:false,
								autoplay:true,
								
								})
								})
								</script>
							</div>
							</div>
							</div>
							</div>
						</div>
												
					</div>
					
					<div class="visible-xs clearfix"></div>
				
				</div>
				<div class="clearfix"></div>
				
			</div>
			
			
		
		
		</div>
		
		<div class="copyright">
		<div class="wrap-copyright row">
			
				<div class="col-xs-12 col-md-6 pull-right col-sm-6">
					<ul>
						<li><a href="" title="<?=_home?>"><?=_home?></a></li>
						<li><a href="about.html" title="<?=_about?>"><?=_about?></a></li>
						<li><a href="fabric.html" title="<?=_fabric?>"><?=_fabric?></a></li>
						<li><a href="product.html" title="<?=_product?>"><?=_product?></a></li>
						<li><a href="promotion.html" title="<?=_instock?>"><?=_instock?></a></li>
						<li><a href="where-to-buy.html" title="<?=_wheretobuy?>"><?=_wheretobuy?></a></li>
						<li><a href="contact.html" title="<?=_contact?>"><?=_contact?></a></li>
						
					</ul>
				
				</div>
				<div class="col-xs-12 col-md-6 col-sm-6">
					Copyright &copy; 2015 / Derhao Textile (Viet Nam). Co., Ltd
				</div>	
			</div>
		
		
	</div>
		
		
	</div>

		
	
	</footer>	