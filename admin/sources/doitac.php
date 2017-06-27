<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man_photo":
		get_photos();
		$template = "doitac/photos";
		break;
	case "add_photo":
		$template = "doitac/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "doitac/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
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
function get_photos(){
	global $d, $items, $paging;
	
	$d->setTable('doitac');
	
	$d->setOrder('stt,id desc');
	$d->select('*');
	$d->query();
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=doitac&act=man_photo";
	$maxR=10;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];

}
function get_photo(){
	global $d, $item, $list_cat;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=doitac&act=man_photo");
	
	$d->setTable('doitac');
	
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=doitac&act=man_photo");
	$item = $d->fetch_array();
	$d->reset();
}
function save_photo(){
	global $d;
	$file_name=fns_Rand_digit(0,9,6);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=doitac&act=man_photo");
	
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	$data['ten'] = $_POST['ten'];
	$data['link'] = $_POST['link'];
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	if($id){ // cap nhat
		
			if($photo = upload_image("file", 'jpg|png|gif|JPG|PNG|GIF', _upload_hinhanh,changeTitle($data['ten']))){
				$data['photo'] = $photo;
				
				$d->setTable('doitac');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photo']);
				}
			}
		
			$d->reset();
			$d->setTable('doitac');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=doitac&act=man_photo");
			header("Location:index.php?com=doitac&act=man_photo");
	}{ // them moi
		
			for($i=0; $i<6; $i++){
				if($data['photo'] = upload_image("file".$i, 'jpg|png|gif|JPG|PNG|GIF', _upload_hinhanh,$file_name.$i))
					{
						$data['stt'] = $_POST['stt'.$i];
						$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;
						$data['ten'] = $_POST['ten'.$i];
						$data['link'] = $_POST['link'.$i];
						$d->setTable('doitac');
						if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=doitac&act=man_photo");
					}
			}
			header("Location:index.php?com=doitac&act=man_photo");
		
	}
}


function delete_photo(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('doitac');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=doitac&act=man_photo");
		$row = $d->fetch_array();
		delete_file(_upload_hinhanh.$row['photo']);
		if($d->delete())
		
			header("Location:index.php?com=doitac&act=man_photo");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=doitac&act=man_photo");
	}else transfer("Không nhận được dữ liệu", "index.php?com=doitac&act=man_photo");
}

?>

	
