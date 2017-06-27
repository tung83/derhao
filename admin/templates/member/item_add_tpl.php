<div class="box-header with-border">
<?php 
$d->query("select * from #_province order by name desc");
								$rs_province = $d->result_array();
								?>
<?php if ($_REQUEST['act']=='edit') { ?> <h3>Sửa</h3> <?php }else{ ?><h3>Thêm </h3><?php } ?>
</div><div class="box-body">
<script language="javascript">				
	function select_onchange()
	{				
		var a=document.getElementById("id_danhmuc");
		window.location ="index.php?com=<?=$_GET['com']?>&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_danhmuc="+a.value;	
		return true;
	}
	function select_onchange1()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		window.location ="index.php?com=<?=$_GET['com']?>&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_danhmuc="+a.value+"&id_list="+b.value;	
		return true;
	}
	function select_onchange2()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		window.location ="index.php?com=<?=$_GET['com']?>&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value;	
		return true;
	}

	
</script>


<form name="frm" method="post" id="form-register" role="form" action="index.php?com=<?=$_GET['com']?>&act=save&curPage=<?=@$_REQUEST['curPage']?>" enctype="multipart/form-data" class="form-horizontal" >	 




 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<!-- <input type="submit" value="Lưu" class="btn  btn-success" /> -->
	
	<p></p>	
  <div class="col-xs-12">
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

	<div class="ttl"><h4>Thông tin tài khoản</h4></div>

		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-6">
				<input type="email" class="form-control email-input" readonly name="" value="<?=@$item['email']?>" id="inputEmail3" placeholder="Email" required>
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Mật khẩu mới</label>
			<div class="col-sm-6">
				<input type="text" class="form-control password-input" name="reg[password]" id="inputEmail3" placeholder="Mật khẩu" >
			</div>
		</div>
		
	
		
		<div class="ttl"><h4>Thông tin cá nhân</h4></div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Họ tên<span>*</span></label>
			<div class="col-sm-6">
				<input type="text" class="form-control fullname-input" value="<?=@$item['fullname']?>" name="reg[fullname]" id="inputEmail3" placeholder="Tên bạn" required>
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Ngày sinh <span>*</span></label>
				<div class="col-sm-7">
			<div class="">
			<?php
				$bd = explode("-",@$item['birthday']);
				
			?>
			<div class="col-sm-3">
				<div class="fix-row" style="margin-left:-15px">
				<select name="date" class="form-control" required>
					<option value="">Ngày</option>
					<?php for($i=1;$i<=31;$i++){
						$slt = "";
						if($i == $bd[0]){
							$slt = "selected";
						}
						echo  '<option value="'.$i.'" '.$slt.'>'.$i.'</option>';
					}?>
				</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="fix-row">
				<select name="month" class="form-control" required>
					<option value="">Tháng</option>
					<?php for($i=1;$i<13;$i++){
						$slt = "";
						if($i == $bd[1]){
							$slt = "selected";
						}
						echo  '<option value="'.$i.'" '.$slt.'>'.$i.'</option>';
					}?>
				</select>
				</div>
				
			</div>
			<div class="col-sm-3">
				<div class="fix-row">
				<select name="year" class="form-control" required>
					<option value="">Năm</option>
					<?php for($i=date("Y")-18;$i > (date("Y")-70);$i--){
						$slt = "";
						if($i == $bd[2]){
							$slt = "selected";
						}
						echo  '<option value="'.$i.'" '.$slt.'>'.$i.'</option>';
					}?>
				</select>
				</div>
			</div>
		</div>
		</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Giới tính</label>
			<div class="col-sm-9">
				<label class="radio-inline">
				  <input type="radio" name="reg[gender]" id="inlineRadio1" checked value="0"> Nam
				</label>
				<label class="radio-inline">
				  <input type="radio" name="reg[gender]" id="inlineRadio2" value="1"> Nữ
				</label>
			</div>
		</div>
		
		<div class="form-group hide">
			<label for="inputEmail3" class="col-sm-3 control-label">Ảnh của bạn</label>
			<div class="col-sm-6">
			<div style="margin-bottom:5px">
				<?php 
					
						if(!$item['avatar']){
							echo '<img class="img-responsive" src="../upload/no_img.png" />';
						}else{
							echo '<a href="'._upload_member_.$item['avatar'].'" class="fancybox"><img width="200px" class="img-thumbnail" src="'._upload_member_.$item['avatar'].'" /></a>';
						}
					?>
				</div>
				<input type="file" class="form-control avatar-input" name="avatar" id="inputEmail3">
				<span class="help-block">(File ảnh .jpg, .gif, .bmp, .png, dung lượng <= 50KB)</span>
			</div>
		</div>
		
		
		
		<div class="ttl"><h4>Thông tin liên hệ</h4></div>

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Địa chỉ liên hệ <span>*</span></label>
			<div class="col-sm-6">
				<input type="text" class="form-control contact_address-input" value="<?=@$item['contact_address']?>" name="reg[contact_address]" id="inputEmail3" placeholder="Địa chỉ" required/>
			</div>
		</div>

			
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 control-label">Tỉnh thành phố<span>(*)</span></label>
					<div class="col-sm-6">
						<select  name="reg[contact_province]" class="form-control" required >
							<option value="">Chọn</option>
							<?php 
								
								foreach($rs_province as $k=>$v){
									$slt = "";
									if($v['id'] == $item['contact_province']){
										$slt = "selected";
									}
									
									echo '<option value="'.$v['id'].'" '.$slt.'>'.$v['name'].'</option>';
								}
							?>
							
						</select>
					</div>
				</div>
			
		
		
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Số điện thoại<span>*</span></label>
			<div class="col-sm-6">
				<input type="text" class="form-control contact_phone-input" value="<?=@$item['contact_phone']?>" name="reg[contact_phone]" id="inputEmail3" placeholder="Điện thoại" required />
			</div>
		</div>
		
		
	
	
		
		<!-- end hide -->
		
		<div class="form-group last">
			<div class="col-sm-offset-3 col-sm-9">
					<input  type="hidden" name="secret" value="<?=$item['secret']?>">
					<input  type="hidden" name="required" value="1">
					<input  type="hidden" name="has_error" class="has_error" value="1">
					
				<button type="submit" class="btn btn-success btn-sm btn-blue">Sửa thông tin</button>
				<button type="reset" class="btn btn-default btn-sm btn-reset">Nhập lại</button>
				<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" />
			</div>
		</div>
																		

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

   </div>
</form>
<script>

$().ready(function(){
	if($("#m-type").val()){
	toggleRequired($("#m-type").val());
	}
})
function checkValid(){
	$("#form-register").submit(function(){
		return true;
			if($(".has_error").val()==1){
			$options = new Array();
			$options.url = base_url+"/thanh-vien/valid.html";
			$options.data = $(this).serialize()+"&edit=1";
			$options.dataType = "json";
			$options.success = function(data){
			
				console.log(data);
				
				if(data.error.stt){
					$.each(data.error.data,function(i,item){
						$("."+i+"-input").parent().find(".help-block").html(item);
					})
					return false;
				}
				else{
					$(".has_error").val(0);
					$("#form-register").submit();
					
				}
				
				
			
			};
			 initAjax($options);
			 return false;
			 }
		
	
	})


}
function toggleRequired($id){
		$("#tab_1").find("input,select,textarea").each(function(){
			$name = $(this).attr("name");
			$(this).attr("data-name",$name);
			$(this).removeAttr("name");
			attr = $(this).attr("required");
			
			if (typeof attr !== typeof undefined && attr !== false) {
				$(this).removeAttr("required");
				$(this).attr("data-required","required");
			}
		
		})
		$("#tab_2").find("input,select,textarea").each(function(){
			$name = $(this).attr("name");
			$(this).attr("data-name",$name);
			$(this).removeAttr("name");
			attr = $(this).attr("required");
			
			if (typeof attr !== typeof undefined && attr !== false) {
				$(this).removeAttr("required");
				$(this).attr("data-required","required");
			}
		
		})
		$("#tab_"+$id).find("input,select,textarea").each(function(){
		//$("#tab_").find("input,select,textarea").each(function(){
			attr = $(this).data("required");
			$name = $(this).data("name");
			$(this).attr("name",$name);
			if (typeof attr !== typeof undefined && attr !== false) {
				
				$(this).attr("required","true");
			}
		
		})
	
	
	
	}
$().ready(function(){
	
	$("#form-register input[type=text],#form-register input[type=password],#form-register input[type=email],#form-register select,#form-register selected").each(function(){
		if(!$(this).parent().find(".help-block").length){
			$(this).after("<div class='clearfix'></div><span class='help-block red'></span>");
			
		}
	
	})
	$("#form-register").click(function(){
		$(this).find(".help-block").html("");
	})
	checkValid();
	$("#m-type").change(function(){
		if($(this).val()!=''){
			toggleRequired($(this).val());
			$("#tab_1,#tab_2").hide().removeClass("hide");
			$("#tab_"+$(this).val()).fadeIn();
			
			
		
		
		}
	
	
	})

})	


</script>
	
	</div>