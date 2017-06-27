<link href="assets/css/support.css" rel="stylesheet" type="text/css" />
<?php
$d->query("select * from #_yahoo where hienthi = 1 order by stt asc");
if($d->num_rows() > 0){
$rs_yahoo = $d->result_array();
?>
<div id="support-footer">
	<div class="title-footer">HỖ TRỢ TRỰC TUYẾN</div>
	<div class="clearfix"></div>
	<div class="content">
		
		<?php
			foreach($rs_yahoo as $k=>$v){
				echo '<div class="support-item">';
				echo '<div><strong>&raquo;&nbsp;'.$v['ten'].'</strong></div>';
				echo '<div>';
				if($v['yahoo']){
					echo '<a class="pull-left" style="margin-right:7px" href="ymsgr:sendIM?'.$v['yahoo'].'"><img   src="assets/img/yahoo.png"></a>';
				}
				if($v['skype']){
				
					echo '<a class="pull-left" style="margin-right:7px"  href="skype:'.$v['skype'].'?chat"><img   src="assets/img/skype.png"></a>&nbsp;&nbsp;&nbsp;';
				}
				
				if($v['dienthoai']){
					echo ''.str_replace("-","<br>",$v['dienthoai']).'';
				}
				echo '<div class="clearfix"></div>';
				echo '</div>';
				if($v['email']){
					echo '<div>'.str_replace("-","<br>",$v['email']).'</div>';
				}
				echo '</div>';
			
			}
		
		?>
	
	</div>
</div>
<script>
$().ready(function(){
	setTimeout(function(){
	$h = $("#support-footer .content").height()+11;
	$("#support-footer").css({bottom:-$h,"visibility":"inherit"});
	
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
	},2000)
	
})
</script>
<?php } ?>


