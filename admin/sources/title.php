<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "title/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
		
	default:
		$template = "index";
}

function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_title limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=title&act=capnhat");
		
	$data['ten'] = $_POST['ten'];
	$d->reset();
	$d->setTable('title');
	if($d->update($data))
		header("Location:index.php?com=title&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=title&act=capnhat");
}

?>