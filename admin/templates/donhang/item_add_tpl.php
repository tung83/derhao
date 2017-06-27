<?php

function tinhtrang($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_font">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	?>
	<div class="box-header with-border">
<h3>Chi tiết đơn hàng</h3>
      </div>
	  <div class="box-body">


<form name="frm" method="post" action="index.php?com=order&act=save" enctype="multipart/form-data" class="nhaplieu" id="xf">
<?php 
unset($item['chitiet']);


?>
<div class="row">
<div class="col-xs-6">
<h3>Người thanh toán</h3>
<table class="table-bordered table">
	<tr>
		<td>
			Mã đơn hàng
		</td>
		<td>
			<strong><?=@$item['madonhang']?></strong>
		</td>
<tr>		
    <td>Họ tên</td><td></b><strong><?=@$item['hoten']?></strong></td></tr>
   <tr>     <td>Điện thoại: </td><td><strong><?=@$item['dienthoai']?></strong></td>	</tr>	  
     <tr>   <td>Email: </td><td><strong><?=@$item['email']?></strong></td>	</tr>	  
    <tr>   <td>     Địa chỉ:</td><td><strong><?=@$item['diachi']?></strong>	</td></tr>  
			
</table>	
</div>


<div class="col-xs-6">
<h3>Người nhận hàng</h3>
<table class="table-bordered table">
	
    <td>Họ tên</td><td></b><strong><?=@$item['receive_name']?></strong></td></tr>
   <tr>     <td>Điện thoại: </td><td><strong><?=@$item['receive_phone']?></strong></td>	</tr>	  
     <tr>   <td>Email: </td><td><strong><?=@$item['receive_email']?></strong></td>	</tr>	  
    <tr>   <td>     Địa chỉ:</td><td><strong><?=@$item['receive_address']?></strong>	</td></tr>  
			
</table>	
</div>

</div>		
    <div>
    
	<?php 
		echo @$item['donhang'];
	
	?>

	

    
    
  </div>
	
	<?php 
		$d->query("select * from #_hinhthucthanhtoan where id = '".$item['hinhthucthanhtoan']."'");
		$httt = $d->fetch_array();
		
		$d->query("select * from #_hinhthucvanchuyen where id = '".$item['hinhthucvanchuyen']."'");
		$htvc = $d->fetch_array();
		
	
	?>
	<div><b>Hình thức thanh toán: <?=$httt['ten_vi']?> </div><br />
	<div><b>Hình thức vận chuyển: <?=$htvc ['ten_vi']?> - <?=myformat($htvc['gia'])?></b></div><br />
	<div><b>Tổng số tiền thanh toán: <span class="red"><?=myformat($item['tonggia'])?></span></b></div><br />
     <b>Tình trạng</b><?=tinhtrang($item['tinhtrang'])?><br/></br>
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=order&act=man'" class="btn" />
</form>
<script src="assets/js/jquery.inlineStyler.min.js"></script>
<script>
	$().ready(function(){
		//$("#xf").inlineStyler( );
	})

</script>

</div></div>