
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
	if (hoi==true) document.location = "index.php?com=<?=$_GET['com']?>&act=delete_danhmuc&listid=" + listid;
});
});
</script>
<div class="box-header with-border">
<h3>Quản lý danh mục</h3>
</div>
<div class="box-body">

<table class="table table-bordered">
	<thead>
    	<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
		<th style="width:5%;">STT</th>
		<th style="width:20%;">Tên</th>
		<th style="width:20%;">Danh mục cha</th>
		<th style="width:10%;">Nổi bật</th>
		<th style="width:10%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</thead>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr bgcolor="<?php if($i%2==1)echo '#F3F3F3' ?>">
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
		<td style="width:5%;"><?=$items[$i]['stt']?></td>
		<td align="center" style="width:80%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_danhmuc&id=<?=$items[$i]['id']?>"><?=$items[$i]['ten_vi']?></a> </td>
		<td style="width:5%;">

        <?php
		if(@$items[$i]['noibat']==1)
		{
		?>
        <a href="index.php?com=<?=$_GET['com']?>&act=man_danhmuc&noibat=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
		<?
		}
		else
		{
		?>
         <a href="index.php?com=<?=$_GET['com']?>&act=man_danhmuc&noibat=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>



        </td>
		
		
		
		<td style="width:5%;">

        <?php
		if(@$items[$i]['hienthi']==1)
		{
		?>
        <a href="index.php?com=<?=$_GET['com']?>&act=man_danhmuc&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
		<?
		}
		else
		{
		?>
         <a href="index.php?com=<?=$_GET['com']?>&act=man_danhmuc&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>



        </td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_danhmuc&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" border="0" /></a></td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete_danhmuc&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten_vi']?>')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>

<a href="index.php?com=<?=$_GET['com']?>&act=add&type=<?=$_GET['type']?>" class="btn btn-info btn-flat  ">Thêm mới</a>
<a href="#" id="xoahet" class="btn  btn-danger btn-flat">Xóa</a>
<div class="paging"><?=$paging['paging']?></div>
</div>