<?php
	$request = "&curPage=".@$_GET['curPage']."&new=".$_GET['new']."&gallery=".$_GET['gallery']."&class=".$_GET['class']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'].((isset($_GET['id_danhmuc']) & @$_GET['id_danhmuc'] > 0) ? "&id_danhmuc=".$_GET['id_danhmuc'] : '').((isset($_GET['id_list']) & @$_GET['id_list'] > 0) ? "&id_list=".$_GET['id_list'] : '').((isset($_GET['id_danhmuc']) & @$_GET['id_cat'] > 0) ? "&id_cat=".$_GET['id_cat'] : '');
	$request_clear = "&curPage=".@$_GET['curPage']."&new=".$_GET['new']."&gallery=".$_GET['gallery']."&class=".$_GET['class']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
?>
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
	if (hoi==true) document.location = "index.php?com=<?=$_GET['com']?>&act=delete<?=$request?>&listid=" + listid;
});
});
</script>
<div class="box-header with-border">
<h3>Quản lý sản phẩm</h3>
      </div>
	  <div class="box-body">
<script language="javascript">				
	function select_onchange()
	{				
		var a=document.getElementById("id_danhmuc");
		window.location ="index.php?com=<?=$_GET['com']?>&act=man<?=$request_clear?>&id_danhmuc="+a.value;	
		return true;
	}
	function select_onchange1()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		window.location ="index.php?com=<?=$_GET['com']?>&act=man<?=$request_clear?>&id_danhmuc="+a.value+"&id_list="+b.value;	
		return true;
	}
	function select_onchange2()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		window.location ="index.php?com=<?=$_GET['com']?>&act=man<?=$request_clear?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value;	
		return true;
	}
	function select_onchange3()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		var d=document.getElementById("id_item");
		window.location ="index.php?com=<?=$_GET['com']?>&act=man<?=$request_clear?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value+"&id_item="+d.value;	
		return true;
	}

	
</script>

<?php
function get_main_danhmuc()
	{
		$sql="select * from table_".$_GET['com']."_danhmuc order by stt";
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
		$sql="select * from table_".$_GET['com']."_list where id_danhmuc=".@$_REQUEST['id_danhmuc']." order by stt";
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
		$sql="select * from table_".$_GET['com']."_cat where id_list=".$_REQUEST['id_list']." order by stt";
		
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
		$sql_huyen="select * from table_".$_GET['com']."_item where id_cat=".$_REQUEST['id_cat']." order by id desc ";
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


<div class="clearfix"></div>
<input type="text" id="keyword" value="<?=@$_GET['keyword']?>" class="form-control pull-left" style="width:200px" /><button class="btn pull-left btn-success" onClick="searchForm('<?=$request_clear?>');"type="button">TÌM KIẾM</button>
<div class="clearfix"></div>
<br />
<div class="table-responsive">
<table class=" table table-bordered">
	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th style="width:5%;">Stt</th>		
		<th style="width:20%;">Tên  </th>
		
		
		
		
		
		
		
		
		
		<?php 
			if($_GET['class'] >=1){
				$array_danhmuc = array();
				$d->query("select ten_vi,id from #_product_danhmuc");
				foreach($d->result_array() as $k=>$v){
					$array_danhmuc[$v['id']] = $v['ten_vi'];
				}
				echo '<th style="width:10%;">'.get_main_danhmuc().'</th>';
			}
		?>
		<?php 
			
			if($_GET['class'] >=2){
				$array_list = array();
				$d->query("select ten_vi,id from #_product_list");
				foreach($d->result_array() as $k=>$v){
					$array_list[$v['id']] = $v['ten_vi'];
				}
				echo '<th style="width:10%;">'.get_main_list().'</th>';
			}
			?>
		
		<?php 
			
			if($_GET['class'] >=3){
				$array_cat = array();
				$d->query("select ten_vi,id from #_product_cat");
				foreach($d->result_array() as $k=>$v){
					$array_cat[$v['id']] = $v['ten_vi'];
				}
				echo '<th style="width:10%;">'.get_main_category().'</th>';
			}
			?>
        <?php if($_GET['new']){
			echo '<th style="width:7%;">Mới</th>';
			
		}
			?>
        <th style="width:10%;">Hàng đổi trả</th>
        <th style="width:7%;">Nổi bật</th>
		<th style="width:7%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr bgcolor="<?php if($i%2==1)echo '#F3F3F3' ?>">
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td style="width:5%;"><?=$items[$i]['stt']?></td>
		<td style="width:15%;"><a href="index.php?com=<?=$_GET['com']?>&act=edit&id=<?=$items[$i]['id']?><?=$request?>" style="text-decoration:none;"><?=$items[$i]['ten_vi']?></a></td>
        <?php 
			if($_GET['class'] >= 1){
				
					echo "<td>".@$array_danhmuc[$items[$i]['id_danhmuc']]."</td>";
							
			}
		
		?>
		<?php 
			if($_GET['class'] >= 2){
				
					echo "<td>".@$array_list[$items[$i]['id_list']]."</td>";
							
			}
		
		?>
		<?php 
			if($_GET['class'] >= 3){
				
					echo "<td>".@$array_cat[$items[$i]['id_cat']]."</td>";
								
			}
		
		?>
		<?php if($_GET['new']){?>
		<td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['new']) ? 'checked' : ''?> class="switch-input" data-type="new" data-com="<?=$_GET['com']?>" data-id="<?=$items[$i]['id']?>"/>   
        </td><?php } ?>
        <td style="width:5%;">
		<input type="checkbox" <?=($items[$i]['is_request']) ? 'checked' : ''?> class="switch-input" data-type="is_request" data-com="<?=$_GET['com']?>" data-id="<?=$items[$i]['id']?>"/>   
        </td>
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