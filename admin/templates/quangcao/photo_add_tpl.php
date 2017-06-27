<h3>Hình ảnh</h3>
<form name="frm" method="post" action="index.php?com=quangcao&act=save_photo" enctype="multipart/form-data" class="nhaplieu">
<?php for($i=0; $i<5; $i++){?>
	<b>Hình ảnh <?=$i+1?></b> <input type="file" name="file<?=$i?>" /> <strong>Width:140px &nbsp;&nbsp;&nbsp;&nbsp; .jpg, .gif, png</strong><br />
    <br />
	<b>Link: </b> <input name="mota<?=$i?>" type="text" size="40"   />	
	<br />
    <br />
    
<b>Số thứ tự </b> <input type="text" name="stt<?=$i?>" value="1" style="width:30px" />	<br />
	<b>Hiển thị</b> <input type="checkbox" name="hienthi<?=$i?>" checked="checked" /> <br /><br />
	
<? }?>
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=quangcao&act=man_photo'" class="btn" />
</form>