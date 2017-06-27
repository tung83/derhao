<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define('_table','weblink');
switch($act){
	case "man":
		get_items();
		
		$template = "weblink/items";
		break;
	case "add":
		$admin->initAdd();
		$template = "weblink/item_add";
		break;
	case "edit":		
		get_item();	
		$admin->initAdd();
		$template = "weblink/item_add";
		
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	default:
		$template = "index";
		break;

}

function get_items(){
	global $d, $items, $paging;
	$sql = "select * from #_weblink ";
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
	
	$sql = "select * from #_weblink where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
	
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		
	}
	$data['link'] = $_POST['link'];

	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	

	if($id){
		$id =  themdau($_POST['id']);
		
		
		$d->setTable('weblink');
		$d->setWhere('id', $id);
		if($d->update($data)){
				
				redirect("index.php?com=".$_GET['com']."&act=man");
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}else{
		
		
		$d->setTable('weblink');
		if($d->insert($data)){
			if($_GET['com'] == 'about'){
				transfer("Cập nhật thành công", "index.php");
				}else{
				redirect("index.php?com=".$_GET['com']."&act=man");
			}
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
		$sql = "select * from #_weblink where id='".$id."'";
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
		$sql = "select * from #_weblink where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$sql = "delete from #_weblink where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=".$_GET['com']."&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
}