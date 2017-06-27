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
	
	<!--  <li class=""><a href="#seo" data-toggle="tab"><strong>SEO</strong></a></li> -->
	</ul>

	<div class="tab-content">
	
	<?php
		foreach($config['lang'] as $k=>$v){?>
			
		<?php $act = ''; if($k==0){ $act = 'active'; }?>
		
		 <div class="tab-pane  <?=$act?>" id="<?=$v?>" >
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề</label>
			<div class="col-sm-10">
			  <input type="text" name="ten_<?=$v?>" value="<?=@$item['ten_'.$v]?>" class="form-control name_video" id="inputEmail3">
			</div>
		 </div>
		 
		<div class="form-group ">
			<label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
			<div class="col-sm-10">
			  <textarea  name="mota_<?=$v?>" class="form-control" id="inputEmail3" ><?=@$item['mota_'.$v]?></textarea>
			</div>
		</div>
		
		
		<div class="clearfix"></div>
		 </div>
	<?php } ?>
	
	<?php include _template."seo_tpl.php"?>
	</div>
	</div>	
</div></div><!-- content-tab --><div class="clearfix"></div>
<!-- Tab panes -->

	
</form>
<script>
$().ready(function(){
	
	//	$("input[name=link]").keyup(function(){
		//	getYouTubeInfo($(this).val()); 
		//	
		//})
		$("input[name=link]").change(function(){
			getYouTubeInfo($(this).val()); 
			
		})
	
	
})
 function getYouTubeInfo($val) {
	
			
		
					 var video_id = $val.split('v=')[1];
				var ampersandPosition = video_id.indexOf('&');
				if(ampersandPosition != -1) {
				  video_id = video_id.substring(0, ampersandPosition);
				}
				if(video_id){
                $.ajax({
                        url: "http://gdata.youtube.com/feeds/api/videos/"+video_id+"?v=2&alt=json",
                        dataType: "jsonp",
                        success: function (data) { console.log(data);
							var title = data.entry.title.$t;
						if(title){
							$(".name_video").val(title);
						}

						}
                });
				}
        }
		</script>
		
		
		</div>