<?php include _template."layout/login_with_facebook.php"; ?>
<link href="assets/css/member/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
<link href="assets/css/member/jquery-ui-bootstrap.css" rel="stylesheet" type="text/css" /> 
<link href="assets/css/member/popup.css" rel="stylesheet" type="text/css" /> 

<div class="popup">
<div class="main-content" >
<div class="overlay"></div>
<div class="signin-a">
    <div id="yw0"></div></div>
<div class="row-fluid popup-signin">
    <div class="span5 signin-left">
        <div class="row-fluid oauth">
            <a id="signin-by-facebook" href="" class="btn-facebook" onclick="loginFb();return false"> </a>
            <a id="signin-by-google" href="" class="btn-google" onclick="login();return false;"  >
            </a>
        </div>
    </div>
    <div class="span7 signin-right">
            <form class="form-signin-popup form-vertical" autoComplete="On" id="acc-form" action="thanh-vien/dang-nhap.html" method="post">                        <div class="top-form-signin row-fluid">
                <div class="lb-signin pull-left">
                    <img src="images/label-signin.png" alt="Đăng Nhập">
                </div>
                <a id="link_signup_now" class="signup-now pull-right" href=""
                   onclick="javascript:wrapPopupToPage(
                   '/SignUp/?ui.mode=page&service=vatgia&_cont=http%3A%2F%2Fwww.vatgia.com%2Fhome%2Fidvg_return.php%3Fui.mode%3Dpopup%26redirect%3DL2hvbWUv',
                   '/site/unwrapPageToPopup/?popupUrl=https%3A%2F%2Fid.vatgia.com%2Fdang-nhap%3Fui.mode%3Dpopup%26_cont%3Dhttp%253A%252F%252Fwww.vatgia.com%252Fhome%252Fidvg_return.php%253Fui.mode%253Dpopup%2526redirect%253DL2hvbWUv%26service%3Dvatgia&service=vatgia&ui.mode=popup&_cont=http%3A%2F%2Fwww.vatgia.com%2Fhome%2Fidvg_return.php%3Fui.mode%3Dpopup%26redirect%3DL2hvbWUv'); return false;">Chưa có tài khoản                </a>
            </div>
                        <div class="main-form-signin">
                            <div class="row-fluid groups-field" style="position: relative;">
            <input class="span12 " maxlength="255" placeholder="Email hoặc tên đăng nhập" required name="SignInForm[username]" id="SignInForm_username" type="text" />                                </div>
                    <div class="row-fluid groups-feild" style="position: relative;">
                    <!--<label class="required pull-left" for="SignInForm_username">Mật khẩu</label>-->
                    <div class="password-container">
                        <input Autocomplete="Off" class="span12 vn_alpha" maxlength="255" placeholder="Mật khẩu" name="SignInForm[password]" required id="SignInForm_password" type="password" />                        <span>
                 <a class="pull-right lostpassword" href="/quen-mat-khau/?service=vatgia&ui.mode=popup&_cont=http%3A%2F%2Fwww.vatgia.com%2Fhome%2Fidvg_return.php%3Fui.mode%3Dpopup%26redirect%3DL2hvbWUv">Quên MK?</a>
                 </span>
                    </div>
                                                        </div>

                <div class="row-fluid form-signin">
                    <div class="signin-button span6">
                        <button type="submit" id="btnSignIn" name="btnSignIn" class="ga-event"
                                data-ga-event-category="sign-in"
                                data-ga-event-action="click-signin-button"
                                data-ga-event-value="vatgia"
                            ></button>
							<input type="hidden" name="action" value="login" />
                    </div>

                    <div class="remember span6">
                                                <div class="control-group "><div class="controls"><label class="checkbox" for="SignInForm_remember"><input id="ytSignInForm_remember" type="hidden" value="0" name="SignInForm[remember]" /><input name="SignInForm[remember]" id="SignInForm_remember" value="1" checked="checked" type="checkbox" />
Nhớ đăng nhập</label></div></div>                    </div>
                </div>

                            </div>
            </form>        </div>
			
			
			<div class="clearfix"></div>
<div class="no_session_member">
	Bạn chưa có tài khoản?<a href="thanh-vien/dang-ky.html">Đăng ký tại đây</a>
</div>	
</div>
<div style="width:300px;margin:auto">
			<div class="alert login-alert alert-danger hide" role="alert"></div>
			<div class="alert login-alert alert-success hide" role="alert"></div>
			</div>
<!--[if IE 8]>
<style>
    .form-singin .form-signin-popup input{
        min-height:20px;
    }
</style>
<![endif]-->
</div>

</div>
<script>
$().ready(function(){
$("#acc-form").submit(function(){
	$.ajax({
		url:'thanh-vien/dang-nhap.html',
		data:$("#acc-form").serialize(),
		type:'post',
		dataType:'json',
		beforeSend:function(){$(".popup .main-content .overlay").show();$(".login-alert").addClass("hide");},
		success:function(data){
			$(".popup .main-content .overlay").hide();
			if(!data.status){
			
				$(".login-alert.alert-danger").html(data.msg).removeClass("hide").show();
			}else{
				$(".login-alert.alert-success").html("Đăng nhập thành công").removeClass("hide").show();
				setTimeout(function(){window.location.href='index.html';},500);
			}
			
			
		}
	
	})
	return false;
})

})


</script>