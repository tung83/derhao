<div class="box-header with-border">
<h3>Quản lý Banner</a></h3>
</div>
<div class="box-body">
<div class="table-responsive">
<table class="table table-bordered">
	<tr>
		<th style="width:6%;">Stt</th>
		<th style="width:6%;">Tên</th>
		<th style="width:12%;">Hình ảnh</th>

		<th style="width:6%;">Sửa</th>
		
	</tr>
	<?php for($i=0, $count=count($items2); $i<$count; $i++){
		//if($items2[$i]['mota']=='vi'){
		if(1){
		?>
	<tr>
		<td style="width:6%;"><?=$items2[$i]['stt']?></td>
		<td style="width:6%;"><?=$items2[$i]['ten']?></td>
		<td style="width:12%;">
       
       <img src="<?=_upload_hinhanh.$items2[$i]['photo']?>" width="100" height="100" />
        
        </td>
       
        
		
		<td style="width:6%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_banner&id=<?=$items2[$i]['id']?>&idc=<?=$items2[$i]['id_photo']?>" class="icon-form"><i class="glyphicon glyphicon-pencil"></i></a></td>
		
	</tr>
	<?php }	}?>
</table>
<!-- <a href="index.php?com=<?=$_GET['com']?>&act=add_photo&idc=<?=$_REQUEST['idc'];?>"><img src="media/images/add.jpg" border="0"  /></a> -->
<div class="paging"><?=$paging['paging']?></div>
</div>