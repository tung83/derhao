<div class="box-header with-border">
<?php if ($_REQUEST['act']=='edit_list') { ?> <h3>Sửa danh mục cấp 2</h3> <?php }else{ ?><h3>Thêm danh mục cấp 2</h3><?php } ?>
</div>
<div class="box-body">
<?php	
	function get_main_danhmuc($id=null)
	{
		$sql_huyen="select * from table_product_danhmuc where type='".$_GET['type']."' order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_danhmuc" name="id_danhmuc" class="form-control" required>
			<option value="0">Chọn danh mục</option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==$id)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten_vi"].'</option>';
		}
		$str.='</select>';
		return $str;
	}
?>

<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save_list&type=<?=$_GET['type']?>" class="form-horizontal" enctype="multipart/form-data" >	
    
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man_list&type=<?=$_GET['type']?>'" class="btn btn-warning" />
	<p></p>




<div class="col-xs-12">
  <div class="row">
  
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">
	
	 <div class="col-xs-12 col-sm-6  align-left">
	 <b>Danh mục cấp 1:</b><?=get_main_danhmuc(@$item['id_danhmuc']);?><br /><br /> 
		<!--<div class="col-xs-6">
		 <div class="col-xs-12">
			<div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-4 control-label">Hình ảnh</label>
				   <div class="input-group">
				 <input type="file" name="file" />
				  
				</div>
				<?php if (strpos($_GET['act'],'edit') !== false) { ?>

				<a class="fancybox"  href="<?=_upload_sanpham.@$item['photo']?>" ><img  id="main-image" src="<?=_upload_sanpham.@$item['photo']?>" class="col-xs-4" /></a>
				<?php } ?>
			 </div>
		 </div>
	 </div>-->
	 <div class="col-xs-6 align-left">
		<div class="col-xs-12">
			 <div class="checkbox">
				<label>
				  <input type="checkbox"  name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>> Hiển thị
				</label>
			  </div>
			  <!--
			  <div class="checkbox">
				<label>
				  <input type="checkbox"  name="noibat" <?=(!isset($item['noibat']) || $item['noibat']==1)?'checked="checked"':''?>> Nỗi bật
				</label>
			  </div>
			  
			  -->
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
	<li class=""><a href="#seo" data-toggle="tab"><strong>SEO</strong></a></li>
	</ul>
	
	
	<div class="tab-content">
	
	<?php
		foreach($config['lang'] as $k=>$v){?>
			
		<?php $act = ''; if($k==0){ $act = 'active'; }?>
		
		 <div class="tab-pane  <?=$act?>" id="<?=$v?>" >
	
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
			<div class="col-sm-10">
			  <input type="text" name="ten_<?=$v?>" value="<?=@$item['ten_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>	
<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
				
				
				<div class="col-sm-10">
				  <textarea  name="noidung_<?=$v?>" class="form-control editor" id="nd_<?=$v?>" ><?=@$item['noidung_'.$v]?></textarea>
				</div>
			</div>		 
		<div class="clearfix"></div>
		 </div>
	<?php } ?>
	<?php include _template."seo_tpl.php"?>
	</div>
</div></div>		
<!-- content-tab --><div class="clearfix"></div>
</div>






</form>
</div>