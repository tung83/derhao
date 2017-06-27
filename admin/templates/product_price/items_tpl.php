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
	if (hoi==true) document.location = "index.php?com=<?=$_GET['com']?>&act=delete&listid=" + listid;
});
});
</script>
<div class="box-header with-border">
<h3>Quản lý</h3>
      </div>
	  <div class="box-body">


<table class=" table table-bordered">

	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th width="5%" style="width:6%;">Stt</th>

        <th style="width:40%;">Tên </th>
	
	  <th width="9%" style="width:6%;">Hiển thị</th>
		<th width="9%" style="width:6%;">Sửa</th>
		<th width="9%" style="width:6%;">Xóa</th>
	</tr>
    
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td style="width:6%;" align="center"><?=$items[$i]['stt']?></td>
       
      
		<td style="width:40%;" align="center"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten_vi']?></a></td>
	
		<td style="width:7%;">
		<input type="checkbox" <?=($items[$i]['hienthi']) ? 'checked' : ''?> class="switch-input" data-type="hienthi" data-com="<?=$_GET['com']?>" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id=<?=$items[$i]['id']?>" class="icon-form"><i class="glyphicon glyphicon-pencil"></i></a></td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete&id=<?=$items[$i]['id']?><?=$request?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten_vi']?>')) return false;" class="icon-form"><i class="glyphicon glyphicon-trash"></i></a></td>
	</tr>
	<?php	}?>
</table>
<a href="index.php?com=<?=$_GET['com']?>&act=add<?=$request?>" class="btn btn-info btn-flat  ">Thêm mới</a>
<a href="#" id="xoahet" class="btn  btn-danger btn-flat">Xóa</a>
<div class="paging"><?=$paging['paging']?></div>

</div>