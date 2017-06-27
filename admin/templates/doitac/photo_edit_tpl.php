
<div class="box-header with-border">
	<h3>Cập nhật logo đối tác</h3>
</div>
<div class="box-body">
<form name="frm" method="post" action="index.php?com=doitac&act=save_photo&id=<?=$_REQUEST['id'];?>&idc=<?=$_REQUEST['idc']?>" enctype="multipart/form-data" class="nhaplieu">
	
		<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man_photo'" class="btn btn-warning" />
	<p></p>
	<div class="col-xs-12 col-md-6">
	<div class="row">
	<div class="form-group">
	  <label for="exampleInputEmail1">Tên</label>
	  <input type="text" name="ten" class="form-control" id="exampleInputEmail1" value="<?=@$item['ten']?>">
	</div>
	<div class="form-group">
	  <label for="exampleInputEmail1">Link</label>
	  <input type="text" name="link" class="form-control link" id="exampleInputEmail1" value="<?=@$item['link']?>">
	</div>
	<div class="form-group">
	  <label for="exampleInputFile">Hình hiện tại</label>
	 <p></p>
	  <img src="<?=_upload_hinhanh.$item['photo']?>" height="100" />
	</div>
	
	<div class="form-group">
	  <label for="exampleInputFile">Upload file</label>
	  <input type="file" class="form-control" name="file<?=$i?>" id="exampleInputFile">
	  <p class="help-block red">Hình có kích thước:  Width <?=_logo_width?> px - Height:<?=_logo_height?> px</p>
	</div>
	<div class="form-group">
	  <label for="exampleInputEmail1">Số thứ tự </label>
	  <input type="text" name="stt" class="form-control" id="exampleInputEmail1" value="<?=@$item['stt']?>">
	</div>
	<div class="checkbox">
		  <label>
			<input type="checkbox" name="hienthi" <?=$item['hienthi'] ? 'checked="checked"' : ""?> > Hiển thị
		  </label>
	</div>
	</div>
	</div>
	
</form>
</div>