<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "meta/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
		
	default:
		$template = "index";
}

function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_meta limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=meta&act=capnhat");
		
	$data['title'] = $_POST['title'];
	$data['keyword'] = $_POST['keyword'];
	$data['description'] = $_POST['description'];
	$d->reset();
	$d->setTable('meta');
	if($d->update($data))
		transfer("Cập nhật thành công", "index.php?com=meta&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=meta&act=capnhat");
}

?>