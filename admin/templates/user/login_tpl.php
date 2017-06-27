<link href="assets/css/login.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function js_lost_pw(){
	window.location = '<?=@$lost_password_url?>';
}
</script>




<div id="login">
 
  <form action="index.php?com=user&act=login" method="post" id="login">
	<h3>Đăng nhập quản trị web</h3>
    <input type="text" name="username" class="big" required placeholder="Tên đăng nhập" />
    <input type="password" name="password" class="big" required placeholder="Password" />
    <input type="submit" value="Log in" class="big" />
  </form>
</div>
