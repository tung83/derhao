<h3>Chuyển danh mục cấp 3 sang các cấp khác</h3>
<script language="javascript">				
	function select_onchange()
	{			
		var a=document.getElementById("id_cat");
		window.location ="index.php?com=product&act=chuyencap_cat&id_cat="+a.value;	
		return true;
	}

	
</script>

<?php	
	function get_main_cat()
	{
		$sql_huyen="select * from table_product_cat order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange()">
			<option value="0">Chọn danh mục</option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}	
	
	function get_main_item()
	{
		$sql_huyen="select * from table_product_item order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item">
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
<form name="frm" method="post" action="index.php?com=product&act=save_chuyencap_cat" enctype="multipart/form-data" class="nhaplieu">
    
     <b>Chọn danh mục cần chuyển:</b><?=get_main_cat();?><br /><br /> 
     <b>Chọn cấp chuyển:</b>
		<select name="capchuyen" id="capchuyen">
        	<option value="0">Chọn cấp chuyển</option>
            <option value="2">Chuyển từ cấp 3 lên cấp 2</option>
            <option value="4">Chuyển từ cấp 3 xuống cấp 4</option>
        </select>
     <br /><br /> 
      <b>Chọn danh mục cần chuyển:</b><?=get_main_item();?><br /><br /> 
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Chuyển cấp" class="btn" style="cursor:pointer" onClick="if(!confirm('Bạn có chắc chắn chuyển ???')) return false;" />
</form>






