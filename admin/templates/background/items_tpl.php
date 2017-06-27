<div class="box-header with-border">
<h3>Quản lý background</h3>
      </div>
	  <div class="box-body">
<table class="table table-bordered">
	<tr>
		<th style="width:6%;">Id</th>
		<th style="width:15%;">Tên </th>
		
		<th style="width:6%;">Sửa</th>
        
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:6%;"><?=$items[$i]['id']?></td>
		<td style="width:15%;"><?=$items[$i]['ten']?></td>
		
		<td style="width:6%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png"  border="0"/></a></td>
        
        
	</tr>
	<?php	}?>
</table>

<div class="paging"><?=$paging['paging']?></div>
</div>
