<?php 
	$title = isset($_GET['title']) ? $_GET['title'] : 1;
	$img = isset($_GET['img']) ? $_GET['img'] : 1;
	$desc = isset($_GET['desc']) ? $_GET['desc'] : 1;
	$content  = isset($_GET['title']) ? $_GET['content'] : 1;



?>
<div class="box-header with-border">
<?php if ($_REQUEST['act']=='edit_danhmuc') { ?> <h3>Sửa danh mục cấp 1</h3> <?php }else{ ?><h3>Thêm danh mục cấp 1</h3>
</div><?php } ?>
<div class="box-body">
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save_danhmuc&type=<?=$_GET['type']?>&img=<?=$_GET['img']?>&title=<?=$_GET['title']?>&desc=<?=$_GET['desc']?>&content=<?=$_GET['content']?>" enctype="multipart/form-data" class="form-horizontal " role="form" > 
	
  <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man_danhmuc&type=<?=$_GET['type']?>&img=<?=$_GET['img']?>&title=<?=$_GET['title']?>&desc=<?=$_GET['desc']?>&content=<?=$_GET['content']?>'" class="btn btn-warning" />
	<p></p>	
  <div class="col-xs-12">
  <div class="row">
  

	<div id="tab-content">
	
	 <div class="col-xs-12 align-left">
	 <?php if($img){?>
		<div class="col-xs-6">
		<div class="col-xs-12">
			<div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-4 control-label">400x300</label>
				   <div class="input-group">
				 <input type="file" name="file" />
				  
				</div>
				
				<?php if (strpos($_GET['act'],'edit') !== false) { ?>

				<a class="fancybox"  href="<?=_upload_tintuc.@$item['photo']?>" ><img id="main-image" src="<?=_upload_tintuc.@$item['photo']?>" class="col-xs-4 img-thumbnail" /></a>
				<?php } ?>
			 </div>
			 
			
			 
		 </div>
	 </div> 
	 <?php } ?>
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
	</ul>
	
	
	<div class="tab-content">
	
	<?php
		foreach($config['lang'] as $k=>$v){?>
			
		<?php $act = ''; if($k==0){ $act = 'active'; }?>
		
		 <div class="tab-pane  <?=$act?>" id="<?=$v?>" >
		<?php if($title){?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
			<div class="col-sm-10">
			  <input type="text" name="ten_<?=$v?>" value="<?=@$item['ten_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>		
		<?php } 
		if($desc){?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
			<div class="col-sm-10">
			  <textarea  name="mota_<?=$v?>" class="form-control" id="inputEmail3" ><?=@$item['mota_'.$v]?></textarea>
			</div>
		</div>
		<?php } if($content){?>
		<div class="clearfix"></div>
		<div class="form-group">
			<p><label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label></p>
			<div class="clearfix"></div>
			<p></p>
			<div class="col-sm-12">
			  <textarea  name="noidung_<?=$v?>" class="form-control editor" id="nd_<?=$v?>" ><?=@$item['noidung_'.$v]?></textarea>
			</div>
		</div>
		<?php }?>
		
		
		
		
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