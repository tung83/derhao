
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
	if (hoi==true) document.location = "index.php?com=<?=$_GET['com']?>&act=delete_list&type=<?=$_GET['type']?>&title=<?=$_GET['title']?>&img=<?=$_GET['img']?>&desc=<?=$_GET['desc']?>&content=<?=$_GET['content']?>&listid=" + listid;
});
});
</script>
<div class="box-header with-border">
<h3>Quản lý danh mục</h3>
</div>
<div class="box-body">
<div class="table-responsive">
<table class="table table-bordered">
	<thead>
    	<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
		<th style="width:5%;">STT</th>
		<?php if($_GET['img']){?>
		<th style="width:10%;">Hình</th>
		<?php } ?>
		<th style="width:30%;">Tên</th>
		<th style="width:20%;"><?php 
			$danhmucs = $admin->getContentClassDanhmuc($_GET['type'],false);
			echo $admin->getContentClassDanhmuc($_GET['type'],true,@$_GET['id_danhmuc']);
		?></th>
		<th style="width:10%;">Số bài viết</th>
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
		<td align="center"><a href="index.php?com=<?=$_GET['com']?>&act=edit_list&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>&title=<?=$_GET['title']?>&img=<?=$_GET['img']?>&desc=<?=$_GET['desc']?>&content=<?=$_GET['content']?>"><?=$items[$i]['ten_vi']?> 	</a> </td>
		<td align="center">
			<?=$danhmucs[$items[$i]['id_danhmuc']]?>
		</td>
		<td align="center"><a href="javascript:void(0)">(<?php 
				$d->query("select id from #_$com where id_list = ".$items[$i]['id']." and type='".$_GET['type']."'");
				echo $d->num_rows();
			?>)</a></td>
		 <td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['noibat']) ? 'checked' : ''?> class="switch-input" data-type="noibat" data-com="<?=$_GET['com']?>_list" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['hienthi']) ? 'checked' : ''?> class="switch-input" data-type="hienthi" data-com="<?=$_GET['com']?>_list" data-id="<?=$items[$i]['id']?>"/>   
        </td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit_list&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>&title=<?=$_GET['title']?>&img=<?=$_GET['img']?>&desc=<?=$_GET['desc']?>&content=<?=$_GET['content']?>" class="icon-form"><i class="glyphicon glyphicon-pencil"></i></a></td>
		<td style="width:5%;"><a href="index.php?com=<?=$_GET['com']?>&act=delete_list&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>&title=<?=$_GET['title']?>&img=<?=$_GET['img']?>&desc=<?=$_GET['desc']?>&content=<?=$_GET['content']?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten_vi']?>')) return false;" class="icon-form"><i class="glyphicon glyphicon-trash"></i></a></td>
	</tr>
	<?php	}?>
</table>
</div>	

<a href="index.php?com=<?=$_GET['com']?>&act=add_list&type=<?=$_GET['type']?>&title=<?=$_GET['title']?>&img=<?=$_GET['img']?>&desc=<?=$_GET['desc']?>&content=<?=$_GET['content']?>" class="btn btn-info btn-flat  ">Thêm mới</a>
<a href="#" id="xoahet" class="btn  btn-danger btn-flat">Xóa</a>
<div class="paging"><?=$paging['paging']?></div>
</div>