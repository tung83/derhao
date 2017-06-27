
<div class="box-header with-border">
<h3>Quản lý logo đối tác</a></h3>
</div>
<div class="box-body">

<div class="table-responsive">
<table class="table table-bordered">
	<tr>
		<th style="width:6%;">Stt</th>
		<th style="width:12%;">Hình ảnh</th>
      	<th style="width:6%;">Hiển thị</th>
		<th style="width:6%;">Sửa</th>
		<th style="width:6%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:6%;"><?=$items[$i]['stt']?></td>
		<td style="width:12%;">
       
       <img src="<?=_upload_hinhanh.$items[$i]['photo']?>" width="100" height="100" />
        
        </td>
       
        
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['hienthi']) ? 'checked' : ''?> class="switch-input" data-type="hienthi" data-com="<?=$_GET['com']?>" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_photo&id=<?=$items[$i]['id']?><?=$request?>" class="icon-form"><i class="glyphicon glyphicon-pencil"></i></a></td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete_photo&id=<?=$items[$i]['id']?><?=$request?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten_vi']?>')) return false;" class="icon-form"><i class="glyphicon glyphicon-trash"></i></a></td>
	</tr>
	<?php	}?>
</table>
<a href="index.php?com=<?=$_GET['com']?>&act=add_photo<?=$request?>" class="btn btn-info btn-flat  ">Thêm mới</a>

<div class="paging"><?=$paging['paging']?></div>

</div>
</div>