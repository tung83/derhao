<h3><a href="index.php?com=<?=$_GET['com']?>&act=add_photo">Thêm hình ảnh</a></h3>

<table class="blue_table">
	<tr>
		<th style="width:6%;">Stt</th>
		<th style="width:6%;">Tên</th>
		<th style="width:12%;">Hình ảnh</th>
      	<th style="width:6%;">Hiển thị</th>
		<th style="width:6%;">Sửa</th>
		
	</tr>
	<?php for($i=0, $count=count($items2); $i<$count; $i++){?>
	<tr>
		<td style="width:6%;"><?=$items2[$i]['stt']?></td>
		<td style="width:6%;"><?=$items2[$i]['ten']?></td>
		<td style="width:12%;">
       
       <img src="<?=_upload_hinhanh.$items2[$i]['photo']?>" width="100" height="100" />
        
        </td>
       
        
		<td style="width:6%;"><?php if(@$items2[$i]['hienthi']){?><img src="media/images/active_1.png" /><? }else {?><img src="media/images/active_0.png" /><? }?></td>
		<td style="width:6%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_banner&id=<?=$items2[$i]['id']?>&idc=<?=$items2[$i]['id_photo']?>"><img src="media/images/edit.png" border="0" /></a></td>
		
	</tr>
	<?php	}?>
</table>
<!-- <a href="index.php?com=<?=$_GET['com']?>&act=add_photo&idc=<?=$_REQUEST['idc'];?>"><img src="media/images/add.jpg" border="0"  /></a> -->
<div class="paging"><?=$paging['paging']?></div>