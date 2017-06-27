<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	
	case "capnhat":
		get_banner();
		$template = "background2/logo_add";
		break;
	case "edit_banner":
		get_banner();
		$template = "background2/logo_add";
		break;	
	case "man":
		get_banners();
		$template = "background2/banner_top";
		break;
	case "save":
		save_banner();
		break;
	#====================================
	case "man_banner":
		get_banner_giua();
		$template = "background2/banner_giua_add";
		break;
	case "save_banner_giua":
		save_banner_giua();
		break;
	
	case "man_phai":
		get_banner_phai();
		$template = "background2/banner_phai_add";
		break;
	case "save_banner_phai":
		save_banner_phai();
		break;
	
	default:
		$template = "index";
}
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}


function get_banners(){
	global $d, $items2;

	$sql = "select * from #_background";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$items2 = $d->result_array();
	
}

	
function get_banner(){
	global $d, $item;
	
	$sql = "select * from #_background where com='background2' and id='".$_GET['id']."'";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_banner(){
	global $d;
	$file_name=fns_Rand_digit(0,9,5);
	
	$id=$_POST['id'];
	//echo dump($id);
	if($id){
	$sql = "select * from #_background where com='background2' and id=".$id;
	$d->query($sql);
	$item = $d->fetch_array();
	}
	
	if($id){ // cap nhat
		if($background = upload_image("file", 'swf|jpg|png|gif', _upload_hinhanh,$file_name)){
			$data['background'] = $background;
			$d->setTable('background');
			$d->setWhere('id', $id);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['background']);
		}
		$data['background'] = $background;
		//echo dump($id);
		$d->setTable('background');
		$d->setWhere('id', $id);
		$d->setWhere('com','background2');
		if($d->update($data))
			transfer("Cập nhật thành công", "index.php");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=background2&act=capnhat");
	}else{ // them moi
		$data['background'] = upload_image("file".$i, 'swf|jpg|png|gif', _upload_hinhanh,$file_name);
		if(!$data['background']) $data['background']="";
		
		$data['com']='background2';
		$d->setTable('background');
		if($d->insert($data))
			transfer("Cập nhật thành công", "index.php");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=background2&act=capnhat");
	
}
}
