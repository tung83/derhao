<h3>Thêm hình 2 bên web</h3>

<form name="frm" method="post" action="index.php?com=letruot&act=save_photo" enctype="multipart/form-data" class="nhaplieu">		
  <?php for($i=0; $i<2; $i++){?>
	
	<b>Hình ảnh <?=$i+1?></b> <input type="file" name="file<?=$i?>" /> Width:110px	<br /> <br />	 
    <b>Lề trượt</b> <select name="letruot<?=$i?>" style="width:150px;">
                               		 <option value="trai">Lề trái</option>
                                     <option value="phai">Lề phải</option>
                                </select> <br />	 <br />	      	
    <b>Link</b> <input type="text" name="link<?=$i?>" value="" class="input" /><br />	<br />	 
    <b>Số thứ tự </b> <input type="text" name="stt<?=$i?>" value="1" style="width:30px" />	<br /><br />	 
	<b>Hiển thị</b> <input type="checkbox" name="hienthi<?=$i?>" checked="checked" /> <br /><br />
	
<? }?>
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=letruot&act=man_photo'" class="btn" />
</form>