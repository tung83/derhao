<?php
$d->query("select * from #_yahoo where hienthi = 1 order by stt asc");
if($d->num_rows() > 0){
$rs_yahoo = $d->result_array();
?>
<div id="support-footer" class="">
	<div class="title-footer"><a href=""><img src="assets/img/support_s.png" /></a></div>
	<div class="content">
		
		<?php
			foreach($rs_yahoo as $k=>$v){
				echo '<div class="support-item">';
				echo '<div><strong>&raquo;&nbsp;'.$v['ten'].'</strong></div>';
				echo '<div>';
				if($v['yahoo']){
					echo '<a class="pull-left" style="margin-right:7px" href="ymsgr:sendIM?'.$v['yahoo'].'"><img  width=20 src="assets/img/yahoo.png"></a>';
				}
				if($v['skype']){
				
					echo '<a class="pull-left" style="margin-right:7px"  href="skype:'.$v['skype'].'?chat"><img  width=20 src="assets/img/skype.png"></a>&nbsp;&nbsp;&nbsp;';
				}
				
				if($v['dienthoai']){
					echo ''.$v['dienthoai'].'';
				}
				echo '<div class="clearfix"></div>';
				echo '</div>';
				if($v['email']){
					echo '<div><a href="mailto:'.$v['email'].'">'.$v['email'].'</a></div>';
				}
				echo '</div>';
			
			}
		
		?>
	
	</div>
</div>
<style>
	#support-footer:hover{
	right:0;
	
	}
	#support-footer .title-footer{width: 28px;
float: left;}
	#support-footer{-moz-transition: all 2s ease;
-o-transition: all 2s ease;
-ms-transition: all 2s ease;
transition: all 0.3s ease;position:fixed;right:-172px;top:300px;}
	#support-footer .content{padding:5px;background:rgba(255, 255, 255, 0.69);height:240px;border:1px solid #ccc;border-left:0;float:left}
	#support-footer .content .support-item{border-bottom:1px dashed #ccc}
	#support-footer .content strong{color:#A05902}
	
</style>
<script>
$().ready(function(){
	//$h = $("#support-footer .content").height()+10;
	//	$("#support-footer").css({bottom:-$h,"visibility":"inherit"});
	/*
	$("#support-footer .title-footer").click(function(){
		if($(this).hasClass("active")){
			$("#support-footer").animate({bottom:-$h});
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
			$("#support-footer").animate({bottom:0});
		
		}
		
		
		return false;
	})
	*/
})
</script>
<?php } ?>


