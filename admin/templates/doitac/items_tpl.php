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
<h3><a href="index.php?com=<?=$_GET['com']?>&act=add">Thêm </a></h3>

<table class=" table table-bordered">

	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th width="5%" style="width:6%;">Stt</th>
		
        <th style="width:27%;">Tên </th>
		<th style="width:15%;">Danh mục cấp 1</th>
		
		
	  <th width="12%" >Hiển thị</th>
		<th width="9%">Sửa</th>
		<th width="9%" >Xóa</th>
	</tr>
    
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td  align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td  align="center"><?=$items[$i]['stt']?></td>
       <td align="center"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten_vi']?></a></td>
       <td align="center">
        	<?php
			$sql_danhmuc="select ten_vi from table_doitac_danhmuc where id='".$items[$i]['id_danhmuc']."'";
			$result=mysql_query($sql_danhmuc);
	 		$item_danhmuc =mysql_fetch_array($result);
	 		echo @$item_danhmuc['ten_vi'];
			?>  
        </td>
		
		<!-- <td style="width:40%;" align="center"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten_en']?></a></td> -->
		
		<td style="width:6%;">
        
        
		
		<?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>
        <a href="index.php?com=<?=$_GET['com']?>&act=man&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
		<? 
		}
		else
		{
		?>
         <a href="index.php?com=<?=$_GET['com']?>&act=man&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>        </td>
		<td style="width:6%;" align="center"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png"  border="0"/></a></td>
		<td style="width:6%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>
<a href="index.php?com=<?=$_GET['com']?>&act=add"><img src="media/images/add.jpg" border="0"  /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>