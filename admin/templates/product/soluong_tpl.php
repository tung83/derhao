
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=number" enctype="multipart/form-data" class="form-horizontal " role="form" > 
	
  <input type="hidden" name="id" id="id" value="x" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" />
	<p></p>	
  <div class="col-xs-10">
  <div class="row">
  
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">
		
		<div class="form-group">
			
			<div class="col-sm-3">
			  <button  type="submit" class="btn btn-primary" id="add-pro">Thêm sản phẩm</button>
			</div>
			
			
			
		 </div>
		<?php
		
			foreach(json_decode($item['content']) as $k=>$v){
			?>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
			<div class="col-sm-3">
			  <input type="text" name="ten[]" value="<?=$v->ten?>" class="form-control " id="inputEmail3">
			</div>
			
			<label for="inputEmail3" class="col-sm-2 control-label">Số lượng</label>
			<div class="col-sm-3">
			  <input type="text" name="soluong[]" value="<?=$v->soluong?>" class="form-control " id="inputEmail3">
			</div>
			<button class="btn btn-warning" onclick="$(this).parent().remove();">Xóa</button>
			
		 </div>
			
			<?php
				
			}
			?>
		
		
		 
			
</div></div><!-- content-tab -->
</div><div class="clearfix"></div>
<!-- Tab panes -->

	
</form>
<script>
$().ready(function(){
	$("#add-pro").click(function(){
		$content = '<div class="form-group"><label for="inputEmail3" class="col-sm-2 control-label">Tên</label><div class="col-sm-3"><input type="text" name="ten[]" value="" class="form-control " id="inputEmail3"></div><label for="inputEmail3" class="col-sm-2 control-label">Số lượng</label><div class="col-sm-3"> <input type="text" name="soluong[]" value="" class="form-control " id="inputEmail3"></div><button class="btn btn-warning" onclick="$(this).parent().remove();">Xóa</button></div>';
		$("#tab-content").append($content);
		return false;	
	})
})

</script>