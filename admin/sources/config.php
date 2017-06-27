<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "config/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
		
	default:
		$template = "index";
}

function get_gioithieu(){
	global $d, $items;

	$sql = "select * from #_config";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$items = $d->result_array();
	
}

function save_gioithieu(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=config&act=capnhat");
	
	if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_hinhanh,md5(time()))){
		$data['photo'] = $photo;
		$data['thumb'] = create_thumb($data['photo'], 120,80, _upload_hinhanh,md5(time()));
		
	}
	foreach($_POST['config'] as $k=>$v){
		$d->reset();
		$d->setTable('config');
		$d->setWhere("`key`",$k);
		if(!$data['photo']){
			$data['photo'] = $v;
		}
		if($k=="background"){
		
			$d->update(array("content"=>$data['photo']));
		}else{
			$d->update(array("content"=>$v));
		}
		
		
	}
		header("Location:index.php?com=config&act=capnhat");
	
}

?>
