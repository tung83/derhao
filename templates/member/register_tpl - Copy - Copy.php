<link href="assets/css/member/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
<link href="assets/css/member/jquery-ui-bootstrap.css" rel="stylesheet" type="text/css" /> 
<link href="assets/css/member/register.css" rel="stylesheet" type="text/css" /> 




 <div style="background:url(assets/img/footer-bg.jpg) no-repeat fixed">
 <div id="" class="container">
 <div class="main-content bg-signup-vatgia" id="scroll">
        <div class="main-container">
            <div class="content">
                <div class="container">
                    <div class="row signup row-fluid">
	<div class="pull-right wrap-right"><div class="signup-box pull-right">
    <div class="group-label">
        <label>Chỉ cần một tài khoản</label>
        <span>để đăng nhập tất cả  các website thành viên <b>VNP Group</b></span>
    </div>
    <div class="signup-form row-fluid">
<form  class="form-signUp popover-note frm-vg form-vertical" autoComplete="Off" enctype="multipart/form-data" id="signUpVatgia-form" action="" method="post">
    <div class="oauth row-fluid">
        <a id ="signin-by-facebook" href="/dang-nhap/facebook/?remember=1&service=vatgia&_cont=http%3A%2F%2Fvatgia.com"  class="btn-fb-su"></a>
        <a id="signin-by-google" href="/dang-nhap/google/?remember=1&service=vatgia&_cont=http%3A%2F%2Fvatgia.com"  class="btn-g-su"></a>
    </div>
    <div class="or-signup">
        <span class="mscenter">Hoặc đăng ký tại đây</span>
        <span class="msright"></span>
        <span class="msleft"></span>
    </div>
	<div class="error-in-tab">
		<?php
			if(count($err) > 0){
			?>
				<div class="alert alert-danger alert-dismissible" role="alert">
				 
					<?php
						foreach($err as $k=>$v){
							echo '<div>'.$v.'</div>';
						
						}
					?>
				</div>
				<?php 
			}
			if($success){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
				  
					<div><?=$success?></div>
				</div>
			<?php
			
			}
		
		?>
	
	
	</div>


<!-- import form -->

    <div class="groups-field us_ac" id="vg-username" style="position: relative">
        <input class="span12 id-user" required placeholder="Tên truy cập" name="SignUpVatGiaForm[username]" id="SignUpVatGiaForm_username" type="text" />        <span class="help-block error herror" id="SignUpVatGiaForm_username_em_" style="display: none"></span>            </div>

    <div class="groups-field" id="vg-full-name" style="position: relative">
        <input class="span12 id-user" required placeholder="Họ và tên" name="SignUpVatGiaForm[full_name]" id="SignUpVatGiaForm_full_name" type="text" />        <span class="help-block error herror" id="SignUpVatGiaForm_full_name_em_" style="display: none"></span>            </div>

    <div class="groups-field" style="position: relative">
        <input class="span12 id-mail" required maxlength="255" placeholder="Email" name="SignUpVatGiaForm[email]" id="SignUpVatGiaForm_email" type="email" />        <span class="help-block error herror" id="SignUpVatGiaForm_email_em_" style="display: none"></span>            </div>
    <div id="existed_vendor" style="display: none;float: left;">
        <div id="existed_vendor_label" style="color: red;">Email của bạn đã tồn tại trên các hệ thống: </div>
        <a href="/dang-nhap/?service=vatgia&_cont=http%3A%2F%2Fvatgia.com" id="re_sign_in" class="btn btn-primary pull-left" style="float: left;height: 22px;margin: 5px 0;padding: 0 5px;" name="btnNextStep" type="submit">Đăng nhập</a>
    </div>

    <div class="groups-field" style="position: relative">
        <input class="span12 id-phone" maxlength="255" required placeholder="Số điện thoại" name="SignUpVatGiaForm[phone]" id="SignUpVatGiaForm_phone" type="text" />        <span class="help-block error herror" id="SignUpVatGiaForm_phone_em_" style="display: none"></span>            </div>

    <div class="groups-field id_event" id="SignUp_phone" style="position: relative">
        <input Autocomplete="Off" required class="span12 id-pass" maxlength="255" placeholder="Mật khẩu" name="SignUpVatGiaForm[password]" id="SignUpVatGiaForm_password" type="password" />        <span class="help-block error herror" id="SignUpVatGiaForm_password_em_" style="display: none"></span>            </div>

    <div class="groups-field" style="position: relative">
        <input class="span12 id-pass" maxlength="255" required placeholder="Nhập lại mật khẩu" name="SignUpVatGiaForm[confirmed_password]" id="SignUpVatGiaForm_confirmed_password" type="password" />        <span class="help-block error herror" id="SignUpVatGiaForm_confirmed_password_em_" style="display: none"></span>            </div>

    <div class="captcha_field">
        <div class="control-group">
            <div class="controls">
                
<div class="big-captcha-wrapper captcha-wrapper row-fluid">
	<div class="captcha-image span5"><img id="yw0" src="captcha/captcha.php" data-url="captcha/captcha.php" alt="" /></div>
	<div class="captcha-input span7">
		<input name="SignUpVatGiaForm[captcha]"  required id="SignUpVatGiaForm_captcha" type="text" />		<a class="captcha-refresh-button" href="" title="Lấy code mới"><i class="glyphicon glyphicon-refresh"></i></a>

	</div>
    </div>                <span class="error-captcha help-block" id="SignUpVatGiaForm_captcha_em_" style="display: none"></span>            </div>
        </div>
    </div>

    <div class="groups-btn">
        <div class="span4">
            <button type="submit" name="btnNextStep" id="sign-up-submit" class="bt">
                Xác nhận            </button>
        </div>
		<input type="hidden" name="action" value="post">
        <div class="span8 back-page">
                                        <a href="<?=$config_url?>">Quay lại </a>
                    </div>
    </div>
    <div class="agreeTermOfService">
        <p style="margin-bottom: 0">
            Chọn đăng ký là bạn đã đồng ý với các                             <a target="_blank" class="cl_txt" href="http://www.vatgia.com/home/help.php?iHpc=8&iHpd=14">Điều khoản dịch vụ</a>
                của Vatgia.com            
        </p>
    </div>
</form></div>
</div>
<script language="JavaScript">
jQuery(function($){
	$(".captcha-refresh-button").click(function(){
		$img = $(this).parent().parent().find("img");
		$img.attr("src",$img.data("url")+"?c="+Math.floor((Math.random() * 100) + 1));
		return false;
	})

	$("#signUpVatgia-form").submit(function(){
		$(".help-block").hide();
		$.ajax({
			data:$(this).serialize(),
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.length > 0){
				$.each(data,function(i,item){
					$("#SignUpVatGiaForm_"+i+"_em_").html(item).show();
					return false;
				})
				}else{
					return true;
				}
				
			}
		
		})
	})


/*
    // check ajax email
    $('#SignUpVatGiaForm_email').blur(function(){
        $('#SignUpVatGiaForm_email_em_').html('');
        $('<input>').attr('type','text').attr('id','post_ajax').attr('name','ajax').attr('value','signUpVatgia-form').appendTo($('#signUpVatgia-form'));
        data = $('#signUpVatgia-form').serialize();
        $.post("thanh-vien/check.html",data).done(function(data) {
			console.log(data);
            text = $.parseJSON(data);
            error = text.email;
            if(error !== null){
                $('#SignUpVatGiaForm_email_em_').html(error);
                $('#SignUpVatGiaForm_email_em_').show();
            }else $('#SignUpVatGiaForm_email_em_').hide();
        });
        $('#post_ajax').remove();
    });
*/
   
});
</script>
<script language="JavaScript">
   
</script>
<script language="JavaScript">
      
</script></div>
</div><!-- content -->
                </div>
            </div>
        </div>
    </div>
	</div>
	</div>