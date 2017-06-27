<div class="box-header with-border">
<h3> Cập nhật cấu hình</h3>
</div>

<div class="box-body">


<div id="google_analytics"></div>
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save" enctype="multipart/form-data" class="form-horizontal " role="form" > 

  <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<?php if($com!="about") {?><input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" /><?php } ?>
	<p></p>	
  <div class="col-xs-12">
  <div class="row">
  
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">

	
	
		

	 <div class="clearfix"></div>

	<?php $v="shit";?>
	
	

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Web bảo trì</label>
			<div class="col-sm-9">
				
			  <label class="radio-inline">
				  <input type="radio"  name="setting[site_maintenance]" value ="1" <?=(!$item['site_maintenance']) ? '' : 'checked'?> id="inlineRadio1" value="option1"> Yes
				</label>
				<label class="radio-inline">
				  <input type="radio" name="setting[site_maintenance]" value ="0" <?=($item['site_maintenance']) ? '' : 'checked'?> id="inlineRadio2" value="option2"> No
				</label>
			</div>
		 </div>
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Nội dung bảo trì</label>
			<div class="col-sm-9">
			 <textarea  name="setting[site_maintenance_message]" class="form-control  editor" id="site_maintenance_message" required><?=$item['site_maintenance_message']?></textarea>
			</div>
		 </div>
		 
		 
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Ngôn ngữ mặc định</label>
			<div class="col-sm-9">
				<?php 
					
					foreach($config['AllLang_fix'] as $k=>$v){
							if(in_array($k,$config['lang'])){
								echo '<label class="radio-inline">';
								echo '<input type="radio" name="setting[default_lang]" value="'.$k.'" '.(($item['default_lang'] == $k) ? 'checked' : '').' id="inlineRadio1" value="option1">';
								echo $v;
								echo '</label>';
							}
					
					}
					
				
				
				?>
			  
			</div>
		 </div>
		 
		 
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Hiển thị hotline</label>
			<div class="col-sm-9">
				
			  <label class="radio-inline">
				  <input type="radio"  name="setting[visible_hotline]" value ="1" <?=(!$item['visible_hotline']) ? '' : 'checked'?> id="inlineRadio1" value="option1"> Yes
				</label>
				<label class="radio-inline">
				  <input type="radio" name="setting[visible_hotline]" value ="0" <?=($item['visible_hotline']) ? '' : 'checked'?> id="inlineRadio2" value="option2"> No
				</label>
			</div>
		 </div> 
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Phân trang sản phẩm</label>
			<div class="col-sm-9">
			  <input type="text" name="setting[product_paging]" value="<?=@$item['product_paging']?>" class="form-control "  required id="inputEmail3">
			</div>
		 </div>
		 
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Phân trang tin tức</label>
			<div class="col-sm-9">
			  <input type="text" name="setting[news_paging]" value="<?=@$item['news_paging']?>" class="form-control " required id="inputEmail3">
			</div>
		 </div>
		 
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Gửi email liên hệ</label>
			<div class="col-sm-9">
			  <input type="email" name="setting[email_contact]" value="<?=@$item['email_contact']?>" class="form-control" required  id="inputEmail3">
			</div>
		 </div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Mẫu email liên hệ</label>
			<div class="col-sm-9">
				
			 <textarea  name="setting[email_contact_form]" class="form-control  editor" id="email_contact_form" required><?=$item['email_contact_form']?></textarea>
			<span class="help-block red">
				[<b>{%website}</b> : Website gủi]<br />[<b>{%name}</b> họ tên khách hàng]<br />[<b>{%address}</b> địa chỉ khách hàng]<br />[<b>{%email}</b>email khách hàng]<br />[<b>{%phone}</b>điện thoại khách hàng]<br />[<b>{%date}</b> ngày gửi thông tin]<br />[<b>{%title}</b> tiêu đề liên hệ]<br />[<b>{%content}</b> nội dung liên hệ]
			</span>
			</div>
		 </div>
		
		 
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Google Analytics</label>
			<div class="col-sm-9">
				
			 <textarea  name="setting[google_analytics]" class="form-control code" style="height:175px" id="google_analytics" ><?=$item['google_analytics']?></textarea>
			
			</div>
			
		 </div>
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Code top</label>
			<div class="col-sm-9">
				
			 <textarea  name="setting[meta_top]" class="form-control"  style="height:175px" id="meta_top" ><?=$item['meta_top']?></textarea>
			
			</div>
		 </div>
		 
		 
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Code bottom</label>
			<div class="col-sm-9">
				
			 <textarea  name="setting[meta_bottom]" class="form-control" style="height:175px" id="meta_bottom" ><?=$item['meta_bottom']?></textarea>
			
			</div>
		 </div>
		
		<div class="clearfix"></div>
		 </div>
	
	

</div></div><!-- content-tab --><div class="clearfix"></div>
<!-- Tab panes -->

	
</form>
</div>
