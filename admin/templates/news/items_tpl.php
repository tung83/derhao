
<script>
$(document).ready(function() {
$("#chonhet").click(function(){
	var status=this.checked;
	$("input[name='chon']").each(function(){this.checked=status;})
});

$("#xoahet").click(function(){
	var listid="";
	$("input[name='chon']").each(function(){
		if (this.checked) listid = listid+","+this.value;
    	})
	listid=listid.substr(1);	 //alert(listid);
	if (listid=="") { alert("Ban chua chon muc nao"); return false;}
	hoi= confirm("Bạn chắc chắn muốn xóa?");
	if (hoi==true) document.location = "index.php?com=<?=$_GET['com']?>&act=delete_danhmuc&type=<?=$_GET['type']?>&listid=" + listid;
});
});
</script>
<div class="box-header with-border">
<h3>Quản lý danh mục</h3>
</div>
<div class="box-body">
    
<script language="javascript">				
	function select_onchange()
	{				
		var a=document.getElementById("id_danhmuc");
		window.location ="index.php?com=news&act=man<?=$request_clear?>&id_danhmuc="+a.value;	
		return true;
	}
	function select_onchange1()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		window.location ="index.php?com=news&act=man<?=$request_clear?>&id_danhmuc="+a.value+"&id_list="+b.value;	
		return true;
	}
	function select_onchange2()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		window.location ="index.php?com=news&act=man<?=$request_clear?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value;	
		return true;
	}
	function select_onchange3()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		var d=document.getElementById("id_item");
		window.location ="index.php?com=news&act=man<?=$request_clear?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value+"&id_item="+d.value;	
		return true;
	}

	
</script>

<?php
function get_main_danhmuc()
	{
		$sql="select * from table_news_danhmuc order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_danhmuc" name="id_danhmuc" onchange="select_onchange()" class="form-control">
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
		$sql="select * from table_news_list where id_danhmuc=".@$_REQUEST['id_danhmuc']." where type='".$_GET['type']."'  order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange1()" class="form-control">
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
		$sql="select * from table_news_cat where id_list=".$_REQUEST['id_list']." order by stt";
		
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange2()" class="form-control">
			<option>Chọn danh mục</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	
	function get_main_item()
	{
		$sql_huyen="select * from table_news_item where id_cat=".$_REQUEST['id_cat']." order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item" onchange="select_onchange3()" class="form-control">
			<option>Chọn danh mục</option>			
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
<div class="table-responsive">
<table class="table table-bordered">
	<thead>
    	<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
		<th style="width:5%;">STT</th>
		<?php if($_GET['img']){?>
		<th style="width:10%;">Hình</th>
		<?php } ?>
		<th style="width:40%;">Tên</th>
                <?php 
				$array_danhmuc = array();
				$d->query("select ten_vi,id from #_news_danhmuc ");
				foreach($d->result_array() as $k=>$v){
					$array_danhmuc[$v['id']] = $v['ten_vi'];
				}
				echo '<th style="width:10%;">'.get_main_danhmuc().'</th>';
		?>
		<th style="width:10%;">Nổi bật</th>
		<th style="width:10%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</thead>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr bgcolor="<?php if($i%2==1)echo '#F3F3F3' ?>">
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
		<td style="width:5%;"><?=$items[$i]['stt']?></td>
		<?php  if($_GET['img']){?>
		
		<td style="width:10%;">
			<img src="<?=_upload_news.$items[$i]['thumb']?>" width="70"  />
		</td>
		<?php } ?>
		<td align="center"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>"><?=$items[$i]['ten_vi']?> 	</a> </td>
		<?php 
				
					echo "<td>".@$array_danhmuc[$items[$i]['id_danhmuc']]."</td>";
		
		?>
                
		 <td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['noibat']) ? 'checked' : ''?> class="switch-input" data-type="noibat" data-com="<?=$_GET['com']?>_danhmuc" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['hienthi']) ? 'checked' : ''?> class="switch-input" data-type="hienthi" data-com="<?=$_GET['com']?>_danhmuc" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id=<?=$items[$i]['id']?>" class="icon-form"><i class="glyphicon glyphicon-pencil"></i></a></td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten_vi']?>')) return false;" class="icon-form"><i class="glyphicon glyphicon-trash"></i></a></td>
	</tr>
	<?php	}?>
</table>
</div>	

<a href="index.php?com=<?=$_GET['com']?>&act=add&type=<?=$_GET['type']?>" class="btn btn-info btn-flat  ">Thêm mới</a>
<a href="#" id="xoahet" class="btn  btn-danger btn-flat">Xóa</a>
<div class="paging"><?=$paging['paging']?></div>
</div>