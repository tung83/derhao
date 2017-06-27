<div class="tab-pane  " id="seo" >
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề</label>
			<div class="col-sm-10">
			  <input type="text" name="seo_title" value="<?=@$item['seo_title']?>" class="form-control " id="inputEmail3">
			</div>
		 </div>
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Từ khóa</label>
			<div class="col-sm-10">
			  <textarea  name="seo_keyword" class="form-control" id="inputEmail3" ><?=@$item['seo_keyword']?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
			<div class="col-sm-10">
			  <textarea  name="seo_description" class="form-control" id="inputEmail3" ><?=@$item['seo_description']?></textarea>
			</div>
		</div>
	 
	 </div>