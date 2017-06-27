
<h3>Chỉnh sửa quảng cáo</h3>
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save_photo" enctype="multipart/form-data" class="form-horizontal " role="form" > 
  <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man_photo'" class="btn btn-warning" />
	<p></p>	
  <div class="col-xs-8">
  <div class="row">
  
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">
	
	
		<div class="col-xs-12">
			<div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-3 align-left  control-label">Hình ảnh</label>
				   <div class="input-group">
				 <input type="file" name="file" />
				  
				</div>
				<a class="fancybox"  href="<?=_upload_hinhanh.@$item['photo']?>" ><img  id="main-image" src="<?=_upload_hinhanh.@$item['photo']?>" class="col-xs-4" /></a>
			 </div>
		 </div>
		 
		 
		<div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 align-left control-label">Tiêu đề</label>
					<div class="col-sm-8">
					  <input type="text" name="ten"  value="<?=@$item['ten']?>" class="form-control  " id="inputEmail3">
					</div>
				 </div>
			</div>	 
		</div>

		 	<div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 align-left control-label">Link</label>
					<div class="col-sm-8">
					  <input type="text" name="link"  value="<?=@$item['link']?>" class="form-control  " id="inputEmail3">
					</div>
				 </div>
			</div>	 
		</div>
	 
		<div class="col-xs-12">
			 <div class="checkbox">
				<label>
				  <input type="checkbox"  name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>> Hiển thị
				</label>
			  </div>
		</div>	  
			<div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 align-left control-label">Số thứ tự</label>
					<div class="col-sm-8">
					  <input type="text" name="stt"  value="<?=(@$stt) ? $stt : @$item['stt']?>" class="form-control  w-120" id="inputEmail3">
					</div>
				 </div>
			</div>	 
			</div>
			<div class="clearfix"></div>	
		 </div>
	
	 
	 <div class="clearfix"></div>
	
	
	
	</div>	
</div><!-- content-tab --><div class="clearfix"></div>
<!-- Tab panes -->

	
</form>