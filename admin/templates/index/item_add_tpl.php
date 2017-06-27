<div class="box-header with-border">

</div>
<div class="box-body">
<?php
function get_main_item()
	{
		$sql_huyen="select * from table_news_item order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item"">			
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
?>
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save" enctype="multipart/form-data" class="form-horizontal " role="form" > 
	<!--<b>Danh mục bài viết:</b><?=get_main_item();?><br /><br />-->
  <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" />
	<p></p>	
  <div class="col-xs-10">
  <div class="row">
  
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">
	<?php if($_GET['com']!='hd'){?>
	<div class="col-xs-6">
		<div class="col-xs-12">
			<div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-4 control-label">Hình ảnh</label>
				   <div class="input-group">
				 <input type="file" name="file" />
				  
				</div>
				<?php if(isset($_GET['id'])){?>
				<a class="fancybox"  href="<?=_upload_tintuc.@$item['photo']?>" ><img  id="main-image" src="<?=_upload_tintuc.@$item['photo']?>" class="col-xs-4" /></a>
				<?php } ?>
			 </div>
			 
			 
			 
			 
			 
			 <div class="form-group form-group-sm">			
				<label for="" class="col-sm-4 control-label">Loại:</label> <div class="col-sm-6">
					<select id="id_type" required="" class="form-control col-sm-6 " name="id_type">
							<option value="">--Chọn--</option>
							<?php 
								
								$ar = array("1"=>"Sản phẩm","2"=>"Vải");
								foreach($ar as $k=>$v){
									$slt = "";
									if($k==@$item['id_type']){
										$slt = "selected";
									}
									
									
									echo '<option '.$slt.' value="'.$k.'">'.$v.'</option>';
								}
								
								
							?>
			
			
					</select></div></div>
		 </div>
	 </div>
	 <div class="col-xs-6 align-left">
		<div class="col-xs-12">
			 <div class="checkbox">
				<label>
				  <input type="checkbox"  name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>> Hiển thị
				</label>
			  </div>
			  
			  <div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 align-left control-label">Số thứ tự</label>
					<div class="col-sm-8">
					  <input type="text" name="stt"  value="<?=(@$stt) ? $stt : @$item['stt']?>" class="form-control w-120 " id="inputEmail3">
					</div>
				 </div>
			</div>	 
			</div>
			
			
			<?php 
			$d->query("select districtid,name,provinceid,type from #_district");
								$arr = array(); 
								
								foreach($d->result_array() as $k=>$v){
									$arr[$v['provinceid']][] = $v;
 								}
								echo '<script>';
								foreach($arr as $k=>$v){
									echo 'var _district_'.$k.' = '.json_encode($v).';';
								}
								echo '</script>';
								?>
			<div class="form-group form-group-sm">			
				<label for="" class="col-sm-4 control-label">Tỉnh thành:</label> <div class="col-sm-6">
					<select id="id_province" required="" class="form-control col-sm-6 " name="id_province">
							<option value="">--Chọn--</option>
							<?php 
								
								$d->query("select provinceid,name from #_province");
								foreach($d->result_array() as $k=>$v){
									$slt = "";
									if($item['id_province']==$v['provinceid']){
										$slt = "selected";
									}
									echo '<option '.$slt.' value="'.$v['provinceid'].'">'.$v['name'].'</option>';
								}
							
							?>
			
			
					</select></div></div>
					
					
				<div class="form-group form-group-sm">
			
				<label for="" class="col-sm-4 control-label">Quận huyện:</label> <div class="col-sm-6">
					<select id="id_district" required="" class="form-control col-sm-6 " name="id_district">
							<option value="">--Chọn--</option>
							
			
					</select></div></div>	
					
					
					
			
			<script>
				$().ready(function(){
					
					var id_district = <?=(int)$item['id_district']?>;
					$("#id_province").change(function(){
						_list = eval("_district_"+$(this).val());
						$("#id_district option:not(:first)").remove();
						$.each(_list,function(index,item){
							slt = '';
							if(id_district == item.districtid){
								slt = "selected";
							}
							$("#id_district").append("<option "+slt+" value='"+item.districtid+"'>"+item.type+" "+item.name+"</option>");
						})
					})
					$("#id_province").trigger("change");
				})
			
			</script>
			
			
			
			
			
			
			
		 </div>
	 </div>
	 <?php } ?>
	 	  <div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 align-left control-label">Địa chỉ</label>
					<div class="col-sm-8">
					  <input type="text" name="address"  value="<?=@$item['address']?>" class="form-control " id="inputEmail3">
					
					</div>
				 </div>
			</div>	 
			</div>
			
			<div class="col-xs-12">
			  <div class="row">
			  
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 align-left control-label">Tọa độ</label>
					<div class="col-sm-8">
					  <input type="text" name="lat"  value="<?=@$item['lat_']?>,<?=@$item['long_']?>" class="form-control " id="inputEmail3">
					</div>
				 </div>
			</div>	 
			</div>
			
			<div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 align-left control-label">Thời gian hoạt động</label>
					<div class="col-sm-8">
					  <input type="text" name="active_time"  value="<?=@$item['active_time']?>" class="form-control " id="inputEmail3">
					
					</div>
				 </div>
			</div>	 
			</div>
			
			<div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 align-left control-label">Điện thoại</label>
					<div class="col-sm-8">
					  <input type="text" name="phone"  value="<?=@$item['phone']?>" class="form-control " id="inputEmail3">
					
					</div>
				 </div>
			</div>	 
			</div>
			
			
	 <div class="clearfix"></div>
	
	<ul class="nav nav-tabs">
	<?php
		foreach($config['lang'] as $k=>$v){
			$act = '';
			if($k==0){
				$act = "active";
			}
			
			echo '<li class="'.$act.'"><a href="#'.$v.'" data-toggle="tab"><strong>'.$config['AllLang'][$v].'</strong></a></li>';
			
		}
	?>
	
	</ul>

	<div class="tab-content">
	
	<?php
		foreach($config['lang'] as $k=>$v){?>
			
		<?php $act = ''; if($k==0){ $act = 'active'; }?>
		
		 <div class="tab-pane  <?=$act?>" id="<?=$v?>" >
		<?php if($_GET['com']!='hd'){?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề</label>
			<div class="col-sm-10">
			  <input type="text" name="ten_<?=$v?>" value="<?=@$item['ten_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
			<div class="col-sm-10">
				<textarea class="form-control" name="noidung_<?=$v?>"><?=@$item['noidung_'.$v]?></textarea>
			  
			</div>
		 </div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Đường dẫn</label>
			<div class="col-sm-10">
			  <input type="text" name="mota_<?=$v?>" value="<?=@$item['mota_'.$v]?>" class="form-control link" id="inputEmail3">
			</div>
		</div>
		<div class="form-group hide">
			<label for="inputEmail3" class="col-sm-2 control-label">Vị trí</label>
			<div class="col-sm-3">
			  <select name="location" class="form-control form-control-sm" required>
			  <option value="1" selected></option>
				<!--<option value="">Chọn vị trí</option>
				<option value="1" <?=((@$item['location']==1) ? 'selected' : '')?>>Trên</option>
				<option value="2" <?=((@$item['location']==2) ? 'selected' : '')?>>Dưới</option>
				-->
			  
			  
			  </select>
			  
			  
			</div>
		</div>
		<?php } ?>
		
		
		
		<div class="clearfix"></div>
		 </div>
	<?php } ?>
	<?php include _template."seo_tpl.php"?>
	</div>
	</div>	
</div></div><!-- content-tab --><div class="clearfix"></div>
<!-- Tab panes -->

	
</form>
</div>