<script>
	$().ready(function(){
	$(".fancybox-sya").fancybox({
	
		autoSize:false,
		width:600,
		height:115,
		beforeClose:function(){
			window.location.href='<?=$config_url.'/thanh-vien/tin-dang-hien-thi.html'?>';
		
		}
		
	
	});
	if(1==<?=@$success?>){
		$(".fancybox-sya").click();
	
	}
	})

</script>
<script src="assets/css/member/SimpleAjaxUploader.min.js" type="text/javascript"></script>
<script src="assets/tinymce/tinymce.min.js" type="text/javascript"></script>
<a href="#success-post" class="fancybox-sya"></a>
<div class="hide">
	<div id="success-post">
		<div class="col-sm-12">
			
			<div class="alert alert-success" role="alert">
				<p><strong>CHỈNH SỦA TIN THÀNH CÔNG!</strong></p>
				Cảm ơn bạn đã đăng tin. Chúng tôi sẽ kiểm tra tin của bạn trong thời gian sớm nhất. Xin cám ơn
			
			
			</div>
		</div>
	
	</div>

</div>

<div class="main-member-place">
	<div class="title"><h2>Chỉnh sửa tin</h2></div>
	<div class="content">
		
		
	<form class="form-horizontal" role="form" action="" id="form-submit" method="post" enctype="multipart/form-data">
	 <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Tình trạng</label>
    <div class="col-sm-8">
		<?php
			switch($item['tinhtrang']){
				case '-1':
					echo '<p style="color:red"><i class="glyphicon glyphicon-remove"></i>&nbsp;Không được duyệt</p><p><div style="border:1px solid red;color:red;padding:3px">'.$item['msg'].'</div></p>';
					break;
				case '0':
					echo '<span style="color:blue"><i class="glyphicon glyphicon-time"></i>&nbsp;	Đang chờ duyệt</span>';
					break;
				default:
					echo '<span style="color:green"><i class="glyphicon glyphicon-ok"></i>&nbsp;Đã được duyệt</span>';
					break;
			}
			?>
	 
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Tiêu đề tin <span>*</span></label>
    <div class="col-sm-8">
      <input type="text" name="p[title]" value="<?=$item['title']?>"  class="form-control" id="inputEmail3" placeholder="Tiêu đề tin" required>
	 
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Hình ảnh <span>*</span></label>
    <div class="col-sm-8">
		<?php
		
			echo '<div style="text-align:center;margin-bottom:10px"><img src="'._upload_l.$item['thumb'].'"></div>';
		
		
		?>
      <input type="file" name="file"  class="form-control" id="inputEmail3"  >
	  
    </div>
  </div>
  
  
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-3 control-label">Loại giao dịch <span>*</span></label>
    <div class="col-sm-9">
	<?php
		
		
		foreach($loaigd as $k=>$v){?>
			<?php
				$checked = '';
				if($item['id_loaigd'] == $k){
					$checked = "checked";
				}
			
			?>
			<label class="radio-inline">
				<input type="radio" name="p[id_loaigd]"  <?=$checked?> id="inlineRadio1" value="<?=$k?>"> <?=$v?>
			</label>
			
		
		<?php  }
	
	?>
		
    </div>
  </div><!-- end form-group -->
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-3 control-label">Loại BDS <span>*</span></label>
    <div class="col-sm-9">
	<?php
		
		
		foreach($loaibds as $k=>$v){?>
			<?php
				$checked = '';
				if($item['id_loaibds'] == $k){
					$checked = "checked";
				}
			
			?>
			<label class="radio-inline">
				<input type="radio" name="p[id_loaibds]"  <?=$checked?> id="inlineRadio1" value="<?=$k?>"> <?=$v?>
			</label>
			
		
		<?php }
	
	?>
		
    </div>
  </div><!-- end form-group -->
  
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-3 control-label">Khu vực <span>*</span></label>
    <div class="col-sm-9">
		<div class="col-sm-3">
			<div class="row">
				 <select class="form-control input-sm tinhtp" name="p[id_tinh]" required>
				 <option value="">-Chọn tỉnh-</option>
				 <?php
					foreach($tinhtp as $k=>$v){
						
							$selected = '';
							if($item['id_tinh'] == $k){
								$selected = "selected";
							}
						
					
						echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
					
					}
				 ?>
				 </select>
				 
			</div>
		</div>	<?php
			//echo  $item['id_tinh'];
				//	check($quanhuyen2);
				
				?>
		<div class="col-sm-5">
				
				 <select class="form-control input-sm quanhuyen" name="p[id_quanhuyen]" required>
				 <option value="">Chọn quận - huyện</option>
					<?php
						foreach($quanhuyen2[$item['id_tinh']] as $k=>$v){
							$selected = '';
							if($item['id_quanhuyen'] == $v['id']){
								$selected = "selected";
							}
							echo '<option value="'.$v['id'].'" '.$selected.'>'.$v['name'].'</option>';
						
						}
					
					?>
				
				 </select>
				 
			
		</div>	
		<div class="col-sm-4">
		<div class="row">
			 <input type="text" name="p[duong]" value="<?=$item['duong']?>"  class="form-control input-sm" id="inputEmail3" placeholder="Tên đường" >
		</div>	
		</div>	
    </div>
  </div><!-- end form-group -->
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Diện tích <span>*</span></label>
    <div class="col-sm-8">
		<div class="col-sm-5">
		<div class="row">
			<input type="text" name="p[dientich]" required value="<?=$item['dientich']?>"  class="form-control input-sm" id="inputEmail3" placeholder="Diện tích" >
			 <span class="">ví dụ 10m x 10m</span>
		</div>
	  
		</div>
		
		<div class="col-sm-5">
		<div class="fix-row">
			<input type="text" name="p[dtsd]" required value="<?=$item['dtsd']?>"  class="form-control input-sm" id="inputEmail3" placeholder="Diện tích sử dụng" >
			 <span class="">ví dụ 300m</span>
		</div>
	  
		</div>
    </div>
  </div><!-- end group -->
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-3 control-label">Hướng <span>*</span></label>
    <div class="col-sm-9">
	<?php
		
		
		foreach($huong as $k=>$v){?>
			<?php
				$checked = '';
				if($item['id_huong'] == $k){
					$checked = "checked";
				}
			
			?>
			<label class="radio-inline">
				<input type="radio" name="p[id_huong]"  <?=$checked?> id="inlineRadio1" value="<?=$k?>"> <?=$v?>
			</label>
			
		
		<?php }
	
	?>
		
    </div>
  </div><!-- end form-group -->
  
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Giá <span>*</span></label>
	<div class="col-sm-3">

		 <input type="text"  name="a[gia]" required value="<?=$item['gia']?>" class="form-control input-sm" id="inputEmail3" >
		
	</div>
    <div class="col-sm-2">
	<div class="row">
     <select class="form-control input-sm" name="a[cost]">
			
			<?php
			
				$s1='';$s2='';$s3='';
				if($item['cost'] == 'nvd'){
					$s1 = "selected";
				}
				if($item['cost'] == 'usd'){
					$s2 = "selected";
				}
				if($item['cost'] == 'gold'){
					$s3 = "selected";
				}
			
			?>
		  <option <?=$s1?> value="vnd">VNĐ</option>
		  <!-- <option <?=$s2?> value="usd">USD</option>
		  <option <?=$s3?> value="gold">Lượng vàng</option> -->
		  
		</select>
	</div>
    </div>
	
	<div class="clearfix"></div>
	
	
  </div><!-- end form-group -->
  
  
 <div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Mô tả<span>*</span></label>
		<div class="col-sm-10">
			<textarea name="p[description]" class='form-control' rows="6" required><?=$item['description']?></textarea>
		</div>
  </div><!-- end form-group -->	
    
	
  <div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Thông tin khác</label>
		<div class="col-sm-10 " style="border:1px solid #ccc;border-radius:5px">
			<?php
				
				foreach((array)json_decode($item['config_post']) as $k=>$v){
				
				$array_config[$k] = $v;
				}
				foreach($rs_post_config as $k=>$v){
				
					
					
					echo '<div style="padding:5px 0" class="col-sm-6"><div class="row">';
					if($v['loai'] == 1){
						
					echo '<input type="checkbox" class="hide" checked name="config['.$v['id'].']" value="0">';
					$checked = false;
					if(@$array_config[$v['id']]==1){
						$checked = "checked";
					}
					echo '<div class="col-sm-12"><div class="checkbox"><label><input type="checkbox" '.$checked.' name="config['.$v['id'].']" value="1">'.$v['ten_vi'].' </label></div></div>';
					//echo '<div class="col-sm-12">'.$v['ten_vi'].'</div>';
					/* echo '<div class="col-sm-12"><label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
</label></div>'; */
					}else{
						echo '<div class="col-sm-12">'.$v['ten_vi'].'</div>';
					}
					
					
					if($v['loai'] != 1){
						echo '';
						echo '<div class="col-sm-10">';
						if($v['loai'] == 2){
							
							
							echo '<input type="text" value="'.$array_config[$v['id']].'" name="config['.$v['id'].']"  class="form-control input-sm" id="inputEmail3" >';
						
						}
						if($v['loai'] == 3){
							echo '<select  name="config['.$v['id'].']"  class="form-control input-sm">';
							foreach(json_decode($v['value']) as $k3=>$v3){
								$sel = '';
								if($array_config[$v['id']]==$k3){
									$sel = "selected";
								}
								echo '<option value="'.$k3.'" '.$sel.'>'.$v3->name.'</option>';
							}
							echo '</select>';
						
						}
						echo '</div>';
					}
					echo '</div></div>';
				
				}
			
			
			?>
		</div>
  </div><!-- end form-group -->	
  
  
  
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Hình ảnh</label>
	<div id="result"></div>
    <div class="col-sm-9">
      <strong>Đăng nhiều ảnh lớn đẹp để sản phầm được tìm kiếm nhiều hơn!</strong>
	<div id="target-div8"></div>
	<div class="content-box">
						<div class="clear">						
							<input type="button" id="upload-btn" class="btn btn-primary btn-large clearfix" value="Choose file">
              <span style="padding-left:5px;vertical-align:middle;"><i>PNG, JPG, or GIF (500K max file size)</i></span>
							<div id="errormsg" class="clearfix redtext">
							</div>	              
							
							
							<div class="input-file-row-1">
							</div>	
							<div id="progress">
							
							</div>
						</div>

					</div>	
					<div class="clearfix"></div>
					<a href="" onclick="insertImgToText();return false" class="hide insert-img">Chèn tất cả hình vào phần mô tả</a>
					
					
			</div>
		</div><!-- end form-group -->
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Nội dung tin <span>*</span></label>
		<div class="col-sm-10">
			<textarea name="p[content]" class="textarea" ><?=$item['content']?></textarea>
		</div>
  </div><!-- end form-group -->	
  
  <input type="hidden" id="md5" name="md5"  value="<?=md5(time())?>" />
  <div class="form-group">
		<label for="inputEmail3" class="col-sm-4 control-label">Bản đồ đường đi</label>
		<div class="col-sm-12">
			<input type="text" name="a[map]" value="<?=$item['map']?>" class="iframe-refresh form-control input-sm" />
			<span class="help-block">Chèn iframe google map (Chiều dài: 700px chiều cao 400px)</span>
			<div class="clearfix">
				<div id="iframe-into">
					<?=htmlspecialchars_decode($item['map'])?>
				
				</div>
			</div>
		</div>
  </div><!-- end form-group -->	
  <?php include _template."member/tagit.php";?>
 <div class="panel panel-info">
  <div class="panel-heading">Thông tin liên lạc</div>
  <div class="panel-body">
    <div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">Tên người đăng <span>*</span></label>
		
		<div class="col-sm-8">
		  <input type="text" class="form-control" name="u[name]" id="inputEmail3" required value='<?=$_SESSION['member_log']['full_name']?>' required>
		 
		</div>
	</div><!-- end form-group -->
	
	 <div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">Địa chỉ <span>*</span></label>
		
		<div class="col-sm-8">
		  <input type="text" name="u[address]"  value="<?=$item['address']?>"required class="form-control" id="inputEmail3">
		  
		</div>
	</div><!-- end form-group -->
	
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">Điện thoại <span>*</span></label>
		
		<div class="col-sm-8">
		  <input type="text" name="u[phone]"  value="<?=$item['phone']?>" required class="form-control" id="inputEmail3">
		  
		</div>
	</div><!-- end form-group -->
  <div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">Email <span>*</span></label>
		
		<div class="col-sm-8">
		  <input type="email" name="u[email]"  value="<?=$item['email']?>" required class="form-control" value='<?=$_SESSION['member_log']['email']?>' required id="inputEmail3">
		  
		</div>
	</div><!-- end form-group -->
	
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">Liên hệ yahoo</label>
		
		<div class="col-sm-8">
		  <input type="text" name="u[yahoo]"  value="<?=$item['yahoo']?>" class="form-control"   id="inputEmail3">
		  
		</div>
	</div><!-- end form-group -->
	
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">Liên hệ skype</label>
		
		<div class="col-sm-8">
		  <input type="text" name="u[skype]" value="<?=$item['skype']?>" class="form-control"   id="inputEmail3">
		  
		</div>
	</div><!-- end form-group -->
	
  </div>
</div>


<!-- end panel --> 
  <div class="form-group">
		<label for="inputEmail3" class="col-sm-3 control-label">Mã bảo vệ <span>*</span></label>
		<div class="col-sm-2">
		<div class="row">
		<img width='100%' id="yw0" src="captcha/captcha.php" data-url="captcha/captcha.php" alt="" />
		</div>
		</div>
		<div class="col-sm-3">
		<div class="row">
		 <input name="captcha"  class="form-control" required id="SignUpVatGiaForm_captcha" type="text" /><span class="captcha-status"></span></div></div>	<div class="col-sm-1">	<a class="captcha-refresh-button" href="" title="Lấy code mới"><i class="glyphicon glyphicon-refresh"></i></a></div>
		 
		
	</div><!-- end form-group -->
	
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">SỬA TIN</button>
	  <input type="hidden" name="submit" value="action" />
	  <input type="hidden" name="id" value="<?=$item['id']?>" />
    </div>
  </div>
</form>
	
	
	</div>


</div>


<script>
var progress = document.getElementById('progress'), // progress bar
    loaderImg = document.getElementById('loaderImg');  // "loading" animated GIF

var uploader = new ss.SimpleUpload({
      button: 'upload-btn',
      url: 'thanh-vien/upload.html', // server side handler
      progressUrl: 'uploadProgress.php',
      responseType: 'json',
      name: 'uploadfile',
      multiple: true,
	  maxUploads:3,
	  maxSize:1024,
	  queue :true,
	  data:{md5:$("#md5").val()},
      allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'], // for example, if we were uploading pics
      hoverClass: 'ui-state-hover',
      focusClass: 'ui-state-focus',
      disabledClass: 'ui-state-disabled',   
      onSubmit: function(filename, extension) {
	  
         // Create the elements of our progress bar
          var progress = document.createElement('div'), // container for progress bar
              bar = document.createElement('div'), // actual progress bar
              fileSize = document.createElement('div'), // container for upload file size
              wrapper = document.createElement('div'), // container for this progress bar
              progressBox = document.getElementById('progressBox'); // on page container for progress bars

          // Assign each element its corresponding class
          progress.className = 'progress';
          bar.className = 'bar';            
          fileSize.className = 'size';
          wrapper.className = 'wrapper';

          // Assemble the progress bar and add it to the page
          progress.appendChild(bar); 
          wrapper.innerHTML = '<div class="name">'+filename+'</div>'; // filename is passed to onSubmit()
          wrapper.appendChild(fileSize);
          wrapper.appendChild(progress);                                       
          //progressBox.appendChild(wrapper); // just an element on the page to hold the progress bars    

          // Assign roles to the elements of the progress bar
          this.setProgressBar(bar); // will serve as the actual progress bar
          this.setFileSizeBox(fileSize); // display file size beside progress bar
          this.setProgressContainer(wrapper); // designate the containing div to be removed after upload*/
        },

       // Do something after finishing the upload
       // Note that the progress bar will be automatically removed upon completion because everything 
       // is encased in the "wrapper", which was designated to be removed with setProgressContainer() 
	  onSubmit: function( filename, extension ){
			$num  = parseInt($("#num").val());
			if($num == 6){
				if($("#is_alert").val()==1){
					alert("Upload toi da 6 file");
				}
				$("#is_alert").val(1);
				uploader.disable();
				return false;
			}
			else{
				$num++;
				$("#num").val($num);
			}
			checkIsMaxFile();
			
	  
	  },
      onComplete:   function(filename, response) {
		//console.log(filename);
		//console.log(response);
          if (!response) {
            alert(filename + 'upload failed');
            return false;
          }else{
		
			$content = '<div class="upload-file-container"><a href="" onclick="rfile(this);return false;" data-file="'+response.file+'" class="remove"></a>';
			$content+='<img src="'+response.file+'"></div>';
			$(".input-file-row-1").append($content);
			if($(".input-file-row-1 .upload-file-container").length % 3 == 0){
				
			//$(".input-file-row-1").append('<div class="clearfix"></div>');
			}
		  }
          // Stuff to do after finishing an upload...
        }
});
function checkIsMaxFile(){
	$num = $("#num").val();
	if($num > 0){
		$(".insert-img").removeClass("hide").show();
	}else{
		$(".insert-img").hide();
	
	}	
	
	
}

function rfile(obj){
	obj = $(obj);
	if(confirm("Xóa hình này?")){
	$.post("thanh-vien/remove.html",{file:obj.data("file")},function(){
		obj.parent().remove();
		$num  = parseInt($("#num").val());
		$num--;
		$("#num").val($num);
		
		$("#is_alert").val(0);
		uploader.enable();
	})
	checkIsMaxFile();
	}
}
function insertImgToText(){
	$content = '';
	$(".input-file-row-1").find("img").each(function(){
		$content+="<img src='<?=$config_url."/"?>"+$(this).attr("src")+"'>";
	})
	
	
	
	tinymce.activeEditor.execCommand('mceInsertContent', false, $content);
	
}

$().ready(function(){
	$(".captcha-refresh-button").click(function(){
		$(this).parent().parent().find("img").attr("src","captcha/captcha.php");
		return false;
	})
	$(".quanhuyen").click(function(){
		if($(".tinhtp").val() == 0){
			alert("Vui lòng chọn tỉnh - thành phố!");
			$(".tinhtp").focus();
		}
	})
	
	$json = <?=json_encode($quanhuyen2)?>;
	$(".tinhtp").change(function(){
	$(".quanhuyen").find("option").not(":first").remove();
	$obj = $(this);
			$.each($json,function(i,item){
			if(i==$obj.val()){
				$.each(item,function($i2,$item2){
					
						
						$(".quanhuyen").append("<option value='"+$item2.id+"'>"+$item2.name+"</option>");
					
					
				})
			
			}
		})
		
	
	})
	
	
	
	$(".iframe-refresh").change(function(){
		$("#iframe-into").html($(this).val());
		$("#iframe-into").find("iframe").attr("src",$("#iframe-into").find("iframe").attr("src")+"&output=embed");
		/*if($("#iframe-into").width()!=585){
			alert("Map có chiều dài 585px");
			$("#iframe-into").html("");
			$(".iframe-refresh").val("");
		}
		if($("#iframe-into").height()!=400){
			alert("Map có chiều rộng 400px");
			$("#iframe-into").html("");
			$(".iframe-refresh").val("");
		}*/
	})
})	

</script>

<script type="text/javascript">
tinymce.init({
    selector: ".textarea",
	skin:'xenmce',
	document_base_url: '<?=$config_url.$f?>/',
	height:500,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks  ",
        "insertdatetime media table contextmenu paste "
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent "
});

</script>
<input type="hidden" id="num" value="0" />
<input type="hidden" id="is_alert" value="0" />

<style>
.prev_container{
	overflow: auto;
	width: 300px;
	height: 135px;
}

.prev_thumb{
	margin: 10px;
	height: 100px;
	width: 100px;
}
</style>
<style>
.main-member-place .title{
	border-bottom:1px solid #00BBD6;
}
.main-member-place .title h2{
	font-size:20px;
	
	font-weight:normal;
	margin:0;
	margin-bottom:5px;
}
.main-member-place form{
	margin-top:10px;
}
.main-member-place form .pull-left.is{
	height:30px;
	line-height:30px;
	padding:0 4px;

}
.main-member-place form  .help-block.col-sm-offset-3{
	padding-left:15px;
	color:red;
	
	font-weight:normal;

}
.main-member-place form  .help-block.col-sm-offset-3 label{font-weight:normal;}





#preview
{
color:#cc0000;
font-size:12px
}
.imgList 
{
max-height:150px;
margin-left:5px;
border:1px solid #dedede;
padding:4px;	
float:left;	
}


.input-file-row-1:after {
    content: ".";
    display: block;
    clear: both;
    visibility: hidden;
    line-height: 0;
    height: 0;
}
.input-file-row-1 .remove{
	background:url(assets/img/remove.png) no-repeat;
	width:30px;
	height:30px;
	float:left;
	position: absolute;
right: 0;
top: -2px;
	
	}
.input-file-row-1{
    display: inline-block;
	margin-top: 25px;
	position: relative;
}

html[xmlns] .input-file-row-1{
    display: block;
}

* html .input-file-row-1 {
    height: 1%;
}

.upload-file-container { 
	position: relative; 
	width: 100px; 
	height: 100px; 
	overflow: hidden;	
	background: url(http://i.imgur.com/AeUEdJb.png) top center no-repeat;
	float: left;
	margin:0px 10px;
} 

.upload-file-container:first-child { 
	
} 

.upload-file-container > img {
	width: 88px;
height: 88px;
border-radius: 5px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
margin-left: 6px;
margin-top: 2px;
}

.upload-file-container-text{
	font-family: Arial, sans-serif;
	font-size: 12px;
	color: #719d2b;
	line-height: 17px;
	text-align: center;
	display: block;
	position: absolute; 
	left: 0; 
	bottom: 0; 
	width: 100px; 
	height: 35px;
}

.upload-file-container-text > span{
	border-bottom: 1px solid #719d2b;
	cursor: pointer;
}

.upload-file-container input  { 
	position: absolute; 
	left: 0; 
	bottom: 0; 
	font-size: 1px; 
	opacity: 0;
	filter: alpha(opacity=0);	
	margin: 0; 
	padding: 0; 
	border: none; 
	width: 70px; 
	height: 50px; 
	cursor: pointer;
}
.captcha-refresh-button{
	position: relative;
	top: 6px;
}







</style>
<script>
$().ready(function(){
	$("#SignUpVatGiaForm_captcha").change(function(){
		$(".captcha-status").hide();
		$cap = $("#SignUpVatGiaForm_captcha").val();
		$.post("thanh-vien/checkcaptcha.html",{cap:$cap},function(data){
			
			if(data==1){
				$("#form-submit").submit();
				return true;
			}else{
				$(".captcha-status").show().html("Mã bảo vệ không đúng").css("color","red");
				
				$("#SignUpVatGiaForm_captcha").val('');
				return false;
			}
		})
		return false;
	})
	
	
	})

</script>

