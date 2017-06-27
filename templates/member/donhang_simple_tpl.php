<script src="assets/plugins/print/jQuery.print.js" type="text/javascript"></script>
<div id="print-ele" class="main-member-place">

<div class="global-title"><h2>Thông tin đơn hàng</h2><div class="clearfix"></div></div>

	<?php //check($rs_item)?>
	<div class="content" id="donhang-content">
	
	<div class="panel panel-default">
	
	  <div class="panel-body">
	  <section>
		<div class="">
			
			<div class="title-print"><label>Đơn hàng:</label>&nbsp;#<?=$rs_item['madonhang']?></div>
			<div class="title-print"><label>Ngày:</label>&nbsp;<?=date("d-m-y H:i:s")?></div>
			<?php
			$d->query("select * from #_tinhtrang order by id");
			$stmt=$d->result_array();
			$ttdh = array();
			foreach($stmt as $k2=>$v2){
				$ttdh[$v2['id']] = $v2['trangthai'];
			
			}
			?>
			<div class="title-print"><label>Trạng thái:</label>&nbsp;<?=$ttdh[$rs_item['tinhtrang']]?></div>
			</div>
			
			<div class="">
			
			
			</div>
			<div class="clearfix"></div>
		</section>
		<section>
			<div class="title-child">Thông tin giỏ hàng</div>
			<?=$rs_item['donhang']?>	
		
		</section>
		
		
		<section>
		
			<div class="title-child">Thông tin khách hàng</div>
			
			<div class="title-print"><label>Email:</label>&nbsp;<?=$rs_item['email']?></div>
			<div class="title-print"><label>Họ tên:</label>&nbsp;<?=$rs_item['hoten']?></div>
			<div class="title-print"><label>Địa chỉ:</label>&nbsp;<?=$rs_item['diachi']?></div>
			<div class="title-print"><label>Điện thoại:</label>&nbsp;<?=$rs_item['dienthoai']?></div>
			<div class="title-print"><label>Ghi chú:</label>&nbsp;<pre><?=$rs_item['noidung']?></pre></div>
		</section>
		
		<!--
		<section>
			<div class="title">Thanh toán đơn hàng</div>
		
		
		</section>
		-->
	</div>
	
	</div>
	
	
	
			
		
	</div>
	</div>

<?php
	

?>

<style>

</style>
<script>
$().ready(function(){
$("#print").click(function(){

	$('#print-ele').print({globalStyles:true,stylesheet:base_url+"/assets/css/style.css",iframe:true});
	return false

})
})
</script>
