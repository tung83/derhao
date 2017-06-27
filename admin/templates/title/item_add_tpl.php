
<div class="box-header with-border">
	<h3> Cập nhật tiêu đề website</h3>
</div>
<div class="box-body">

<form name="frm" method="post" action="index.php?com=title&act=save" enctype="multipart/form-data" class="nhaplieu">
	
	<b>Title:</b> <input type="text" name="ten" value="<?=@$item['ten']?>" class="input" /><br /><br>
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=title&act=capnhat'" class="btn" />
</form>
</div>