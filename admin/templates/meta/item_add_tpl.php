
<div class="box-header with-border">
	<h3> Cập nhật meta cho website</h3>
</div>
<div class="box-body">

<form name="frm" method="post" action="index.php?com=meta&act=save" enctype="multipart/form-data" class="nhaplieu">
<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php'" class="btn btn-warning" />
	<p></p>
	
					<div class="form-group">
						<label for="exampleInputEmail1">Title</label>
						<input type="text" class="form-control" id="exampleInputEmail1" name="title" value="<?=$item['title']?>" placeholder="" required>
						
						</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Keyword</label>
						<textarea name="keyword" id="ten" cols="45" class="form-control" rows="5" required><?=@$item['keyword']?></textarea>
                      
						</div>
						<div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
					<textarea name="description" id="ten" cols="45" class="form-control" rows="5" required	><?=@$item['description']?></textarea>
                      
                    </div>
	
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	
</form>
</div>