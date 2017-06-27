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
<div id="print-ele">
<h3>Quản lý thành viên</h3>
 


<div class="clearfix"></div>
<br />


<table class=" table table-bordered">
	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th style="width:5%;">Stt</th>		
		<th style="width:10%;">Tên  </th>
		<th style="width:10%;">Email  </th>
	
		<!--<th style="width:10%;">Loại</th>
		 <th style="width:10%;">Cấp</th> -->
		<!-- <th style="width:10%;">Số tiền</th> -->
		<th style="width:10%;">Kích hoạt</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr bgcolor="<?php if($i%2==1)echo '#F3F3F3' ?>">
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td style="width:5%;"><?=($i+1)?></td>
		<td style="width:15%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id_danhmuc=<?=$items[$i]['id_danhmuc']?>&id_list=<?=$items[$i]['id_list']?>&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['email']?></a></td>
		<td style="width:15%;"><?=@$items[$i]['email']?></td>
		
		 <td class="hide" style="width:6%;" align="center"><?=(($items[$i]['type']==1) ? 'Đăng tin ' : 'Tuyển dụng')?></td>
		 <!-- <td>
		<?php /*getMemberLevel($items[$i]['type'],$items[$i]['diemtichluy'])*/?>
		</td>-->
		<!-- <td>
		<?=myformat($items[$i]['diemtichluy'])?>
		</td>
        -->
		<td style="width:5%;">
		<?php 
		if(@$items[$i]['isActive']==1)
		{
		?>
        
        <a href="index.php?com=<?=$_GET['com']?>&act=man&isActive=<?=$items[$i]['id']?><?php if(@$_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png" border="0" /></a>
		<? 
		}
		else
		{
		?>
         <a href="index.php?com=<?=$_GET['com']?>&act=man&isActive=<?=$items[$i]['id']?><?php if(@$_REQUEST['curPage']!='') echo'&curPage='. @$_REQUEST['curPage'];?>"><img src="media/images/active_0.png"  border="0"/></a>
         <?php
		 }?>     
        </td> 
        
        
        
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id_danhmuc=<?=$items[$i]['id_danhmuc']?>&id_list=<?=$items[$i]['id_list']?>&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" /></a></td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten_vi']?>')) return false;"><img src="media/images/delete.png" /></a></td>
	</tr>
	<?php	}?>
    </table>
<a href="index.php?com=<?=$_GET['com']?>&act=add"><img src="media/images/add.jpg" border="0"  /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>
</div>
<div class="paging"><?=$paging['paging']?></div>