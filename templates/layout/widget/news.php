<link href="assets/css/widget.css" type="text/css" rel="stylesheet" />
<section>
	<div id="news-widget">
		<div class="container">
			<div class="row">
				<div class="inner-box-news-widget">
				<div class="col-xs-12 col-md-8">
					<div class="box-news">
						<div class="widget-title">
							<h3>Ý nghĩa của các loại nước hoa</h3>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
						<div class="content">
						<?php 
							$d->query("select ten_$lang,id,mota_$lang,photo,tenkhongdau from #_content where type='poison' and hienthi = 1 order by stt desc limit 4");
							$news = $d->result_array();
							$r = $news[0];
						
						
						?>
							<div class="row">
								<div class="col-md-5 col-xs-12">
									<div class="big-news">
									<a href="y-nghia-cac-loai-nuoc-hoa/<?=$r['tenkhongdau']?>-<?=$r['id']?>.html" title="<?=$r['ten_'.$lang]?>">
										<img class="img-responsive" src="thumb/310x190/1/<?=_upload_news_l.$r['photo']?>" title="<?=$r['ten_'.$lang]?>"/>
									</a>
									<div class="clearfix"></div>
									<div class="name">
										<h2>
											<a href="y-nghia-cac-loai-nuoc-hoa/<?=$r['tenkhongdau']?>-<?=$r['id']?>.html" title="<?=$r['ten_'.$lang]?>">
												<?=$r['ten_'.$lang]?>
											</a>
										</h2>
									</div>
									<div class="clearfix"></div>
									<div class="desc">
										<?=strip_tags($r['mota_'.$lang])?>
									</div>
									</div>
								</div><!-- end big -->
								<div class="col-md-7 col-xs-12">
									<div class="small-news">
										<ul>
										<?php
											foreach($news as $k=>$v){
												if($k){
											?>
												<li>
													<div class="row-8">
														<div class="col-xs-5 col-md-3 col-8">
															<a href="y-nghia-cac-loai-nuoc-hoa/<?=$r['tenkhongdau']?>-<?=$r['id']?>.html" title="<?=$r['ten_'.$lang]?>">
																<img class="img-responsive" src="thumb/135x90/1/<?=_upload_news_l.$v['photo']?>" title="<?=$r['ten_'.$lang]?>"/>
															</a>
														</div>
														<div class="col-xs-7 col-md-9 col-8 desc">
															<h3><a href="y-nghia-cac-loai-nuoc-hoa/<?=$r['tenkhongdau']?>-<?=$r['id']?>.html" title="<?=$r['ten_'.$lang]?>">
																<?=$v['ten_'.$lang]?>
															</a></h3>
															<div class="clearfix"></div>
															<span>
																<?=cutString(strip_tags($v['mota_'.$lang]),130)?>
															</span>
														</div>
														<div class="clearfix"></div>
													</div>
												
												</li>

											<?php	
												}											
											}
										?>
										</ul>
									</div>
								</div><!-- end small-news -->
							
							</div>
						</div>
					</div><!-- end box-news -->
				</div><!-- end col-md-7 -->
				
				<div class="col-xs-12 col-md-4">
					<div class="oz-news">
							<div class="widget-title">
							<h3>Tin tức</h3>
							<div class="clearfix"></div>
						</div>
					<ul>
					<?php 
						$d->query("select ten_$lang,id,photo,tenkhongdau from #_content where type='news' and hienthi = 1 and noibat = 1 order by stt desc limit 5");
						foreach($d->result_array() as $k=>$v){
							echo '<li><img src="thumb/345x300/1/'._upload_news_l.$v['photo'].'" title="'.$v['ten_'.$lang].'" />';
							echo '<div class="name"><h4><a href="tin-tuc/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></h4></div>';
							
							
						}
					
					?>
					</ul>
					</div>
				</div>
				<div class="clearfix"></div>
				</div><!-- end inner-box-news-widget -->
			</div>
		</div>
		
	
	</div>
</section>
<script>
	$(".oz-news ul").owlCarousel({items:1,loop:true,autoplay:true});
</script>