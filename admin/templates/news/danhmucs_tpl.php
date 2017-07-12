
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
	if (listid=="") { alert("Ban chua chon muc nao"); return false;}
	hoi= confirm("B?n có ch?c ch?n mu?n xóa?");
	if (hoi==true) document.location = "index.php?com=product&type=<?=$_GET['type']?>&act=delete_danhmuc&listid=" + listid;
});
});
</script>
<div class="box-header with-border">
<h3>Quản lý danh mục </h3>
</div>
<div class="box-body">
<table class="table table-bordered">
	<thead>
    	<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
		<th style="width:5%;">STT</th>
		<th style="width:80%;">Danh mục </th>
		<th style="width:10%;">Nổi bật</th>
		<th style="width:10%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</thead>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr bgcolor="<?php if($i%2==1)echo '#F3F3F3' ?>">
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
		<td style="width:5%;"><?=$items[$i]['stt']?></td>
		<td align="center" style="width:80%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_danhmuc&type=<?=$_GET['type']?>&id=<?=$items[$i]['id']?>"><?=$items[$i]['ten_vi']?>  (			<?php 
				$d->query("select id from #_$com where id_danhmuc = ".$items[$i]['id']);
				echo $d->num_rows();
			?>
		)</a> </td>
		 <td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['noibat']) ? 'checked' : ''?> class="switch-input" data-type="noibat" data-com="<?=$_GET['com']?>_danhmuc" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['hienthi']) ? 'checked' : ''?> class="switch-input" data-type="hienthi" data-com="<?=$_GET['com']?>_danhmuc" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_danhmuc&type=<?=$_GET['type']?>&id=<?=$items[$i]['id']?>&title=<?=$_GET['title']?>&desc=<?=$_GET['desc']?>&content=<?=$_GET['content']?>" class="icon-form"><i class="glyphicon glyphicon-pencil"></i></a></td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete_danhmuc&type=<?=$_GET['type']?>&id=<?=$items[$i]['id']?>&title=<?=$_GET['title']?>&desc=<?=$_GET['desc']?>&type=<?=$_GET['type']?>&content=<?=$_GET['content']?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten_vi']?>')) return false;" class="icon-form"><i class="glyphicon glyphicon-trash"></i></a></td>
	</tr>
	<?php	}?>
</table>


<a href="index.php?com=<?=$_GET['com']?>&act=add_danhmuc&type=<?=$_GET['type']?>&title=<?=@$_GET['title']?>&desc=<?=@$_GET['desc']?>&content=<?=@$_GET['content']?>" class="btn btn-info btn-flat  ">Thêm mới</a>
<a href="#" id="xoahet" class="btn  btn-danger btn-flat">Xóa</a>
<div class="paging"><?=$paging['paging']?></div>
</div>