<?php 
header("Content-type: text/css");
$d->query("select * from #_background where id = 1");
$b = $d->fetch_array();
	
	$str = "url("._upload_hinhanh_l.$b['photo'].") ".$b['repeat']." ".$b['position']." ".$b['attachment'];
if($b['type']=="color"){
	$str = $b['color'];
}
if($b['type']=="color - background"){
	$str = $b['color']." ".$str;
}
echo 'body{background:'.$str.' !important}';
die;