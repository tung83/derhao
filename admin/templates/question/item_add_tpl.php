<div class="box-header with-border">
	<h3>Xem câu hỏi</h3>
</div>
<div class="box-body">
<script language="javascript">				
	function select_onchange()
	{				
		var a=document.getElementById("id_danhmuc");
		window.location ="index.php?com=product&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_danhmuc="+a.value;	
		return true;
	}
	function select_onchange1()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		window.location ="index.php?com=product&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_danhmuc="+a.value+"&id_list="+b.value;	
		return true;
	}
	function select_onchange2()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		window.location ="index.php?com=product&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value;	
		return true;
	}

	
</script>
<?php
function get_main_danhmuc()
	{
		$sql="select * from table_product_danhmuc order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_danhmuc" name="id_danhmuc" onchange="select_onchange()" class="main_font form-control">
			<option>Chọn danh mục</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_danhmuc"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';
		}
		$str.='</select>';
		return $str;
	}

function get_main_list()
	{
		$sql="select * from table_product_list where id_danhmuc=".@$_REQUEST['id_danhmuc']."  order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange1()" class="main_font form-control">
			<option>Chọn danh mục</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
function get_main_category()
	{
		$sql="select * from table_product_cat where id_list=".$_REQUEST['id_list']." order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange2()" class="main_font form-control">
			<option>Chọn danh mục</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_i"].'</option>';
		}
		$str.='</select>';
		return $str;
	}
	
	
	/* function get_main_item()
	{
		$sql_huyen="select * from table_product_item where id_cat=".$_REQUEST['id_cat']." order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item" class="form-control">
			<option>Chọn danh mục</option>			
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
	} */
?>









<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save&curPage=<?=@$_REQUEST['curPage']?>" enctype="multipart/form-data" class="form-horizontal" >	 




 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" />
	<p></p>	
  <div class="col-xs-12">
  



	
			
		
			
			 
			 
			 
			
			
	
	
	 <div class="clearfix"></div>
	<div class="col-xs-10">
	

	<div class="tab-content" style="border-top:1px solid #ccc">
	
		
				
			<?php $act = '';$required = ''; if($k==0){ $act = 'active';}?>
			
			 <div class="tab-pane  <?=$act?>" id="<?=$v?>" >
		
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
				<div class="col-sm-8">
				  <input type="text" name="ten" <?=$required?> value="<?=@$item['ten']?>" class="form-control " id="inputEmail3">
				</div>
			 </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="text" name="email" <?=$required?> value="<?=@$item['email']?>" class="form-control " id="inputEmail3">
				</div>
			 </div>
			<div class="form-group hide">
				<label for="inputEmail3" class="col-sm-2 control-label">Số điện thoại</label>
				<div class="col-sm-8">
				  <input type="text" name="ten_<?=$v?>" <?=$required?> value="<?=@$item['phone']?>" class="form-control " id="inputEmail3">
				</div>
			 </div>
			 
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Địa chỉ</label>
				<div class="col-sm-8">
				  <input type="text" name="address" <?=$required?> value="<?=@$item['address']?>" class="form-control " id="inputEmail3">
				</div>
			 </div>

			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nội dung câu hỏi</label>
				<div class="col-sm-10">
				  <textarea  name="content" class="form-control mini editor" id="content<?=$lang?>" ><?=@$item['content']?></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Trả lời</label>
				<div class="clearfix"></div>
				<div class="col-sm-12">
				  <textarea  name="reply" class="form-control  editor" id="reply_<?=$lang?>" ><?=@$item['reply']?></textarea>
				</div>
			</div>
			
			
			<div class="clearfix"></div>
			 </div>
		
		
	 
	
	
	
	</div><!-- end tab-content -->
	</div>	<!-- end col-xs-10 -->
	<div class="clearfix"></div>
	</div<!-- end col-xs-12 -->
	<div class="clearfix"></div>	
</div><!-- content-tab --><div class="clearfix"></div>		
	

	
   
</form>

</div>
