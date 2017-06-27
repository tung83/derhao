

<?php if ($_REQUEST['act']=='edit') { ?> <h3>Sửa tin tức</h3> <?php }else{ ?><h3>Thêm tin tức</h3><?php } ?>
<?php
function get_main_item()
	{
		$sql_huyen="select * from table_index_item_item order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item"">
			<option value="0">Chọn danh mục</option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>
<form name="frm" method="post" action="index.php?com=index_item&act=save" enctype="multipart/form-data" class="nhaplieu">
	
    
    <?php if (@$_REQUEST['act']=='edit') { ?>
	<b>Hình hiện tại:</b><img src="<?=_upload_tintuc.$item['photo']?>" alt="NO PHOTO"  width="200"/><br />
	<?php }?><br />
    
	
    
	<b>Tiêu đề EN</b> <input type="text" name="ten_en" value="<?=@$item['ten_en']?>" class="input" /><br /><br />
	<b>Tiêu đề VI</b> <input type="text" name="ten_vi" value="<?=@$item['ten_vi']?>" class="input" /><br /><br />
    <b>Hình ảnh:</b> <input type="file" name="file" /><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Width:170px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Height:130px  <?=_hinhanh_type?></strong><br /><br />	

<?php
	$s1 = "checked";
	$s2 = "";
	if(isset($item)){
		if($item['type'] == 1){
			$s2 = $s1;
			$s1 = '';
			
		}
	}

?>
	
	<b>Hiểu thị theo:</b><label> <input type="radio" <?=$s1?> name="type" value="0" />Tên</label><label> <input type="radio" <?=$s2?> name="type" value="1" />Hình ảnh</label><br /><br />
	<b>Mô tả EN</b><br>
	<div><textarea name="mota_en" class="editor" style="width:550px;height:140px" id="mota"><?=$item['mota_en']?></textarea></div><br/>
	<b>Mô tả VI</b><br>
	<div><textarea name="mota_vi" class="editor" style="width:550px;height:140px" id="mota_vi"><?=$item['mota_vi']?></textarea></div><br/>
	
	<b>Nội dung EN</b><br/>
	<div><textarea name="noidung_en" class="editor" id="noidung"><?=$item['noidung_en']?></textarea></div><br/>
	<b>Nội dung VI</b><br/>
	<div><textarea name="noidung_vi" class="editor" id="noidung_vi"><?=$item['noidung_vi']?></textarea></div><br/>
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br><br/>
	
    <b>Nỗi bật</b> <input type="checkbox" name="noibat" <?=($item['noibat']==1)?'checked="checked"':''?>><br />
    
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
	
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=index_item&act=man'" class="btn" />
</form>