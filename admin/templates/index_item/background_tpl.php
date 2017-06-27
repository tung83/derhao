<h3>Chỉnh sửa background </h3>
<form name="frm" method="post" action="index.php?com=index_item&act=background" enctype="multipart/form-data" class="nhaplieu"> 

	<b>File cũ:</b><img width="200px" src="<?=_upload_hinhanh.$item['photo']?>" target="_new"><br />

	<b>Chọn file:</b> <input type="file" name="file" /> jpg|JPG|png<br />
    <br />	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" name="submit"/>
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php'" class="btn" />
</form>