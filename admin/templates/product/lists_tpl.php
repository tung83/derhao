
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
	if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
	hoi= confirm("Bạn có chắc chắn muốn xóa?");
	if (hoi==true) document.location = "index.php?com=<?=$_GET['com']?>&act=delete_list&type=<?=$_GET['type']?>&listid=" + listid;
});
});
</script>
<div class="box-header with-border">
<h3>Quản lý danh mục cấp 2</h3>
</div>
<div class="box-body">
 &nbsp;&nbsp;&nbsp;Danh mục cấp 1&nbsp;<?=get_main_danhmuc();?><br />
 
 <script language="javascript">				
	function select_onchange()
	{				
		var a=document.getElementById("id_danhmuc");
		window.location ="index.php?com=<?=$_GET['com']?>&act=man_list&id_danhmuc="+a.value;	
		return true;
	}
</script>
 
 <?php	
	function get_main_danhmuc()
	{
		$sql="select * from table_".$_GET['com']."_danhmuc  where `type`='".$_GET['type']."' order by stt";
		$stmt=mysql_query($sql);
		
		$str='
			<select id="id_danhmuc" name="id_danhmuc" onchange="select_onchange()" class="main_font">
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
?><br />
<table class="table table-bordered">
	<thead>
    	<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
		<th style="width:5%;">STT</th>
        
		<th style="width:40%;">Tên </th>	
		<th style="width:25%;">Danh mục chính</th>
		<th style="width:10%;">Nổi bật</th>
		<th style="width:7%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</thead>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr bgcolor="<?php if($i%2==1)echo '#F3F3F3' ?>">
    <td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
		<td style="width:5%;"><?=$items[$i]['stt']?></td>
        <td align="center" style="width:30%;"><?=$items[$i]['ten_vi']?></td>		
        <td align="center" style="width:30%;">        
			<?php
				$sql_danhmuc="select * from table_".$_GET['com']."_danhmuc where id='".$items[$i]['id_danhmuc']."'";
				
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc = @mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi']
            ?>               
        </td>	
        
		 <td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['noibat']) ? 'checked' : ''?> class="switch-input" data-type="noibat" data-com="<?=$_GET['com']?>_list" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		 <td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['hienthi']) ? 'checked' : ''?> class="switch-input" data-type="hienthi" data-com="<?=$_GET['com']?>_list" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_list&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="icon-form"><i class="glyphicon glyphicon-pencil"></i></a></td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete_list&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten_vi']?>')) return false;" class="icon-form"><i class="glyphicon glyphicon-trash"></i></a></td>
	</tr>
	<?php	}?>
</table>

<a href="index.php?com=<?=$_GET['com']?>&act=add_list&type=<?=$_GET['type']?>" class="btn btn-info btn-flat  ">Thêm mới</a>
<a href="#" id="xoahet" class="btn  btn-danger btn-flat">Xóa</a>

<div class="paging"><?=$paging['paging']?></div>
</div>