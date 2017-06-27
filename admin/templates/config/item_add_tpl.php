
<h3>Mạng xã hội</h3>
<form name="frm" method="post" action="index.php?com=config&act=save" enctype="multipart/form-data" class="nhaplieu">   

	<div>
	<?php
		foreach($items as $k=>$v){	
			echo '<p><b>'.$v['key'].'</b><textarea name="config['.$v['key'].']" cols="50" rows="5">'.$v['content'].'</textarea></p>';
			if($v['key']=="background"){
				echo '<p><input type="file" name="file" />';
			}
		}
	
	?>
	 
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=config&act=capnhat'" class="btn" />
	</div>
</form>