<div id="right-nav-navigation">
<?php 
	$show_category = 0;
	
	$nav_link = array();
	$nav_link['slug'] = $_GET['com'];
	$nav_link['type'] = $type;
	if(in_array($_GET['com'],$cate_arr)){
		$show_category=1;
	
	}

?>

<section>
<div class="title-global fadeInDown wow" data-wow-offset="50" data-wow-duration="3" data-wow-delay="0.2s"><h2>Danh mục sản phẩm</h2><div class="clearfix"></div></div>
<div class="clearfix"></div>
<div class="content">
	<?php 
		$d->query("select ten_$lang,tenkhongdau,id from #_product_danhmuc where hienthi = 1 order by stt desc");
		if($d->num_rows()){
			echo '<ul>';
				foreach($d->result_array() as $k=>$v){
					echo '<li><a href="san-pham/'.$v['tenkhongdau'].'-'.$v['id'].'/" title="'.$v['ten_'.$lang].'"><i class="dot"></i>&nbsp;'.trim($v['ten_'.$lang]).'</a>';
						$d->query("select ten_$lang,tenkhongdau,id from #_product_list where id_danhmuc= '".$v['id']."' and hienthi = 1 order by stt desc");
						if($d->num_rows()){
							echo '<ul>';
								foreach($d->result_array() as $k2=>$v2){
									echo '<li><a href="san-pham/'.$v['tenkhongdau'].'/'.$v2['tenkhongdau'].'/'.$v2['id'].'/" title="'.$v2['ten_'.$lang].'"><i class="line"></i>&nbsp;'.$v2['ten_'.$lang].'</a></li>';
								}
							
							echo '</ul>';
							
							
						}
					
					echo '</li>';
				}
			
			echo '</ul>';
		}
	
	?>
</div>


</section>


	<section>
<div class="title-global InDown wow" data-wow-offset="50" data-wow-duration="3" data-wow-delay="0"><h2>Tư vấn</h2><div class="clearfix"></div></div>
<div class="clearfix"></div>
<div class="content news">
	<?php 
		$d->query("select ten_$lang,tenkhongdau,id,mota_$lang,ngaytao,thumb from #_content where type='tuvan' and hienthi = 1 and noibat = 1 and is_index = 0 order by stt desc limit 5");
		if($d->num_rows()){
			echo '<ul>';
				foreach($d->result_array() as $k=>$v){
					echo '<li class="InDown wow" data-wow-offset="50" data-wow-duration="3" data-wow-delay="'.(0.2*$k).'s">';
						echo '<div class="row-8">';
							echo '<div class="col-xs-5 col-8">';
								echo '<a href="tu-van/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">';
									echo '<img src="'._upload_news_l.$v['thumb'].'" class="img-responsive" alt="'.$v['tenkhongdau'].'" />';
								echo '</a>';
							echo '</div>';
						
							echo '<div class="col-xs-7 col-8">';
								echo '<div class="date">'.date("d/m/Y",$v['ngaytao']).'</div>';
								echo '<div class="name"><h3><a href="tu-van/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">';
									echo $v['ten_'.$lang];
								echo '</a></h3></div>';
								echo '<div class="desc">';
									echo cutString(strip_tags($v['mota_'.$lang]),100);
								echo '</div>';
							echo '</div>';
							echo '<div class="clearfix"></div>';
							
						echo '</div>';
					
					
					echo '</li>';
				}
			
			echo '</ul>';
		}
	
	?>
</div>
</section>

<section>
<div class="title-global InDown wow" data-wow-offset="50" data-wow-duration="3" data-wow-delay="0"><h2>Chính sách</h2><div class="clearfix"></div></div>
<div class="clearfix"></div>
<div class="content news">
	<?php 
		$d->query("select ten_$lang,tenkhongdau,id,mota_$lang,ngaytao,thumb from #_content where type='tuvan' and hienthi = 1 and noibat = 1 and is_index = 0 order by stt desc limit 5");
		if($d->num_rows()){
			echo '<ul>';
				foreach($d->result_array() as $k=>$v){
					echo '<li class="InDown wow" data-wow-offset="50" data-wow-duration="3" data-wow-delay="'.(0.2*$k).'s">';
						echo '<div class="row-8">';
							echo '<div class="col-xs-5 col-8">';
								echo '<a href="chinh-sach/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">';
									echo '<img src="'._upload_news_l.$v['thumb'].'" class="img-responsive" alt="'.$v['tenkhongdau'].'" />';
								echo '</a>';
							echo '</div>';
						
							echo '<div class="col-xs-7 col-8">';
								echo '<div class="date">'.date("d/m/Y",$v['ngaytao']).'</div>';
								echo '<div class="name"><h3><a href="chinh-sach/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">';
									echo $v['ten_'.$lang];
								echo '</a></h3></div>';
								echo '<div class="desc">';
									echo cutString(strip_tags($v['mota_'.$lang]),100);
								echo '</div>';
							echo '</div>';
							echo '<div class="clearfix"></div>';
							
						echo '</div>';
					
					
					echo '</li>';
				}
			
			echo '</ul>';
		}
	
	?>
</div>
</section>


	
	<section>
<div class="title-global fadeInDown wow" data-wow-offset="50" data-wow-duration="3" data-wow-delay="0.2s"><h2><?=_news?></h2><div class="clearfix"></div></div>
<div class="clearfix"></div>
<div class="content news">
	<?php 
		$d->query("select ten_$lang,tenkhongdau,id,mota_$lang,ngaytao,thumb from #_content where type='news' and hienthi = 1 and noibat = 1 order by stt desc limit 5");
		if($d->num_rows()){
			echo '<ul>';
				foreach($d->result_array() as $k=>$v){
					echo '<li>';
						echo '<div class="row-8 InDown wow" data-wow-offset="50" data-wow-duration="3" data-wow-delay="'.(0.2*$k).'s">';
							echo '<div class="col-xs-5 col-8">';
								echo '<a href="tin-tuc/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">';
									echo '<img src="'._upload_news_l.$v['thumb'].'" class="img-responsive" alt="'.$v['tenkhongdau'].'" />';
								echo '</a>';
							echo '</div>';
						
							echo '<div class="col-xs-7 col-8">';
								echo '<div class="date">'.date("d/m/Y",$v['ngaytao']).'</div>';
								echo '<div class="name"><h3><a href="tin-tuc/'.$v['tenkhongdau'].'-'.$v['id'].'.html" title="'.$v['ten_'.$lang].'">';
									echo $v['ten_'.$lang];
								echo '</a></h3></div>';
								echo '<div class="desc">';
									echo cutString(strip_tags($v['mota_'.$lang]),100);
								echo '</div>';
							echo '</div>';
							echo '<div class="clearfix"></div>';
							
						echo '</div>';
					
					
					echo '</li>';
				}
			
			echo '</ul>';
		}
	
	?>
</div>
</section>
</div>