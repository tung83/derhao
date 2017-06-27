<!--
<h3>Thêm <?=$com?></h3>

-->
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
<div class="box-header with-border">
	<h3><?=($act=='add') ? 'Thêm' : 'Sửa'?></h3>
</div>
<div class="box-body">
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
	<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Link</label>
			<div class="col-sm-10">
			  <input type="text" name="link" value="<?=@$item['link']?>" class="form-control " id="inputEmail3">
			</div>
		 </div>
<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Loại</label>
			<div class="col-sm-10">
			  <label class="radio-inline">
				  <input type="radio"  name="type" value="0" <?=((!$item | (@$item['type']==0)) ? 'checked' : '')?> id="inlineRadio1" value="option1"> Tags seo
				</label>
				<label class="radio-inline">
				  <input type="radio"  name="type" value="1" <?=(((@$item['type']==1)) ? 'checked' : '')?> id="inlineRadio2" value="option2"> Link
				</label>

			</div>
		 </div>
		 <script>
			$().ready(function(){
				$("input[name=type]").click(function(){
					if($(this).val()==1){
						$("input[name=link]").removeAttr("readonly");
					}else{
						$("input[name=link]").attr("readonly","readonly");
					}
				})
				$("input[name=type]:checked").trigger("click");
			})
		 
		 </script>

	<!-- <b>Loại</b>
	<label><input type="radio" name="type" value="0" <?=($item['type'] == 0 | !isset($item)) ? 'checked' : ''?> >Tags seo</label>
	<label><input type="radio" name="type" value="1" <?=($item['type']) ? 'checked' : ''?>>Link</label> -->
	<!-- <div class="col-xs-6">
		<div class="col-xs-12">
			<div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-4 control-label">Hình ảnh</label>
				   <div class="input-group">
				 <input type="file" name="file" />
				  
				</div>
				<a class="fancybox"  href="<?=_upload_tintuc.@$item['photo']?>" ><img  id="main-image" src="<?=_upload_tintuc.@$item['photo']?>" class="col-xs-4" /></a>
			 </div>
		 </div>
	 </div> -->
	 <div class="col-xs-6 align-left">
		<div class="col-xs-12">
			 <div class="checkbox">
				<label>
				  <input type="checkbox"  name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>> Hiển thị
				</label>
			  </div>
			 
			  
		 </div>
	 </div>
	 <?php } ?>
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
	
	<!--  <li class=""><a href="#seo" data-toggle="tab"><strong>SEO</strong></a></li> -->
	</ul>

	<div class="tab-content">
	
	<?php
		foreach($config['lang'] as $k=>$v){?>
			
		<?php $act = ''; if($k==0){ $act = 'active'; }?>
		
		 <div class="tab-pane  <?=$act?>" id="<?=$v?>" >
		<?php if($_GET['com']!='hd'){?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Text</label>
			<div class="col-sm-10">
			  <input type="text" name="ten_<?=$v?>" value="<?=@$item['ten_'.$v]?>" class="form-control name_video" id="inputEmail3">
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