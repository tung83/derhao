<div class="box-header with-border">
	<h3><?=($act=='add') ? 'Thêm' : 'Sửa'?></h3>
</div>
<div class="box-body">

<form name="frm" method="post" action="index.php?com=yahoo&act=save" enctype="multipart/form-data" class="nhaplieu">
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" />
	<p></p>	
	<div class="form-group">
	  <label for="exampleInputEmail1">Tên</label>
	  <input type="text" name="ten" class="form-control" id="exampleInputEmail1" value="<?=@$item['ten']?>">
	</div>
	<div class="form-group">
	  <label for="exampleInputEmail1">Skype</label>
	  <input type="text" name="skype" class="form-control" id="exampleInputEmail1" value="<?=@$item['skype']?>">
	</div>
	<div class="form-group">
	  <label for="exampleInputEmail1">Điện thoại</label>
	  <input type="text" name="dienthoai" class="form-control" id="exampleInputEmail1" value="<?=@$item['dienthoai']?>">
	</div>
	<!--
	<div class="form-group">
	  <label for="exampleInputEmail1">Yahoo</label>
	  <input type="text" name="yahoo" class="form-control" id="exampleInputEmail1" value="<?=@$item['yahoo']?>">
	</div>
	
	
	
	<div class="form-group">
	  <label for="exampleInputEmail1">Email</label>
	  <input type="text" name="email" class="form-control" id="exampleInputEmail1" value="<?=@$item['email']?>">
	</div>
	-->
	
	<div class="form-group">
	  <label for="exampleInputEmail1">Số thứ tự</label>
	  <input type="text" name="stt" class="form-control w-120" id="exampleInputEmail1" value="<?=isset($item['stt'])?$item['stt']:$stt?>">
	</div>
	<div class="checkbox">
	  <label>
		<input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>> Hiển thị
	  </label>
	</div>
</form>
</div>