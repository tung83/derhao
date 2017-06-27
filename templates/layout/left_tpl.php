<link href="assets/css/left.css" rel="stylesheet" type="text/css" />
<section>
		
        <div class="box-left">
			<div class="right-title">
				<h2 style="">Dịch vụ cưới</h2>
			</div>
           
            <div class="content product no-bd">
				<div class="inner">
				<ul>
              <?php 
				$d->query("select tenkhongdau,id,ten_$lang from #_content where hienthi = 1 and type='service' order by stt desc");
				$alias = array();
				foreach($d->result_array() as $k=>$v){
							echo '<li><a href="dich-vu-cuoi/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>'; 
						
							echo '</li>';
						}
						
				?>
				</ul>
				</div>
            </div>
        </div>
    </section>
	<script>
		$().ready(function(){
			$(".content.product li").hover(function(){
				$l = $(this).find("ul");
				$l.stop().slideDown();
			},function(){
				$l = $(this).find("ul");
				$l.stop().slideUp();
			})
		})
	
	</script>
<div class='space'></div>
<section>
		
        <div class="box-left">
			<div class="right-title">
				<h2 style="">Bảng giá</h2>
			</div>
           
            <div class="content product no-bd">
				<div class="inner">
				<ul>
              <?php 
				$d->query("select tenkhongdau,id,ten_$lang from #_content where hienthi = 1 and type='price' order by stt desc");
				$alias = array();
				foreach($d->result_array() as $k=>$v){
							echo '<li><a href="bang-gia/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>'; 
						
							echo '</li>';
						}
						
				?>
				</ul>
				</div>
            </div>
        </div>
    </section>
<div class='space'></div>
<section>

        <div class="box-left">
			
            <div class="content album">
				<div class="rel">
					<div class="vitual-nav">
						<div class="prev" style=""><i class="glyphicon glyphicon-menu-left"></i></div>
						<div class="next" style=""><i class="glyphicon glyphicon-menu-right"></i></div>
					</div>
					<?php 
						$d->query("select ten_$lang,id,tenkhongdau,thumb from #_content where type='album' and noibat = 1 ");
						echo '<ul class="bx-album">';
							foreach($d->result_array() as $k=>$v){
								echo '<li>';
									echo '<div class="wrap">';
										echo '<img src="timthumb.php?src='.$config_url."/"._upload_news_l.$v['thumb'].'&w=350&h=400" alt="'.$v['ten_'.$lang].'" />';
										echo '<div class="rb">HOT</div>';
										echo '<div class="name">';
											echo '<h2><a href="thu-vien-anh/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></h2>';
										
										echo '</div>';
									echo '</div>';
								
								echo '</li>';
							}
						
						echo '</ul>';
						
					
					?>
				</div>
            </div>
        </div>
    </section>
	<script>
		$().ready(function(){
			var sliderx = $(".bx-album").bxSlider({pager:0,
			onSlideBefore:function(){
				
			},
			onSlideAfter:function(){
				$(".bx-album .rb").animate({top:0,opacity:1});
				$(".bx-album .name").animate({bottom:0,opacity:1});
			},
			onSliderLoad:function(){
			
				$(".content.album .prev").click(function(){
					$(".bx-album .rb").stop().animate({top:-30,opacity:0},500);
					$(".bx-album .name").stop().animate({bottom:-30,opacity:0},500);
					setTimeout(function(){
						sliderx.goToPrevSlide();
					},500);
					
				})
				$(".content.album .next").click(function(){
					$(".bx-album .rb").stop().animate({top:-30,opacity:0},500);
					$(".bx-album .name").stop().animate({bottom:-30,opacity:0},500);
					setTimeout(function(){
						sliderx.goToNextSlide();
					},500);
					
					
				})
				setInterval(function(){
					$(".content.album .next").click();
				},6000);
			}
			});
			
		})
	
	</script>

<div class='space'></div>

	
	
