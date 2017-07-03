<script src="assets/plugins/bxslider/jquery.bxslider.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="assets/plugins/bxslider/jquery.bxslider.css" type="text/css">
<link rel="stylesheet" href="assets/css/slider-bx.css" type="text/css">
<?php
$d->reset();
$_title  = _wellcome_to_derhao;
$_type = "slider"; 
$cls = "type_1";
if(isset($slider_cls)){
	$_cls = $slider_cls;
}
if(isset($slider_title)){
	$_title = $slider_title;
}
if(isset($slider_type)){
	$_type = $slider_type;
}

if($_type=="news"){
	$_type = "instock";
}
$d->query("select * from #_slider where hienthi = 1	and type='$_type' order by stt,id desc");
$slider = $d->result_array();
if($source=="product" & isset($_GET['id'])){
	
}else{
	
$ar_cmd = array(
		changeTitle(_about)=>13,
		changeTitle(_fabric)=>14,
		changeTitle(_product)=>15,
		changeTitle(_promotion)=>16
		);
$cmd_id = $ar_cmd[$com];
if($template=="index"){
	$cmd_id = 7;	
}
$r['ten_'.$lang] = $title_tcat;
if($cmd_id){
	$d->query("select ten_$lang from #_baiviet where id = '".$cmd_id."'");
	$r = $d->fetch_array();
}

?>
<div class="container-fluid">
<div class="row">
<div class="wrap-slider stellar fixed-slider"  data-stellar-ratio="0.5" >
<div id="slider-ultimate" class="rel" data-ste>
 <ul class="bx">
	<?php 
		foreach($slider as $k=>$v){
		echo ' <li><a href="'.$v['link'].'">'
                    . '<img class="img-responsive" src="'.$config_url.'/'._upload_hinhanh_l.$v['photo'].'" alt="'.$v['ten'].'" title="'.$v['ten'].'"></img></a></li>';
			
	}
	?>
    </ul>
</div>
</div>	
<div class="fixed-slider inset">
	<?='<img class="img-responsive " style="visibility:hidden" src="'.$config_url.'/'._upload_hinhanh_l.$v['photo'].'" alt="'.$v['ten'].'">';?>
</div>
</div>
</div>
<?php }?>
<script>
$().ready(function(){
	$(".bx").bxSlider({
		pager:0,
		auto:0,
		autoControls: true,
		pause:4000,
                mode: 'fade',
                captions: true,
    });
	$sl_ = $(".title-nav.type_2");
	if($sl_.length){
		$sl_.html("<div class='rel'><span>"+$sl_.html()+"</span></div>");
		$sl_.find("span").height($sl_.find("span").height()).css({top:"0"});
	}
	
	$(".bx-controls-direction").addClass("hidden-xs");
	
	
})  
</script>	  
