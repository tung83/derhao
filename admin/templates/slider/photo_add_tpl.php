<div class="box-header with-border">
<h3>Hình ảnh</h3>
</div>
<div class="box-body">


<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save_photo&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="nhaplieu">	
<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man_photo&type=<?=$_GET['type']?>'" class="btn btn-warning" />
	<p></p>
<div class="row">	
  <?php for($i=0; $i<6; $i++){?>
	<div class="col-xs-12 col-sm-6">
		
			<div class="form-group">
			  <label for="exampleInputEmail1">Tên</label>
			  <input type="text" class="form-control" id="exampleInputEmail1" name="ten<?=$i?>" placeholder="">
			</div>
			<div class="form-group">
			  <label for="exampleInputPassword1">Url</label>
			  <input type="text" class="form-control link" id="exampleInputPassword1" name="link<?=$i?>" placeholder="">
			</div>
			<div class="form-group">
			 <label for="exampleInputPassword1">Mô tả</label>
			<div class="clearfix"></div>
			<div class="">
			  <textarea name="mota<?=$i?>" class="form-control" id="inputEmail3"></textarea>
			</div>
		</div>
			<div class="form-group">
			  <label for="exampleInputFile">Upload file</label>
			  <input type="file" name="file<?=$i?>" id="exampleInputFile">
			  <p class="help-block red">Hình có kích thước:  Width <?=$sl_size[$_GET['type']]['w']?> px - Height:<?=$sl_size[$_GET['type']]['h']?> px</p>
			</div>
			<div class="form-group">
			  <label for="exampleInputPassword1">Số thứ tự</label>
			  <input type="text" class="form-control w-120" id="exampleInputPassword1" name="stt<?=$i?>" placeholder="">
			</div>
			<div class="checkbox">
                      <label>
                        <input type="checkbox" name="hienthi<?=$i?>" checked> Hiển thị
                      </label>
                    </div>
			<hr />
	</div>
	
	
<? }?>
</div>
	
</form>
</div>