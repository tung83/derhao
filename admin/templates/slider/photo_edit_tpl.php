<div class="box-header with-border">
	<h3>Chỉnh sửa hình</h3>
</div>
<div class="box-body">

<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save_photo&id=<?=$_REQUEST['id'];?>&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="nhaplieu">
<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man_photo&type=<?=$_GET['type']?>'" class="btn btn-warning" />
	<p></p>
   
		<div class="form-group">
		  <label for="exampleInputFile">Hình hiện tại</label>
		 <p></p>
		  <img src="<?=_upload_hinhanh.$item['photo']?>" height="100" />
		</div>
		<div class="col-xs-12 col-md-6">
		<div class="form-group">
		  <label for="exampleInputFile">Upload file</label>
		  <input type="file" name="file<?=$i?>" id="exampleInputFile">
		  <p class="help-block red">Hình có kích thước:  Width <?=$sl_size[$_GET['type']]['w']?> px - Height:<?=$sl_size[$_GET['type']]['h']?> px</p>
		</div>
		
		<div class="form-group">
		  <label for="exampleInputEmail1">Tên</label>
		  <input type="text" class="form-control" id="exampleInputEmail1" name="ten" value="<?=@$item['ten']?>" placeholder="">
		</div>
		<div class="form-group">
		  <label for="exampleInputPassword1">Url</label>
		  <input type="text" class="form-control link" id="exampleInputPassword1" value="<?=@$item['link']?>" name="link" placeholder="">
		</div>
		<div class="form-group">
			 <label for="exampleInputPassword1">Mô tả</label>
			<div class="clearfix"></div>
			<div class="">
			  <textarea name="mota" class="form-control" id="inputEmail3"><?=@$item['mota']?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			  <label for="exampleInputPassword1">Số thứ tự</label>
			  <input type="text" class="form-control  w-120" id="exampleInputPassword1" value="<?=@$item['stt']?>" name="stt" placeholder="">
		</div>
		<div class="checkbox">
                      <label>
                        <input type="checkbox" name="hienthi" <?=$item['hienthi'] ? 'checked="checked"' : ""?> > Hiển thị
                      </label>
                    </div>
		</div>
		
	
	<input type="hidden" name="id" value="<?=$item['id']?>" />
	
</form>
</div>