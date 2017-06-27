<?php if ($_REQUEST['act']=='edit_danhmuc') { ?> <h3>Sửa danh mục cấp 1</h3> <?php }else{ ?><h3>Thêm danh mục cấp 1</h3><?php } ?>
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save_danhmuc" enctype="multipart/form-data" class="form-horizontal " role="form" > 
	
  <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man_danhmuc'" class="btn btn-warning" />
	<p></p>	
  <div class="col-xs-10">
  <div class="row">
  
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">
	
	 <div class="col-xs-10 align-left">
	 <div class="col-xs-6 align-left">
	<!--  <div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-4 control-label">Hình ảnh</label>
				   <div class="input-group">
				 <input type="file" name="file" />
				  
				</div>
				<?php if(isset($_GET['id'])){?>
				<a class="fancybox"  href="<?=_upload_tintuc.@$item['photo']?>" ><img  id="main-image" src="<?=_upload_tintuc.@$item['photo']?>" class="col-xs-4" /></a>
				<?php } ?>
			 </div>-->
	 </div> 
	 <div class="col-xs-6 align-left">
	 
		<div class="col-xs-12">
			
			 <div class="checkbox">
				<label>
				  <input type="checkbox"  name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>> Hiển thị
				</label>
			  </div>
			  <div class="checkbox">
				<label>
				  <input type="checkbox"  name="noibat" <?=(!isset($item['noibat']) || $item['noibat']==1)?'checked="checked"':''?>> Nỗi bật
				</label>
			  </div>
			  <div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 align-left control-label">Số thứ tự</label>
					<div class="col-sm-8">
					  <input type="text" name="stt"  value="<?=(@$stt) ? $stt : @$item['stt']?>" class="form-control w-120 " id="inputEmail3">
					</div>
				 </div>
			</div>	 
			</div>
		 </div>
	 </div>
	 </div>
	 <div class="clearfix"></div>

	<ul class="nav nav-tabs">
	<?php
		foreach($config['lang'] as $k=>$v){
			$act = '';
			if($k==0){
				$act = "active";
			}
			echo '<li class="'.$act.'"><a href="#'.$v.'" data-toggle="tab"><strong>'.$config['AllLang'][$v].'</strong></a></li>';
		}
	?>
	<li class=""><a href="#seo" data-toggle="tab"><strong>SEO</strong></a></li>
	<li class=""><a href="#advs" data-toggle="tab"><strong>Logo đối tác</strong></a></li>
	</ul>
	
	
	<div class="tab-content">
	
	<?php
		foreach($config['lang'] as $k=>$v){?>
			
		<?php $act = ''; if($k==0){ $act = 'active'; }?>
		
		 <div class="tab-pane  <?=$act?>" id="<?=$v?>" >
	
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
			<div class="col-sm-10">
			  <input type="text" name="ten_<?=$v?>" value="<?=@$item['ten_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>	
		<!--<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
			<div class="col-sm-10">
			  <textarea  name="mota_<?=$v?>" class="form-control" id="inputEmail3" ><?=@$item['mota_'.$v]?></textarea>
			</div>
		</div>
		  -->
		<div class="clearfix"></div>
		<div class="form-group">
			<p><label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label></p>
			<div class="clearfix"></div>
			<p></p>
			<div class="col-sm-12">
			  <textarea  name="noidung_<?=$v?>" class="form-control editor" id="nd_<?=$v?>" ><?=@$item['noidung_'.$v]?></textarea>
			</div>
		</div>
		
		<div class="clearfix"></div>
		 </div>
		
	<?php } ?>
	<?php include _template."seo_tpl.php"?>
	
	<div class="tab-pane  " id="advs" >
		 <button id="add-advs">Thêm </button>
		<p></p>
		<div class="col-xs-12">
		<div id="advs-container">
		<?php
			foreach(json_decode(@$item['gallery']) as $k=>$v){
			$id = md5(time().rand(0,9999));
			?>
			<div class="form-group"><div class="col-sm-6 input-group"><span class="input-group-addon"><a onclick="viewFcb('<?=$id?>');return false;" class="view_fcb" id="" href="">Xem hình</a></span><input type="text" name="advs[]" value="<?=$v->img?>" class="form-control main-image" id="<?=$id?>"><span class="input-group-btn"> <button type="submit" data-for="<?=$id?>" class="show btn browser">Chọn</button></span><span class="input-group-btn"> <button class=" btn btn-primary " onclick="$(this).parent().parent().parent().remove();">Xóa</button></span></div><div class="col-sm-6 input-group" style="margin-top:5px"><input type="text" name="links[]" value="<?=$v->link?>" class="link form-control main-image" placeholder="Link quảng cáo"></div></div>
			<?php
			}
		?>	
		</div><!-- end advs-container -->
		</div>
			
		<div class="clearfix"></div>
	 </div><!-- end #gallery -->
	 <script>
		$().ready(function(){
			
			$("#add-advs").click(function(){
			$id = makeid();
			$content = '<div class="form-group">';
			$content +='<div class="col-sm-6 input-group"><span class="input-group-addon"><a onclick="viewFcb(\''+$id+'\');return false;" class="view_fcb" id="" href="">Xem hình</a></span><input type="text" name="advs[]" value="" class="form-control main-image" id="'+$id+'"><span class="input-group-btn"> <button type="submit" data-for="'+$id+'" class="show btn browser">Chọn</button></span><span class="input-group-btn"> <button class=" btn btn-primary " onclick="$(this).parent().parent().parent().remove();">Xóa</button></span></div>';
			$content +='<div class="col-sm-6 input-group" style="margin-top:5px"><input type="text" name="links[]" value="" class="link form-control main-image" placeholder="Link"/></div>';
			$content +='</div>';
			$("#advs-container").append($content);
			initInput();
			initBrowserServer();
			initLink();
			return false;
			})
		})
		
		function viewFcb(obj){
				
			$href = base_url+$("#"+obj).val();

			$.fancybox({href:$href});
			return false;
		}
	</script>
	</div>
</div></div>		
<!-- content-tab --><div class="clearfix"></div>
</div>


</form>