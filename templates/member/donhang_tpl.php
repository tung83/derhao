<script src="assets/jquery-ui-1.11.0.custom/jquery-ui.min.js" type="text/javascript"></script>
<link href="assets/jquery-ui-1.11.0.custom/jquery-ui.min.css" type="text/css" rel="stylesheet" />
<link href="assets/jquery-ui-1.11.0.custom/jquery-ui.theme.min.css" type="text/css" rel="stylesheet" />
<link href="assets/css/member/style.css" type="text/css" rel="stylesheet">
<div class="main-member-place">
	
	<div class="global-title"><h2>Đơn hàng</h2><div class="clearfix"></div></div>
	<div class="content">
	
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title">Tất cả đơn hàng</h3>
	  </div>
	  <div class="panel-body">
			<table class="table table-bordered">
				<thead>
					<th>#ID</th>
					<th>Trạng thái</th>
					<th>Sản phẩm</th>
					<th>Ngày</th>
					<th>Tổng cộng</th>
					
				
				</thead>
				<tbody>
					<?php
						$d->query("select * from #_tinhtrang order by id");
						$stmt=$d->result_array();
						$ttdh = array();
						foreach($stmt as $k2=>$v2){
							$ttdh[$v2['id']] = $v2['trangthai'];
						
						}
						foreach($rs_donhang as $k=>$v){
							//	check($v);
							$rs_js = json_decode($v['chitiet']);
							//check($rs_js);
							$pr = "";
							
							$pr = " <b>".$rs_js->maso."</b>";
							foreach($rs_js as $k2=>$v2){
								
								$pr.="<div><a href='san-pham/".$v2->id."/".$v2->tenkhongdau.".html' target='blank'>".$v2->ten_vi."</a></div>";
							}
							
							echo '<tr>';
							echo '<td><strong><a href="thanh-vien/don-hang/'.$v['id'].'.html">'.$v['madonhang'].'</a></strong></td>';
							
							echo '<td>'.$ttdh[$v['tinhtrang']].'</td>';
							
							echo '<td>'.$pr.'</td>';
							
							echo '<td>'.date("d-m-Y",$v['ngaytao']).'</td>';
							
						
							
							echo '<td>'.myformat($v['tonggia']).'</td>';
							
							
							
							echo '</tr>';
						
						
						
						}
					
					
					
					
					
					
					?>
				
				
				</tbody>
			</table>
			
	</div>
	
	</div>
	
	
	<!-- 
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title"><?=_search?></h3>
	  </div>
	  <div class="panel-body">
			
			
			
			
			
			
			
			
			<form class="form-horizontal" role="form" id="form-cart">
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tổng cộng</label>
				<div class="col-sm-2">
					
				  <input type="text" class="form-control input-sm" id="inputEmail3" name="pf" placeholder="">
					
				</div>
				<div class="pull-left">
					
					-
					
				</div>
				<div class="col-sm-2">
					
				  <input type="text" class="form-control input-sm" id="inputEmail3" name="pt" placeholder="">
					
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Thời gian</label>
				<div class="col-sm-4">
				  <select name="period" class='form-control input-sm' id="period_selects">
					<option value="A" selected="selected">Tất cả</option>
					<optgroup label="=============">
					<option value="D">Hôm nay</option>
					<option value="W">Tuần này</option>
					<option value="M">Tháng này</option>
					<option value="Y">Năm nay</option>
					</optgroup>
					<optgroup label="=============">
					<option value="LD">Hôm qua</option>
					<option value="LW">Tuần trước</option>
					<option value="LM">Tháng trước</option>
					<option value="LY">Năm ngoái</option>
					</optgroup>
					<optgroup label="=============">
					<option value="HH">24 giờ trước</option>
					<option value="HW">7 ngày trước</option>
					<option value="HM">30 ngày trước</option>
					</optgroup>
					<optgroup label="=============">
					<option value="C">Khác...</option>
					</optgroup>
					</select>
				</div>
			  </div>
			  
			  
			   <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Chọn ngày</label>
				<div class="col-sm-2">
					<div class="input-group input-group-sm">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input type="text" class="form-control input-sm form hasDatepicker" id="datepicker2" value=""  name="df">
					</div>
				  
					
				</div>
				<div class="pull-left">
					
					-
					
				</div>
				<div class="col-sm-2">
					<div class="input-group input-group-sm">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input type="text" class="form-control input-sm to hasDatepicker" id="datepicker" value=""  name="dt">
					</div>
				  
					
				</div>
				
			  </div>
			  
			  
			  
			  
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Mã đơn hàng</label>
						<div class="col-sm-4">
						<input type="text" class="form-control input-sm birth hasDatepicker" id="datepicker" value=""  name="code">
						</div>
					</div>
				  
			
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-default btn-timkiem"><?=_search?></button>
				</div>
			  </div>
			</form>
			
			
			
			
			
			
			
			
			
			
			
		
		
		
	  </div>
	</div> -->
	
			
		
	</div>
</div>	

<?php
	

?>

<style>
.main-member-place .content{
	margin-top:10px;
}
.btn-timkiem{
background: rgb(143,196,0); /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzhmYzQwMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM4ZmM0MDAiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(143,196,0,1) 0%, rgba(143,196,0,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(143,196,0,1)), color-stop(100%,rgba(143,196,0,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(143,196,0,1) 0%,rgba(143,196,0,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(143,196,0,1) 0%,rgba(143,196,0,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(143,196,0,1) 0%,rgba(143,196,0,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(143,196,0,1) 0%,rgba(143,196,0,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8fc400', endColorstr='#8fc400',GradientType=0 ); /* IE6-8 */
font-weight:bold;
font-size:15px;
color:#fff;
text-shadow:none;


}


</style>
<script>
$().ready(function(){
$(".birth").datepicker({"dateFormat":"dd-mm-yy",yearRange: "-100:+0", changeMonth: true,
changeYear: true,});
$("#form-cart").submit(function(){
	$url = "thanh-vien/don-hang.html&"+$(this).serialize();
	window.location.href=$url;
	return false;



})
})
</script>
