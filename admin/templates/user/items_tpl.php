<h3>Hội viên</h3>

<table class="blue_table">
	<tr>
		<th>Stt</th>
		<th>Tên tài khoản</th>
		<th>Email</th>
		<th>Hiển thị</th>
		<th>Sửa</th>
		<th>Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:6%;"><?=$i+1?></td>
		<td style="width:38%;"><?=$items[$i]['username']?></td>
		<td style="width:38%;"><?=$items[$i]['email']?></td>
		<td style="width:6%;"><?php if(@$items[$i]['hienthi']){?><img src="media/images/active_1.png" /><? }?></td>
		<td style="width:6%;"><a href="index.php?com=user&act=edit&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" /></a></td>
		<td style="width:6%;"><a href="index.php?com=user&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" /></a></td>
	</tr>
	<?php	}?>
</table>
<div class="paging"><?=$paging['paging']?></div>