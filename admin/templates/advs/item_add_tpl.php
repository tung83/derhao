<h3> Thêm thông dịch vụ</h3>

<form name="frm" method="post" action="index.php?com=doitac&act=save" enctype="multipart/form-data" class="nhaplieu">
	<?php if (@$_REQUEST['act']=='edit')
	{?>
	<b>Hình hiện tại:</b><img src="<?=_upload_hinhanh.$item['photo']?>" alt="NO PHOTO"  width="150" height="150"/><br />
	<?php }?>
    
	<b>Hình ảnh:</b> <input type="file" name="file" /> <strong >Hình ảnh</strong><br />
    <br />
	
	<b>Tên</b> <input type="text" name="ten" value="<?=@$item['ten']?>" class="input" /><br /><br>
    
    
    <b>Nội dung</b>
	<div>
	<?php
	$oFCKeditor = new FCKeditor('mota') ;
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Height		= 400;
	$oFCKeditor->Value		= @$item['mota'];
	$oFCKeditor->Create() ;
	?></div>
    
    <b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br>

	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=doitac&act=man'" class="btn" />
</form>