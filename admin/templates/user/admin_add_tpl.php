<script language="javascript" src="media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit(){
	if(isEmpty(document.frm.username, "Chưa nhập tên đăng nhập.")){
		return false;
	}
	
	if(isEmpty(document.frm.oldpassword, "Chưa nhập mật khẩu cũ.")){
		return false;
	}
	
	if(!isEmpty(document.frm.new_pass) && document.frm.new_pass.value.length<5){
		alert("Mật khẩu phải nhiều hơn 4 ký tự.");
		document.frm.new_pass.focus();
		return false;
	}
	
	if(!isEmpty(document.frm.new_pass) && document.frm.new_pass.value!=document.frm.renew_pass.value){
		alert("Nhập lại mật khẩu mới không chính xác.");
		document.frm.renew_pass.focus();
		return false;
	}
	
	if(!isEmpty(document.frm.email) && !check_email(document.frm.email.value)){
		alert('Email không hợp lệ.');
		document.frm.email.focus();
		return false;
	}
}
</script>

<div class="box-header with-border">
<h3>Tài khoản</h3>
</div>

<div class="box-body">
<form name="frm" method="post" action="index.php?com=user&act=admin_edit" enctype="multipart/form-data" class="nhaplieu" onSubmit="return js_submit();">
	<div class="col-xs-12 col-md-6">
	<div class="row">
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php'" class="btn btn-warning" />
	<p></p>
	<div class="form-group">
	  <label for="exampleInputEmail1">Tên đăng nhập</label>
	  <input type="text" class="form-control" name="username" id="exampleInputEmail1" value="<?=$item['username']?>" placeholder="">
	</div>
	<div class="form-group">
	  <label for="exampleInputEmail1">Mật khẩu</label>
	  <input type="password" class="form-control" name="oldpassword" id="exampleInputEmail1" placeholder="">
	</div>
	<div class="form-group">
	  <label for="exampleInputEmail1">Mật khẩu mới</label>
	  <input type="password" class="form-control" name="new_pass" id="exampleInputEmail1" placeholder="">
	</div>
	<div class="form-group">
	  <label for="exampleInputEmail1">Nhập lại mật khẩu mới</label>
	  <input type="password" class="form-control" name="renew_pass" id="exampleInputEmail1" placeholder="">
	</div>
	<div class="form-group">
	  <label for="exampleInputEmail1">Họ tên</label>
	  <input type="text" class="form-control" value="<?=$item['ten']?>"   name="ten" id="exampleInputEmail1" placeholder="">
	</div>
	<div class="form-group">
	  <label for="exampleInputEmail1">Email</label>
	  <input type="email" class="form-control" name="email" value="<?=$item['email']?>" id="exampleInputEmail1" placeholder="">
	</div>
	
	</div>
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	
</form>
</div>