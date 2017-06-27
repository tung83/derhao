<div class="box-header with-border">
<h3><?=($_GET['act']=='add') ? 'Thêm' : 'Sửa' ?> danh mục</h3>
</div>
<div class="box-body">
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="form-horizontal " role="form" > 
	
  <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success btn-flat" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man_danhmuc'" class="btn btn-warning btn-flat" />
	<p></p>	
  <div class="col-xs-12">
  <div class="row">
  <?php $per = $content->getPermission()?>
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">
	
	
	
		<div class="col-xs-12 col-md-6">
		 <?php if($per['has_photo']){?>
			
					<div class="form-group">
						  <label for="exampleInputFile">Hình đại diện</label>
						  <input type="file" name="file" id="exampleInputFile">
						  <p class="help-block red">Example block-level help text here.</p>
                    </div>
			
				
				<?php if (strpos($_GET['act'],'edit') !== false) { ?>

				<a class="fancybox"  href="<?=_upload_sanpham.@$item['photo']?>" ><img id="main-image" src="<?=_upload_sanpham.@$item['photo']?>" class="col-xs-4 img-thumbnail" /></a>
				<?php } ?>
				
			 
			  <?php } ?>
			  <?php if($per['has_background']){?>
			 <div class="form-group">
				<label for="inputEmail3">Background </label>
				  
				<div class="col-sm-8 input-group colorpicker">
					  <input type="text" name="background_color"  value="<?=@$item['background_color']?>" class="form-control w-120  " id="inputEmail3">
					   <span class="input-group-addon"><i></i></span>
					</div>
			 </div>
			  <?php }?>
			 
		 </div>

	
	 <div class="col-xs-12 col-md-6 align-left">
		
			 <div class="checkbox">
				<label>
				  <input type="checkbox"  name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>> Hiển thị
				</label>
			  </div>
			  <div class="checkbox">
				<label>
				  <input type="checkbox"  name="noibat" <?=(!isset($item['noibat']) || $item['noibat']==1)?'checked="checked"':''?>> Nổi bật
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
		   <?php if($per['has_desc']){?>
		 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
				<div class="col-sm-10">
				  <textarea  name="mota_<?=$v?>" class="form-control " id="mota_<?=$v?>" ><?=@$item['mota_'.$v]?></textarea>
				</div>
			</div>
		   <?php } ?>
		    <?php if($per['has_content']){?>
		 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label>
				<div class="col-sm-10">
				  <textarea  name="noidung_<?=$v?>" class="form-control editor" id="nd_<?=$v?>" ><?=@$item['noidung_'.$v]?></textarea>
				</div>
			</div>
		   <?php } ?>
		   
		   
		<div class="clearfix"></div>
		 </div>
	<?php } ?>
	<?php include _template."seo_tpl.php"?>
	</div>
</div></div>		
<!-- content-tab --><div class="clearfix"></div>
</div>


</form>
</div>