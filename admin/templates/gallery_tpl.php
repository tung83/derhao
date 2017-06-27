<div class="tab-pane  " id="gallery" >
 <button id="add-image" class="btn-warning btn-normal btn btn-flat ">Thêm hình</button>
<p></p>
<div class="clearfix"></div>
<div class="col-xs-12">
<div id="gal-container">
<?php
	foreach(json_decode(@$item['gallery']) as $k=>$v){
	echo '<div class="form-group"><div class="col-sm-6 input-group"><span class="input-group-addon"><a onclick="viewFcb(\''.$k.'_x\');return false;" class="view_fcb" id="" href="">Xem hình</a></span><input type="text" name="photos[]" value="'.$v.'" class=" big form-control main-image" id="'.$k.'_x"><span class="input-group-btn"> <button type="submit" data-for="'.$k.'_x" class="show btn browser">Chọn</button></span><span class="input-group-btn"> <button class=" btn btn-primary " onclick="$(this).parent().parent().parent().remove();">Xóa</button></span></div></div>';
	}
?>	
</div><!-- end gal-container -->
</div>
	
<div class="clearfix"></div>
</div><!-- end #gallery -->

<script>
		$().ready(function(){
			
			$("#add-image").click(function(){
			$id = makeid();
			$content = '<div class="form-group form-group-sm"><div class="col-sm-6 input-group input-group-sm"><span class="input-group-addon"><a onclick="viewFcb(\''+$id+'\');return false;" class="view_fcb" id="" href="">Xem hình</a></span><input type="text" name="photos[]" value="" class="form-control main-image" id="'+$id+'"><span class="input-group-btn"> <button type="submit" data-for="'+$id+'" class="show btn browser btn-flat btn-primary">Chọn</button></span><span class="input-group-btn"> <button class=" btn btn-info btn-flat" onclick="$(this).parent().parent().parent().remove();">Xóa</button></span></div></div>';
			$("#gal-container").append($content);
			initBrowserServer();
			return false;
			})
			$(".add-image-option").click(function(){
				
				$parent = $(this).data("id");
				$id = makeid();
				$name = $(this).data("name");
				$content = '<div class="form-group form-group-sm"><div class="col-sm-6 input-group input-group-sm"><span class="input-group-addon"><a onclick="viewFcb(\''+$id+'\');return false;" class="view_fcb" id="" href="">Xem hình</a></span><input type="text" name="'+$name+'[]" value="" class="form-control main-image" id="'+$id+'"><span class="input-group-btn"> <button type="submit" data-for="'+$id+'" class="show btn browser">Chọn</button></span><span class="input-group-btn"> <button class=" btn btn-primary btn-flat" onclick="$(this).parent().parent().parent().remove();">Xóa</button></span></div></div>';
				$("#gal-container-option-"+$parent).append($content);
				initBrowserServer();
				return false;
			})
		})
		
		function viewFcb(obj){
				
			$href = base_url+$("#"+obj).val();

			$.fancybox({href:$href});
			return false;
		}
	</script>