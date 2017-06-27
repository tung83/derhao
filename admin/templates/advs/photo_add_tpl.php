<h3>Thêm quảng cáo</h3>
<div class="col-xs-8">
<form name="frm" method="post" action="index.php?com=advs&act=save_photo" enctype="multipart/form-data" class="form-horizontal ">		
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man_photo'" class="btn btn-warning" />
	<p></p>	
  <?php for($i=0; $i<2; $i++){?>
	<div id="tab-content">
	
	
		<div class="col-xs-12">
			<div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-3 align-left  control-label">Hình ảnh</label>
				   <div class="input-group">
				 <input type="file" name="file<?=$i?>" />
				  <span class="help-block red">Hình quảng cáo có chiều ngang 250px</span>
				</div>
				
			 </div>
		 </div>
		 
		 
		<div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 align-left control-label">Tiêu đề</label>
					<div class="col-sm-8">
					  <input type="text" name="ten<?=$i?>"  value="<?=@$item['ten']?>" class="form-control" required id="inputEmail3">
					</div>
				 </div>
			</div>	 
		</div>

		 	<div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 align-left control-label">Link</label>
					<div class="col-sm-8">
					  <input type="text" name="link<?=$i?>"  value="<?=@$item['link']?>" class="form-control link" required id="inputEmail3">
					</div>
				 </div>
			</div>	 
		</div>
	 
		<div class="col-xs-12">
			 <div class="checkbox">
				<label>
				  <input type="checkbox"  name="hienthi<?=$i?>" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>> Hiển thị
				</label>
			  </div>
		</div>	  
			<div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 align-left control-label">Số thứ tự</label>
					<div class="col-sm-8">
					  <input type="text" name="stt<?=$i?>"  value="1" required class="form-control  w-120" id="inputEmail3">
					</div>
				 </div>
			</div>	 
			</div>
			<div class="clearfix"></div>	
		 </div>
		 <p></p>
	
<? }?>
	
</form>
</div>