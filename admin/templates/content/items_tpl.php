<?php
	$request = "&gallery=".$_GET['gallery']."&class=".$_GET['class']."&type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content']."&id_danhmuc=".$_GET['id_danhmuc']."&id_list=".$_GET['id_list'];
	?>
<script>
$(document).ready(function() {
$("#chonhet").click(function(){
	var status=this.checked;
	$("input[name='chon']").each(function(){this.checked=status;})
});
$(".table-responsive th select").change(function(){
	$request = "<?=$request?>"
	$(".table-responsive th select").each(function(){
		$request+="&"+$(this).attr("name")+"="+$(this).val();
	})
	window.location.href="index.php?com=<?=$_GET['com']?>&act=<?=$_GET['act']?>"+$request;
})

$("#xoahet").click(function(){
	var listid="";
	$("input[name='chon']").each(function(){
		if (this.checked) listid = listid+","+this.value;
    	})
	listid=listid.substr(1);	 //alert(listid);
	if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
	hoi= confirm("Bạn có chắc chắn muốn xóa?");
	if (hoi==true) document.location = "index.php?com=<?=$_GET['com']?>&act=delete&listid=" + listid+"<?=$request?>";
});
});
</script>
<div class="box-header with-border">
<h3>Quản lý bài viết</a></h3>
</div>
<div class="box-body">

<div class="table-responsive">
<table class=" table table-bordered">

	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th width="5%" style="width:6%;">Stt</th>
        <th style="width:15%;">Hình đại diện </th>
        <th style="width:20%;">Tên </th>
		
		<?php 
			
			if($_GET['class'] >=1){
				echo '<th width="20%">';
				$danhmucs = $admin->getContentClassDanhmuc($_GET['type'],false);
				echo $admin->getContentClassDanhmuc($_GET['type'],true);
				echo '</th>';
			}
			
		?>
		<?php 
			
			if($_GET['class'] >=2){
				echo '<th width="20%">';
				$lists = $admin->getContentClassList($_GET['type'],false);
				echo $admin->getContentClassList($_GET['type'],true,true);
				echo '</th>';
			}
			
		?>
		
	    <th width="10%" >Nổi bật</th>
	
	    <th width="10%" >Hiển thị</th>
		<th width="5%">Sửa</th>
		<th width="5%" >Xóa</th>
	</tr>
    
	<?php 

	for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td  align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td  align="center"><?=$items[$i]['stt']?></td>
        <td  align="center"><img src="<?=_upload_news.$items[$i]['thumb']?>" width=70 /></td>
        <td align="center"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id=<?=$items[$i]['id']?><?=$request?>" style="text-decoration:none;"><?=$items[$i]['ten_vi']?></a></td>
		<?php 
			if($_GET['class'] >=1){
				echo '<td align="center" >';
				echo $danhmucs[$items[$i]['id_danhmuc']];
				echo '</td>';
			}
		?>
		<?php 
			if($_GET['class'] >=2){
				echo '<td align="center">';
				echo $lists[$items[$i]['id_list']];
				echo '</td>';
			}
		?>
		
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['noibat']) ? 'checked' : ''?> class="switch-input" data-type="noibat" data-com="<?=$_GET['com']?>" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['hienthi']) ? 'checked' : ''?> class="switch-input" data-type="hienthi" data-com="<?=$_GET['com']?>" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id=<?=$items[$i]['id']?><?=$request?>" class="icon-form"><i class="glyphicon glyphicon-pencil"></i></a></td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete&id=<?=$items[$i]['id']?><?=$request?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten_vi']?>')) return false;" class="icon-form"><i class="glyphicon glyphicon-trash"></i></a></td>
	</tr>
	<?php	}?>
</table>
</div>
<a href="index.php?com=<?=$_GET['com']?>&act=add<?=$request?>" class="btn btn-info btn-flat  ">Thêm mới</a>
<a href="#" id="xoahet" class="btn  btn-danger btn-flat">Xóa</a>
<div class="paging"><?=$paging['paging']?></div>
</div>