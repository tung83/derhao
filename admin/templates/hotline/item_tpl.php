<h3><a href="index.php?com=product1&act=add">Thêm danh mục cấp 1</a></h3>

<table class="blue_table">
	<tr>
		<th style="width:6%;">Stt</th>
		<th style="width:76%;">Tên <br /></th>
		<th style="width:6%;">Hiển thị</th>
		<th style="width:6%;">Sửa</th>
		<th style="width:6%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:6%;"><?=$items[$i]['stt']?></td>
		<td style="width:76%;"><?=$items[$i]['ten']?></td>
		<td style="width:6%;">
		<?php
		 if(@$items[$i]['hienthi']==1)
		 {
		 ?>
         <img src="media/images/active_1.png" />
		 <? 
		 }
		 else
		 {
		 ?>
          <img src="media/images/active_0.png" />
          <?php
		  }?>
         </td>
		<td style="width:6%;"><a href="index.php?com=product1&act=edit&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" /></a></td>
		<td style="width:6%;"><a href="index.php?com=product1&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" /></a></td>
	</tr>
	<?php	}?>
</table>
<div class="paging"><?=$paging['paging']?></div>