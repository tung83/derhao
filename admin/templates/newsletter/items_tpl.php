
<script>
$(document).ready(function() {
$("#chonhet").click(function(){
	var status=this.checked;
	$("input[name='chon']").each(function(){this.checked=status;})
});

$("#send").click(function(){
	var listid="";
	$("input[name='chon']").each(function(){
		if (this.checked) listid = listid+","+this.value;
    	})
	listid=listid.substr(1);	 //alert(listid);
	if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
	hoi= confirm("Xác nhận muốn gửi thư đi?");
	if (hoi==true){ document.frm.listid.value=listid; document.frm.submit();}
});
});
</script>
<div class="box-header with-border">
	<h3>Email nhận thông tin</h3>
</div>
<div class="box-body">
<form name="frm" method="post" action="index.php?com=newsletter&act=send" enctype="multipart/form-data">		    
<input type="hidden" name="listid">
<h3>Chọn email mà bạn muốn gửi</h3>
<table class="table table-bordered" id="tb">

	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th style="width:50%;">Email</th>
		<th style="width:5%;">Xóa</th>
	</tr>
    <tbody>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>		        
        <td style="width:50%;" align="center"><b><?=$items[$i]['email']?></b></td>
		
		<td style="width:5%;"><a href="index.php?com=newsletter&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
	</tbody>
</table>
<a href="#addform" class="btn btn-success fancybox">Thêm mới</a>

<script>
$().ready(function(){
	
	$("#addmail").click(function(){
		$mail = $("#exampleInputEmail1x").val();
		if(!validateEmail($mail)){
			alert("Vui lòng nhập email đúng định dạng");
			return false;
		}else{
	
		$.post("<?=$config_url?>/admin/index.php?com=newsletter&act=add",{email:$("#exampleInputEmail1x").val()},function(data){
			
			data = $.parseJSON(data);
			if(data.stt){
			$("#tb tbody").append(data.content);
			$.fancybox.close();
			}else{
				alert(data.msg);
			}
			
		
		})
		}
		return false;
		
	
	})

})

</script>
<br />
<br />
<b>Tiêu đề</b>&nbsp;&nbsp;<input type="text" class="input" name="ten" style="width: 350px;"><br /><br />

<b>Đính kèm file</b>&nbsp;&nbsp;<input type="file" name="file"><br />
<br />


<b>Nội dung</b><br/><br />

	<div>
	 <textarea name="noidung" class="editor" id="noidung"><?=$item['noidung']?></textarea></div>
    <br/>
<a href="#" id="send" class="btn btn-success">Xác nhận gửi!!!</a>
</form>
</div>

<div class="hide">
	<div id="addform">
		<form role="form" id="add_form">
		  <div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" id="exampleInputEmail1x" required placeholder="Enter email">
		  </div>
		<button type="submit" class="btn btn-default" id="addmail">Submit</button>
</form>
	
	</div>

</div>