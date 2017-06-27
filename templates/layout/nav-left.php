<div class="hidden-xs" id="nav-left">
<div class="">
	<div class="logo">
		<a href=""><img src="assets/img/logo.png" class="img-responsive"></a>
	</div>
	<div id="main-nav">
	<div id="nav-footer">
		
		
		
		<div class="search-form">
			<form rule="form" method="get" id="form-seach-oz">
				<input type="text" required placeholder="<?=_tukhoa?>"/>
				<button type="submit"><img src="assets/img/search-icon.png" rel="search" /></button>
				<div class="special-search">
					<div>
						<label><?=_khuvuc?></label>
						<select class="form-control" name="position">
							<?php 
								foreach(listLocation() as $k=>$v){
									echo "<option value='".$k."'>".$v."</option>";
								}
							
							?>
						
						</select>
					
					</div>
					
					<div>
						
					
					</div>
				
				</div>
			</form>
		
		</div>
	</div><!-- end nav-footer -->
		<nav>
			<ul>
				<li><a href="index.html" title="Trang chủ">TRANG CHỦ</a></li>
				<li><a href="gioi-thieu.html" title="Giới thiệu">GIỚI THIỆU</a></li>
				<li><a  href="tiec-cuoi.html" title="Tiệc cưới">TIỆC CƯỚI</a></li>
				
				<li><a  href="hoi-nghi-va-su-kien.html" title="Hội nghị và sự kiện">HỘI NGHỊ VÀ SỰ KIỆN</a>
				</li>
				<li><a  href="ao-cuoi.html" title="Áo cưới">ÁO CƯỚI</a>
				
				<?php
						$d->reset();
						$d->query("select * from #_aocuoi_danhmuc where hienthi=1 order by stt desc");
						$rs_profile_danhmuc = $d->result_array();
						if(count($rs_profile_danhmuc) > 0){
							echo '<ul>';
								foreach($rs_profile_danhmuc as $k=>$v){
									echo '<li><a href="ao-cuoi/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>';
										$d->reset();
										$d->query("select * from #_aocuoi_list where hienthi = 1 and id_danhmuc = ".$v['id']." order by stt desc");
										$rs_profile_list = $d->result_array();
										if(count($rs_profile_list) > 0){
											echo '<ul>';
												foreach($rs_profile_list as $k2=>$v2){
													echo '<li class="default"><a href="ao-cuoi/'.$v['tenkhongdau'].'/'.$v2['id'].'/'.$v2['tenkhongdau'].'.html" title="'.$v2['ten_'.$lang].'">'.$v2['ten_'.$lang].'</a></li>';
												}
											echo '</ul>';
												   
										}
									echo '</li>';
								
								
								}
							
							
							echo '</ul>';
						
						
						}
					
					?>
				
				
				
				
				</li>
				<li><a href="khach-san.html" title="Khách sạn">KHÁCH SẠN</a>
				
				<?php
						$d->reset();
						$d->query("select * from #_product_danhmuc where hienthi=1 order by stt desc");
						$rs_profile_danhmuc = $d->result_array();
						if(count($rs_profile_danhmuc) > 0){
							echo '<ul>';
								foreach($rs_profile_danhmuc as $k=>$v){
									echo '<li><a href="khach-san/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>';
										
									echo '</li>';
								
								
								}
							
							
							echo '</ul>';
						
						
						}
					
					?>
				</li>
				<li><a href="album.html" title="Album">ALBUM</a>
					<?php
						$d->reset();
						$d->query("select * from #_album_danhmuc where hienthi=1 order by stt desc");
						$rs_profile_danhmuc = $d->result_array();
						if(count($rs_profile_danhmuc) > 0){
							echo '<ul>';
								foreach($rs_profile_danhmuc as $k=>$v){
									echo '<li><a href="album/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>';
										
									echo '</li>';
								
								
								}
							
							
							echo '</ul>';
						
						
						}
					
					?>
				
				</li>
				
				<li><a href="lien-he.html" title="Giới thiệu">LIÊN HỆ</a></li>
			
			</ul>
		
		</nav>	
	</div><!-- end main-nav -->
	
	</div>
</div>
<script>
	$().ready(function(){
		$("#main-nav ul li").hover(function(){
			$(this).find("ul").first().show();
		
		},function(){
			$(this).find("ul").first().hide();
		
		})
		$("#form-seach-oz").submit(function(){
			
			$k = $(this).find("input").val();
			window.location.href=base_url+"/search.html/keyword="+$k;
			return false;
		})
	})

</script>