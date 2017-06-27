<meta charset="utf-8">

<?php


$type = $_GET['type']	;


include "admin/lib/simplehtmldom/simple_html_dom.php";
$html = file_get_html('https://hsc.com.vn/vn/stock/hose');

echo $html;die;


if($type=="1"){
	echo '<link href="http://hcm.24h.com.vn/css/ty_gia-2014.css?v=20140521?ver=20140708" type="text/css" rel="stylesheet" />';
	$html = file_get_html('http://hcm.24h.com.vn/ttcb/tygia/tygia.php');
	
	
	echo $html->find(".tb-giaVang",0);
}

if($type=="2"){
	echo '<link href="http://chungkhoan.24h.com.vn/css/style.css" type="text/css" rel="stylesheet" />';
	
	$html = file_get_html('http://chungkhoan.24h.com.vn');
	
	echo $html;
}
if($type=="3"){
	echo '<link href="http://hcm.24h.com.vn/css/thoi_tiet-2014.css" type="text/css" rel="stylesheet" />';
	
	$html = file_get_html('http://hcm.24h.com.vn/ttcb/thoitiet/thoitiet.php');
	
	echo $html->find(".thoiTietBox",0)->find("table",0);
}

