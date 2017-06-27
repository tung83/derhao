<h3>Quảng lý background</h3>
<form name="frm" method="post" action="index.php?com=photo&act=save" enctype="multipart/form-data" class="nhaplieu">
	<b>Hình hiện tại:</b> 
	<?php
	 if($item['photo']!=NULL)
	 {
	 ?>
            
     <object width="980" height="155"  codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=4,0,0,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
              <param NAME="_cx" VALUE="13414">
              <param NAME="_cy" VALUE="6641">
              <param NAME="FlashVars" VALUE>
              <param NAME="Movie" VALUE="<?=_upload_hinhanh.$item['photo']?>">
              <param NAME="Src" VALUE="<?=_upload_hinhanh.$item['photo']?>">
              <param NAME="Quality" VALUE="High">
              <param NAME="AllowScriptAccess" VALUE>
              <param NAME="DeviceFont" VALUE="0">
              <param NAME="EmbedMovie" VALUE="0">
              <param NAME="SWRemote" VALUE>
              <param NAME="MovieData" VALUE>
              <param NAME="SeamlessTabbing" VALUE="1">
              <param NAME="Profile" VALUE="0">
              <param NAME="ProfileAddress" VALUE>
              <param NAME="ProfilePort" VALUE="0">
              <param NAME="AllowNetworking" VALUE="all">
              <param NAME="AllowFullScreen" VALUE="false">
              <param name="scale" value="ExactFit">
             <embed src="<?=_upload_hinhanh.$item['photo']?>" quality="High" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" width="980" height="155" scale="ExactFit"></embed>
            </object>
            
	 <?php 
	 } 
	 else 
	 {
	 echo "Chưa có banner"; 
	 }
	 ?><br /><br />
	<b>Background hiện tại: </b> 
    <input type="file" name="file" /> <strong>Width:980px&nbsp;-&nbsp;Height:155px&nbsp;Type:&nbsp;.swf</strong><br />
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" checked="checked" /> <br /><br />
	<input type="hidden" name="id" value="<?=$item['id']?>" />

	
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=bannerqc&act=man'" class="btn" />
</form>