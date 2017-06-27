<h3><a href="index.php?com=img&act=add_cat">Thêm danh mục</a></h3>
<table class="blue_table">
	<tr>
		<th width="7%" style="width:6%;">Stt</th>
		<th width="42%" style="width:30%;">Danh mục </th>
		<th width="16%" style="width:30%;">Hình ảnh</th>
		<th width="13%" style="width:6%;">Hiển thị</th>
		<th width="11%" style="width:6%;">Sửa</th>
		<th width="11%" style="width:6%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:6%;"><?=$items[$i]['stt']?></td>
		<td align="center" style="width:30%;"><?=$items[$i]['ten']?> </td>
		<td align="center" style="width:30%;">
         <img src="<?=_upload_album.$items[$i]['photo']?>" width="100" height="100" />
        </td>
		<td style="width:6%;">
		
        <?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>
        <a href="index.php?com=img&act=man_cat&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
		<? 
		}
		else
		{
		?>
         <a href="index.php?com=img&act=man_cat&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>
        
        
        
        </td>
		<td style="width:6%;"><a href="index.php?com=img&act=edit_cat&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" border="0" /></a></td>
		<td style="width:6%;"><a href="index.php?com=img&act=delete_cat&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>

<a href="index.php?com=img&act=add_cat"><img src="media/images/add.jpg" border="0"  /></a>
<div class="paging"><?=$paging['paging']?></div>