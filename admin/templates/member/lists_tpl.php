
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
	if (hoi==true) document.location = "index.php?com=<?=$_GET['com']?>&act=delete_list&listid=" + listid;
});
});
</script>
<h3>Quản lý danh mục cấp 2</h3>
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
		$sql="select * from table_".$_GET['com']."_danhmuc order by stt";
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
		<th style="width:7%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</thead>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr bgcolor="<?php if($i%2==1)echo '#F3F3F3' ?>">
    <td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
		<td style="width:5%;"><?=$items[$i]['stt']?></td>
        <td align="center" style="width:40%;"><?=$items[$i]['ten_vi']?></td>		
        <td align="center" style="width:25%;">        
			<?php
				$sql_danhmuc="select * from table_".$_GET['com']."_danhmuc where id='".$items[$i]['id_danhmuc']."'";
				
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc = @mysql_fetch_array($result);
				echo @$item_danhmuc['ten_vi']
            ?>               
        </td>	
        
		
		<td style="width:5%;">
		
        <?php 
		if(@$items[$i]['hienthi']==1)
		{
		?>
        <a href="index.php?com=<?=$_GET['com']?>&act=man_list&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_1.png"  border="0"/></a>
		<? 
		}
		else
		{
		?>
         <a href="index.php?com=<?=$_GET['com']?>&act=man_list&hienthi=<?=$items[$i]['id']?>"><img src="media/images/active_0.png" border="0" /></a>
         <?php
		 }?>
        
        
        
        </td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_list&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" border="0" /></a></td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete_list&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten_vi']?>')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>

<a href="index.php?com=<?=$_GET['com']?>&act=add_list"><img src="media/images/add.jpg" border="0"  /></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>