<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define("_table","product_size");
switch($act){

	case "man":
		get_items();
		
		$template = "product_size/items";
		break;
	case "add":
		$admin->initAdd();
		$template = "product_size/item_add";
		break;
	case "edit":	
		$admin->initAdd();		
		get_item();	
		$template = "product_size/item_add";
		
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	#===================================================	
	case "man_danhmuc":
		get_danhmucs();
		$template = "product_size/danhmucs";
		break;
	case "add_danhmuc":		
		$admin->initAdd("product_size_danhmuc");
		$template = "product_size/danhmuc_add";
		break;
	case "edit_danhmuc":		
		$admin->initAdd("product_size_danhmuc");
		get_danhmuc();
		$template = "product_size/danhmuc_add";
		break;
	case "save_danhmuc":
		save_danhmuc();
		break;
	case "delete_danhmuc":
		delete_danhmuc();
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


function get_items(){
	global $d, $items, $paging;
	
	$sql = "select * from #_product_size";
	$sql.=" order by stt desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=".$_GET['com']."&act=man";
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
	
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
	
	$sql = "select * from #_product_size where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,8);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		
	}
	if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_sanpham,$data['tenkhongdau']))
	{
		$data['photo'] = $photo;		
	}
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['id_danhmuc'] = $_POST['id_danhmuc'];
	if($id){
		
		if($data['photo']){
			$d->query("select photo from #_product_size where id = ".$id);
			$row = $d->fetch_array();
			delete_file(_upload_sanpham.$row['photo']);
		}
		$d->setTable('product_size');
		$d->setWhere('id', $id);
		if($d->update($data)){
				
				redirect("index.php?com=".$_GET['com']."&act=man");
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}else{
		
		
		$d->setTable('product_size');
		if($d->insert($data)){
		
				redirect("index.php?com=".$_GET['com']."&act=man");
		
			}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_product_size where id='".$id."'";
		$d->query($sql);
		
		if($d->query($sql))
			redirect("index.php?com=".$_GET['com']."&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_product_size where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			
			$sql = "delete from #_product_size where id='".$id."'";
			if($d->query($sql)){
					$d->query("delete from #_product_size_condition where size_id = ".$id);
			}
			
		}
			
		} redirect("index.php?com=".$_GET['com']."&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
		
		
}





/*---------------------------------*/
function get_danhmucs(){
	global $d, $items, $paging;
	$sql = "select * from #_product_size_danhmuc order by stt desc";
	
	
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=product_size&act=man_danhmuc&type=".@$_GET['type'];
	$maxR=30;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_danhmuc(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product_size&act=man_danhmuc&type=".$_GET['type']);
	
	$sql = "select * from #_product_size_danhmuc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product_size&act=man_danhmuc&type=".$_GET['type']);
	$item = $d->fetch_array();	
}

function save_danhmuc(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,6);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product_size&act=man_danhmuc&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data = array();
	$data['stt'] = $_POST['stt'];
	
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
	
	}
	//initSeo($data);
	if($id){		
		$id =  themdau($_POST['id']);
		
		$data['ngaysua'] = time();
		
		$d->setTable('product_size_danhmuc');
		$d->setWhere('id', $id);
		if($d->update($data)){
			
			redirect("index.php?com=product_size&act=man_danhmuc&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
			
		}	
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product_size&act=man_danhmuc&type=".$_GET['type']);
	}else{			
				
		
		$data['ngaytao'] = time();
		
		$d->setTable('product_size_danhmuc');
		if($d->insert($data)){
			$d->query("select id from #_product_size_danhmuc order by stt desc limit 1");
			$r = $d->fetch_array();
			
			redirect("index.php?com=product_size&act=man_danhmuc&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product_size&act=man_danhmuc&type=".$_GET['type']);
	}
}

function delete_danhmuc(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();		
			//Xóa danh m?c c?p 1
			$sql = "delete from #_product_size_danhmuc where id='".$id."'";
		if($d->query($sql))
			redirect("index.php?com=product_size&act=man_danhmuc&type=".$_GET['type']);
		else
			transfer("Xóa dự liệu bị lỗi", "index.php?com=product_size&act=man_danhmuc&type=".$_GET['type']);
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			
				$sql = "delete from #_product_size_danhmuc where id='".$id."'";
				$d->query($sql);
				
			
		} redirect("index.php?com=product_size&act=man_danhmuc&type=".$_GET['type']);} else transfer("Không nhận được dữ liệu", "index.php?com=product_size&act=man_danhmuc&type=".$_GET['type']	    );
}

