<div class="tab-pane  " id="gallery2" >
 <button id="add-image2" class="btn-warning btn-normal btn btn-flat ">Thêm hình</button>
<p></p>
<div class="clearfix"></div>
<div class="col-xs-12">
<div id="gal-container2">




<?php 
	$is = json_decode($item['gallery2'],true);
	
	foreach($is as $k=>$v){
		
		$id = md5(rand(0,999999999));
		?>
		<div class="oz-ms-content" style="padding:5px;border:1px solid #ccc;margin:5px " data-id="<?=$id?>">
		<button onclick="addMoreImage($(this));return false;" class="btn-warning btn-normal btn btn-flat btn-sm">Thêm hình</button>
		<?php
			foreach($v as $k2=>$v2){
				
				$id2 = md5($id).rand(0,9999999);
				
				
				?>
		
		<div class="col-xs-12">
		<div class="am">
		
		<div class="form-group form-group-sm"><div class="col-sm-6 input-group input-group-sm"><span class="input-group-addon"><a onclick="viewFcb('<?=$id2?>');return false;" class="view_fcb" id="" href="">Xem hình</a></span><input type="text" name="photos2x[<?=$id?>][]" value="<?=$v2['photo']?>" class="form-control main-image" id="<?=$id2?>"><input type="text" name="desc2x[<?=$id?>][]" value="<?=$v2['desc']?>" class="form-control" id=""><span class="input-group-btn"> <button type="submit" data-for="<?=$id2?>" class="show btn browser btn-flat btn-primary">Chọn</button></span><span class="input-group-btn"> <button class=" btn btn-info btn-flat" onclick="$(this).parent().parent().parent().remove();">Xóa</button></span></div></div></div>
		</div>
		<div class="clearfix"></div>
			<?php }  ?>
		</div>
	<?php 
		
		
	}
?>




</div><!-- end gal-container2 -->
</div>
	
<div class="clearfix"></div>


<div id="gallery-group">
	
	<button id="add-o">Thêm danh sách hình</button>
	
	
	
	<div class="inner-gallery-group">
	
	
	</div>
	<div class="hide">
		
	
	
	</div>
	<div class="hide">
	<div class="oz-ms-content" style="padding:5px;border:1px solid #ccc;margin:5px ">
		<button onclick="addMoreImage($(this));return false;" class="btn-warning btn-normal btn btn-flat ">Thêm hình</button>
		<div class="col-xs-12">
		<div class="am">
		
		</div>
		</div>
		<div class="clearfix"></div>
	</div>
	</div>
	<script>
	
		$().ready(function(){
		$("#add-o").click(function(){
			$id = makeid();
			$content = $(".hide .oz-ms-content").clone();
			$content.attr("data-id",$id);
			$("#gallery-group .inner-gallery-group").append($content);
			return false;
			
			
		})
		
		
		
		
		})
	function addMoreImage($obj){
			$parent = $obj.parent();
			$id = $obj.parent().data("id");
			$id2 = makeid();
			$content = '<div class="form-group form-group-sm"><div class="col-sm-6 input-group input-group-sm"><span class="input-group-addon"><a onclick="viewFcb(\''+$id2+'\');return false;" class="view_fcb" id="" href="">Xem hình</a></span><input type="text" name="photos2x['+$id+'][]" value="" class="form-control main-image" id="'+$id2+'"><input type="text" name="desc2x['+$id+'][]" value="" class="form-control" id=""><span class="input-group-btn"> <button type="submit" data-for="'+$id2+'" class="show btn browser btn-flat btn-primary">Chọn</button></span><span class="input-group-btn"> <button class=" btn btn-info btn-flat" onclick="$(this).parent().parent().parent().remove();">Xóa</button></span></div></div>';
			$parent.find(".am").append($content);
			initBrowserServer();
			return false;
		}	
	</script>










</div>






</div><!-- end #gallery -->

