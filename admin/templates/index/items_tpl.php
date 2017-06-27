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
	if (hoi==true) document.location = "index.php?com=<?=$_GET['com']?>&act=delete&listid=" + listid;
});
});
</script>
<div class="box-header with-border">
<h3><a href="index.php?com=<?=$_GET['com']?>&act=add">Thêm </a></h3>
</div>
<div class="box-body">
<table class="table table-bordered">

	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th width="5%" style="width:6%;">Stt</th>
		<th style="width:10%;">Hình ảnh</th>
        <th style="width:20%;">Tên </th>
	<!--	 <th style="width:40%;">Vị trí</th> -->
	
	  <th width="9%" style="width:6%;">Quân huyện </th>
	  <th width="9%" style="width:6%;">Tỉnh thành</th>
	  <th width="9%" style="width:6%;">Hiển thị</th>
	  <th width="9%" style="width:6%;">Nổi bật</th>
		<th width="9%" style="width:6%;">Sửa</th>
		<th width="9%" style="width:6%;">Xóa</th>
	</tr>
	<?php 
	
		$d->query("select districtid,name,provinceid,type from #_district");
		$arr = array(); 
		
		foreach($d->result_array() as $k=>$v){
			$arr[(int)$v['districtid']] = $v['name'];
		}
		
		$arr2 = array();
		$d->query("select provinceid,name from #_province");
		foreach($d->result_array() as $k=>$v){
			$arr2[(int)$v['provinceid']] = $v['name'];
		}
	
	?>
    
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td style="width:6%;" align="center"><?=$items[$i]['stt']?></td>
      
       <td style="width:30%;" align="center">
        	<a href="<?=_upload_news.$items[$i]['photo']?>" class="fancybox"><img src="<?=_upload_news.$items[$i]['thumb']?>" width="100px" /></a>
        </td>
		<td style="width:20%;" align="center"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten_vi']?></a></td>
		<td style="width:20%;" align="center">
        	<?=$arr[$items[$i]['id_district']]?>
        </td>
		<td style="width:20%;" align="center">
        	<?=$arr2[$items[$i]['id_province']]?>
        </td>
		
		<!-- <td style="width:10%;" align="center"><?=(@$items[$i]['location']==1) ? 'Trên' : 'Dưới'?></td> -->
		<!-- <td style="width:40%;" align="center"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten_en']?></a></td> -->
		
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['hienthi']) ? 'checked' : ''?> class="switch-input" data-type="hienthi" data-com="<?=$_GET['com']?>" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['noibat']) ? 'checked' : ''?> class="switch-input" data-type="noibat" data-com="<?=$_GET['com']?>" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:6%;" align="center"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png"  border="0"/></a></td>
		<td style="width:6%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>
<a href="index.php?com=<?=$_GET['com']?>&act=add"><img src="media/images/add.jpg" border="0"  /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>
</div>