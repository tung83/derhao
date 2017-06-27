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
	if (hoi==true) document.location = "index.php?com=order&act=delete&listid=" + listid;
});
});
</script>
<div class="box-header with-border">
<h3>Quản lý đơn hàng</h3>
      </div>
	  <div class="box-body">

<table class="table table-bordered">

	<tr>
    	<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
    	<th style="width:5%" align="center">ID</th>
		<th style="width:10%;">Mã đơn hàng</th>	
        <th style="width:20%;">Họ tên</th>
        <th style="width:20%;">Ngày đặt</th>
        <th style="width:10%;">Số tiền</th>
       <th style="width:15%;">Tình trạng</th>     
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</tr>
    
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
    	<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
		<td style="width:5%;" align="center"><?=$items[$i]['id']?></td>
        <td style="width:10%;" align="center"><?=$items[$i]['madonhang']?></td>       
		<td style="width:20%;" align="center"><a href="index.php?com=order&act=edit&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['hoten']?></a></td>
		  <td style="width:20%;" align="center"><?=date('d/m/Y',$items[$i]['ngaytao'])?></td>          
           <td style="width:10%;" align="center"><?=number_format($items[$i]['tonggia'],0, ',', '.')?>&nbsp;VNĐ</td>
           <td style="width:15%;" align="center">
		   <?php 
		   		$sql="select trangthai from #_tinhtrang where id= '".$items[$i]['tinhtrang']."' ";
				$d->query($sql);
				$result=$d->fetch_array();
				echo $result['trangthai'];
		   ?>
           
           </td>         
		<td style="width:5%;" align="center"><a href="index.php?com=order&act=edit&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png"  border="0"/></a></td>
		<td style="width:5%;"><a href="index.php?com=order&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>
<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>
</div>