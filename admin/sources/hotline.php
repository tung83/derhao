<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "hotline/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
		
	default:
		$template = "index";
}

function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_hotline limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d,$config;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=hotline&act=capnhat");
	if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_hinhanh,"logo"))
	{
		$data['logo'] = $photo;	
	}
	foreach($config['lang'] as $k=>$v){
		$data['slogan_'.$v] = $_POST['slogan_'.$v];
		$data['ten_'.$v] = $_POST['ten_'.$v];
		$data['dienthoai_'.$v] = $_POST['dienthoai_'.$v];
		$data['email_'.$v] = $_POST['email_'.$v];
		$data['diachi_'.$v] = $_POST['diachi_'.$v];
		$data['fax_'.$v] = $_POST['fax_'.$v];
		$data['hotline_'.$v] = $_POST['hotline_'.$v];
		
	}
	$data['twister'] = $_POST['twister'];
	$data['youtube'] = $_POST['youtube'];
	$data['google_plus'] = $_POST['google_plus'];
	$data['facebook'] = $_POST['facebook'];
	
	
	$d->reset();
	$d->setTable('hotline');
	if($d->update($data))
		transfer("Cập nhật thành công", "index.php");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=hotline&act=capnhat");
}

?>