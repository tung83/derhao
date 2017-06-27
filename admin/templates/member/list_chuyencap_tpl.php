<h3>Chuyển danh mục cấp 2 sang các cấp khác</h3>
<script language="javascript">				
	function select_onchange()
	{			
		var a=document.getElementById("id_list");
		window.location ="index.php?com=product&act=chuyencap_list&id_list="+a.value;	
		return true;
	}
	function select_onchange2()
	{			
		var a=document.getElementById("id_list");
		var b=document.getElementById("id_cat");
		window.location ="index.php?com=product&act=chuyencap_list&id_list="+a.value+"&id_cat="+b.value;	
		return true;
	}

	
</script>

<?php	

	
	function get_main_list()
	{
		$sql_huyen="select ten,id from table_product_list order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange()">
			<option value="0">Chọn danh mục</option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_list"])
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
	
	function get_main_cat()
	{
		$sql_huyen="select ten,id from table_product_cat order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange2()">
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
	
	
	
?>
<form name="frm" method="post" action="index.php?com=product&act=save_chuyencap_list" enctype="multipart/form-data" class="nhaplieu">
    
     <b>Chọn danh mục cần chuyển:</b><?=get_main_list();?><br /><br /> 
     <b>Chọn cấp chuyển:</b>
		<select name="capchuyen" id="capchuyen">
        	<option value="0">Chọn cấp chuyển</option>
            <option value="3">Chuyển từ cấp 2 xuống cấp 3</option>
            <option value="4">Chuyển từ cấp 2 xuống cấp 4</option>
        </select>
     <br /><br /> 
      <b>Chọn danh mục con chuyển vào:</b><?=get_main_cat();?><br /><br /> 
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Chuyển cấp" class="btn" style="cursor:pointer" onClick="if(!confirm('Bạn có chắc chắn chuyển ???')) return false;" />
</form>






