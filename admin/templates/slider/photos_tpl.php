<script>
$(document).ready(function() {
$("#chonhet").click(function(){
	var status=this.checked;
	$("input[name='chon']").each(function(){this.checked=status;})
});

$("#xoahet").click(function(){
	var listid="";
	$("input[name='chon']").each(function(){
		if (this.checked) listid = listid+","+this.value;
    	})
	listid=listid.substr(1);	 //alert(listid);
	if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
	hoi= confirm("Bạn có chắc chắn muốn xóa?");
	if (hoi==true) document.location = "index.php?com=<?=$_GET['com']?>&act=delete_photo&listid=" + listid+"&type=<?=$_GET['type']?>";
});
});
</script>


<div class="box-header with-border">
<h3><a href="index.php?com=<?=$_GET['com']?>&act=add_photo">Thêm hình ảnh</a></h3>
</div>
<div class="box-body">

<div class="table-responsive">
<table class="table table-bordered">
	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th style="width:5%;">ID</th>      
		<th style="width:70%;">Hình ảnh</th>     
		<th style="width:10%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
        <th style="width:5%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td style="width:5%;"><?=$items[$i]['id']?></td>
		
        <td style="width:80%;">
       <img src="<?=_upload_hinhanh.$items[$i]['photo']?>" height="70" />
        </td>       	
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['hienthi']) ? 'checked' : ''?> class="switch-input" data-type="hienthi" data-com="<?=$_GET['com']?>" data-id="<?=$items[$i]['id']?>"/>   
        </td>		
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_photo&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="icon-form"><i class="glyphicon glyphicon-pencil"></i></a></td>
        <td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete_photo&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"class="icon-form"><i class="glyphicon glyphicon-trash"></i></a></td>
	</tr>
	<?php	}?>
</table>

<a href="index.php?com=<?=$_GET['com']?>&act=add_photo&type=<?=$_GET['type']?>" class="btn btn-info btn-flat  ">Thêm mới</a>
<a href="#" id="xoahet" class="btn  btn-danger btn-flat">Xóa</a>
<div class="paging"><?=$paging['paging']?></div>
</div>
</div>