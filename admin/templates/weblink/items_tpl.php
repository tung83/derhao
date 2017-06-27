<div class="box-header with-border">
<h3>Link liên kết</h3>
</div>
<div class="box-body">

<div class="table-responsive">


<table class="table table-bordered">
	<tr>
		<th style="width:6%;">Stt</th>
		<th style="width:15%;">Tên </th>
        <th style="width:40%;">Liên kết </th>
		<th style="width:6%;">Hiển thị</th>
		<th style="width:6%;">Sửa</th>
        <th style="width:6%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:6%;"><?=$items[$i]['stt']?></td>
		<td style="width:15%;"><?=$items[$i]['ten_vi']?></td>
		<td style="width:15%;"><?=$items[$i]['link']?></td>
        
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['hienthi']) ? 'checked' : ''?> class="switch-input" data-type="hienthi" data-com="<?=$_GET['com']?>" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id=<?=$items[$i]['id']?>" class="icon-form"><i class="glyphicon glyphicon-pencil"></i></a></td>
        <td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"class="icon-form"><i class="glyphicon glyphicon-trash"></i></a></td>
	</tr>
	<?php	}?>
</table>
<a href="index.php?com=<?=$_GET['com']?>&act=add" class="btn btn-info btn-flat  ">Thêm mới</a>


<div class="paging"><?=$paging['paging']?></div>
</div>
</div>
