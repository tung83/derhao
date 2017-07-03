<div id="foot-link">
<div class="box-content">

<a class="toggle-list visible-xs" href=""><i class="fa fa-angle-double-left"></i></a>
<div class="navi">
	<a href="" class="link-1 back-to-top" data-index="0" title="Move to top">Move to top</a>
	
</div>	
	<div class="showbox-email link-3 box">
		<div class="wrap">
		
			<form id="form-email" class="form-horizontal">
  <div class="form-group">
    
		<div class="col-xs-12">
      <input type="name" name="name" required class="form-control" id="inputEmail3" placeholder="<?=_your_name?>:">
   </div>
  </div>
  <div class="form-group">
   
   <div class="col-xs-12">
      <input type="email" name="email" required class="form-control" id="inputEmail3" placeholder="<?=_your_email?>:">
  </div>
  </div>
  <div class="form-group">
    
    <div class="col-sm-12">
      <textarea rows="5" class="form-control" name="content" placeholder="<?=_message?>:"></textarea>
    </div>
  </div>
  
     <button type="submit" class="btn btn-info"><?=_send?>&nbsp;<i class="fa fa-send"></i></button>	
     <button type="submit" class="btn btn-danger close-box"><?=_close?>&nbsp;<i class="fa fa-close"></i></button>
	<span class="wait-process">Please wait.....</span>
   
  </div>
</form>
<script>
 function displayWin(url,name,width,height) {
        var _left = (screen.width - width)/2;
        var _top = (screen.height - height)/2;
        newWin = window.open(url,name,'width=' + width + ',height=' + height + ',left=' + _left + ',top=' + _top + ',location=no,menubar=no,resizable=1,scrollbars=1,status=no,toolbar=0');
        if (newWin) newWin.focus();
		return false;
      }   
	$().ready(function(){
		$("#form-email").submit(function(){
			$(this).find(".wait-process").fadeIn();
			$.ajax({
				data:$(this).serialize(),
				type:"post",
				url:"ajax/contact.html",
				dataType:"json",
				error:function(){
					alert("<?=_send_contact_fail?>");
					$("#form-email").find(".wait-process").fadeOut();
				},
				success:function(data){
					$("#form-email").find(".wait-process").fadeOut();
					if(data.stt==1){
						alert("<?=_send_contact_success?>");
						$("#form-email input,#form-email textarea").val("");
					}else{
						alert("<?=_send_contact_fail?>");
					}
					
				}
			})
			return false;
		})
	})

</script>
		
		</div>
		
		
		
		<div class="showbox-skype link-2 box">
			<?php 
				$d->query("select * from #_yahoo where hienthi = 1 order by stt desc");
				foreach($d->result_array() as $k=>$v){
					echo '<div class="support-item"><a href="skype:'.$v['skype'].'?chat"><i class="fa fa-skype"></i>&nbsp;'.$v['ten'].'</a>	<div><a href="tel:'.$v['dienthoai'].'" title="Tel to '.$v['skype'].'">'.$v['dienthoai'].'</a></div></div>';
				}
			
			?>
		
		</div>
		</div>
		</div>
	
	
	</div>
</div>
<script>
$().ready(function(){
	$w = $("#foot-link .navi a").first().width();
	 $("#foot-link a").each(function(){
		 $index = parseInt($(this).data("index"));
		 $cal = $index*$w;
		$(this).css({backgroundPosition:"0 -"+$cal+"px"});
	 })
	 $(".close-box").click(function(){
		$(this).parents(".box").fadeOut();
		return false;		
	 })
	 $("#foot-link .navi a").click(function(){
		  var target = $("#foot-link").find(".box."+$(this).attr("class"));
		  if(target.length){
			 if(target.is(":visible")){
				 target.fadeOut();
			 }else{
				  $("#foot-link .box").hide();
						target.fadeIn();
				  
			 }
		 
		 return false;
		 
		  }
		 
	 })
	$(".box-content .toggle-list").click(function(){
			$(this).find("i").toggleClass("fa-angle-double-left");
			$(this).find("i").toggleClass("fa-angle-double-right");
			$("#foot-link").toggleClass("active");
			return false;
	})		
	
	
})
</script>