<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	
	case "capnhat":
		get_banner();
		$template = "background/logo_add";
		break;
	case "edit_banner":
		get_banner();
		$template = "background/logo_add";
		break;	
	case "man":
		get_banners();
		$template = "background/banner_top";
		break;
	case "save":
		save_banner();
		break;
	#====================================
	case "man_banner":
		get_banner_giua();
		$template = "background/banner_giua_add";
		break;
	case "save_banner_giua":
		save_banner_giua();
		break;
	
	case "man_phai":
		get_banner_phai();
		$template = "background/banner_phai_add";
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

	$sql = "select * from #_photo where com='background'";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$items2 = $d->result_array();
	
}

	
function get_banner(){
	global $d, $item;
	
	$sql = "select * from #_photo where id='".$_GET['id']."'";
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
	$sql = "select * from #_photo where id=".$id;
		$d->query($sql);
		$item = $d->fetch_array();
	}
	
	if($id){ // cap nhat
		if($photo = upload_image("file", 'swf|jpg|png|gif', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('photo');
			$d->setWhere('id', $id);
			$d->select();
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo']);
		}
		$data['photo'] = $photo;
		//echo dump($id);
		$d->setTable('photo');
		$d->setWhere('id', $id);
		
		if($d->update($data))
			transfer("Cập nhật thành công", "index.php");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=background&act=capnhat");
	}else{ // them moi
		$data['photo'] = upload_image("file".$i, 'swf|jpg|png|gif', _upload_hinhanh,$file_name);
		if(!$data['photo']) $data['photo']="";
		
		$data['com']='background';
		$d->setTable('photo');
		if($d->insert($data))
			transfer("Cập nhật thành công", "index.php");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=background&act=capnhat");
	
}
}
