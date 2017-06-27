<div class="box-header with-border">
<h3>Thay đổi background</h3>
      </div>
	  <div class="box-body">
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save" enctype="multipart/form-data" class="form-horizontal " role="form" > 
	
  <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" />
	<p></p>	
  <div class="col-xs-10">
  <div class="row">
 
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">
	
	
		<div class="col-xs-6">
			
			
			 <div class="form-group">
					<label for="inputEmail3" class="col-sm-6 control-label">Type</label>
					<div class="col-sm-6">
						<input type="text" name="item[ten]" value="<?=@$item['ten']?>" class="form-control " readonly id="inputEmail3">
					  
					</div>
				 </div>
			<div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-6 control-label">Background attachment </label>
				  <div class="col-sm-6">
					<select name="item[attachment]" class="form-control">
						<?php 
							$arr = array("inherit","fixed","local","initial","scroll");
							foreach($arr as $k=>$v){
								$slt = "";
								if($item['attachment']==$v){
									$slt = "selected";
								}
								echo '<option '.$slt.' value="'.$v.'">'.$v.'</option>';
							}
						
						?>
					</select>	
					</div>
				
			 </div>
			 
			 
			 
			 <div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-6 control-label">Background repeat </label>
				    <div class="col-sm-6">
					<select name="item[repeat]" class="form-control">
						<?php 
							$arr = array("no-repeat","repeat","repeat-x","repeat-y");
							foreach($arr as $k=>$v){
								$slt = "";
								if($item['repeat']==$v){
									$slt = "selected";
								}
								echo '<option '.$slt.' value="'.$v.'">'.$v.'</option>';
							}
						
						?>
					</select>	
					</div>
				
			 </div>
			 
			 
			 
			  <div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-6 control-label">Background position </label>
				    <div class="col-sm-6">
					<select name="item[position]" class="form-control">
						<?php 
							$arr = array("left top","left center","left bottom","right top","right center","right bottom","center top","center center","center bottom");
							foreach($arr as $k=>$v){
								$slt = "";
								if($item['position']==$v){
									$slt = "selected";
								}
								echo '<option '.$slt.' value="'.$v.'">'.$v.'</option>';
							}
						
						?>
					</select>	
					</div>
				
			 </div>
			 
			  <div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-6 control-label">Background color </label>
				    <div class="col-sm-6">
						<input type="text" name="item[color]" class="form-control colorpicker" value="<?=$item['color']?>" />
					</div>
				
			 </div>
			 
			<div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-6 control-label">Background image </label>
				    <div class="col-sm-6">
						<input type="file" name="file" class="form-control"/>
				  
					</div>
				
			 </div>
			 <?php if(isset($_GET['id'])){?>
			 <div class="form-group">
			 <label for="inputEmail3" class="col-sm-6 control-label"></label>
				<a class="fancybox"  href="<?=_upload_hinhanh.@$item['photo']?>" ><img  id="main-image" src="<?=_upload_hinhanh.@$item['photo']?>" class="col-xs-4" /></a>
				
			</div>	
				<?php } ?>
			 
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-6  control-label">Background type </label>
					 <div class="col-sm-6">
						<select name="item[type]" class="form-control">
						<?php 
							$arr = array("color","image","color - background");
							foreach($arr as $k=>$v){
								$slt = "";
								if($item['type']==$v){
									$slt = "selected";
								}
								echo '<option '.$slt.' value="'.$v.'">'.$v.'</option>';
							}
						
						?>
						</select>
						  
					</div>
				 </div>
			 
			 
				
			<p></p>	
			
			  
		 </div>
	
	 
	 
	 <div class="clearfix"></div>
	
	

		
		
		<div class="clearfix"></div>
		
		
		
		<div class="clearfix"></div>
		 </div>

	
	
	</div>	
</div><!-- content-tab --><div class="clearfix"></div>
<!-- Tab panes -->

	
</form>