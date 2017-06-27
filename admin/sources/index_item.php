<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
//===========================================================
switch($act){
	case "man":
		get_items();
		$template = "index_item/items";
		break;
	case "add":
		$template = "index_item/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "index_item/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	case "background":
		
		background_save();
       
		$template = "index_item/background";
		break;
	#===================================================	
	case "man_cat":
		get_cats();
		$template = "index_item/cats";
		break;
	case "add_cat":
		$template = "index_item/cat_add";
		break;
	case "edit_cat":
		get_cat();
		$template = "index_item/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;
	default:
		$template = "index";

	default:
		$template = "index";
}
function background_save(){
	
     global $d;

     if(isset($_POST['submit'])){
     $file_name=fns_Rand_digit(0,9,5);
     if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=banggia&act=capnhat");
     if($photo = upload_image("file", 'jpg|JPG|png',_upload_hinhanh,$file_name)){
         $data['photo'] = $photo;
         $d->setWhere("com","background");
         $d->setTable('photo');
         $d->select();
         if($d->num_rows()>0){
             $row = $d->fetch_array();
             delete_file(_upload_hinhanh.$row['photo']);
         }
     }
     $d->reset();
     $d->setTable('photo');
     $d->setWhere("com","background");

     if($d->update($data))
         transfer("Dữ liệu được cập nhật", "index.php");
     else
         transfer("Cập nhật dữ liệu bị lỗi", "index.php");

     }
     $sql = "select * from #_photo where com='background'";
     $d->query($sql);
     global $item;
     $item = $d->fetch_array();

}
//===========================================================
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

//===========================================================
function get_items(){
	global $d, $items, $paging;
	
	#********************************************************************************#
	if(@$_REQUEST['noibat']!='')
	{
		$id_up = @$_REQUEST['noibat'];
		$sql_sp = "SELECT id,noibat FROM table_index_item where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$noibat=$cats[0]['noibat'];
	//echo "id:". $spdc1;
	if($noibat==0)
	{
		$sqlUPDATE_ORDER = "UPDATE table_index_item SET noibat =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
		$sqlUPDATE_ORDER = "UPDATE table_index_item SET noibat =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	#********************************************************************************#
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = @$_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_index_item where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
		$sqlUPDATE_ORDER = "UPDATE table_index_item SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
		$sqlUPDATE_ORDER = "UPDATE table_index_item SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	#********************************************************************************#
	
	$sql = "select * from #_index_item ";
	if((int)$_REQUEST['id_item']!='')
	{
	$sql.=" where id_item=".$_REQUEST['id_item']."";
	}
	$sql.=" order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=index_item&act=man&id_item=".$_GET['id_item'];
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}
//===========================================================
function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=index_item&act=man");
	
	$sql = "select * from #_index_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=index_item&act=man");
	$item = $d->fetch_array();
}
//===========================================================
function save_item(){
	global $d;
	$file_name=fns_Rand_digit(0,9,8);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=index_item&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){
		$id =  themdau($_POST['id']);		
		if($photo = upload_image("file", 'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;	
			$d->setTable('index_item');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
			}
		}
	
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_en']);
		$data['mota_vi'] = magic_quote($_POST['mota_vi']);
		$data['mota_en'] = magic_quote($_POST['mota_en']);
		$data['type'] = $_POST['type'];
		$data['noidung_vi'] = magic_quote($_POST['noidung_vi']);
		$data['noidung_en'] = magic_quote($_POST['noidung_en']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	
		$data['ngaysua'] = time();
		
		$d->setTable('index_item');
		$d->setWhere('id', $id);
		if($d->update($data))
				redirect("index.php?com=index_item&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=index_item&act=man");
	}else{
	
		
		if($photo = upload_image("file", 'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
		
		}
		
		$data['ten'] = $_POST['ten'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['mota'] = magic_quote($_POST['mota']);
		$data['noidung'] = magic_quote($_POST['noidung']);
		$data['type'] = $_POST['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$data['ngaytao'] = time();
		
		$d->setTable('index_item');
		if($d->insert($data))
			redirect("index.php?com=index_item&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=index_item&act=man");
	}
}
//===========================================================
function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_index_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				
			}
			$sql = "delete from #_index_item where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=index_item&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=index_item&act=man");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_index_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
			}
			$sql = "delete from #_index_item where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=index_item&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=index_item&act=man");
}

//===========================================================
function get_cats(){
	global $d, $items, $paging;
	
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_index_item_item where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_index_item_item SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_index_item_item SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	
	$sql = "select * from #_index_item_item order by stt";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=index_item&act=man_cat";
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

//===========================================================
function get_cat(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=index_item&act=man_cat");
	
	$sql = "select * from #_index_item_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=index_item&act=man_cat");
	$item = $d->fetch_array();
}
//===========================================================
function save_cat(){
	global $d;
	$file_name_item=$_FILES['file']['name'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=index_item&act=man_cat");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$data['ten'] = $_POST['ten'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];	
		$data['noidung'] = $_POST['noidung'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;		
		$data['ngaysua'] =time();	
		$d->setTable('index_item_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=index_item&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=index_item&act=man_cat");
	}else{
		$data['ten'] = $_POST['ten'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];
		$data['noidung'] = $_POST['noidung'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;		
		$data['ngaytao'] =time();	
		
		$d->setTable('index_item_item');
		if($d->insert($data))
			redirect("index.php?com=index_item&act=man_cat");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=index_item&act=man_cat");
	}
}
//===========================================================
function delete_cat(){
	global $d;
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);		
		$d->reset();		
			//Xóa danh mục cấp 4
			$sql = "delete from #_index_item_item where id='".$id."'";
			$d->query($sql);
			//Xóa sản phẩm thuộc loại đó
			$sql = "select id,thumb,photo from #_product where id_item='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_tintuc.$row['photo']);
				}
				$sql = "delete from #_index_item where id_item='".$id."'";
				$d->query($sql);
			}
			
		
		
		if($d->query($sql))
			redirect("index.php?com=index_item&act=man_cat");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=index_item&act=man_cat");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();							
				
				$sql = "delete from #_index_item_item where id='".$id."'";
				$d->query($sql);
				
				$sql = "select id,thumb,photo from #_index_item where id_item='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					while($row = $d->fetch_array())
					{
						delete_file(_upload_tintuc.$row['photo']);
					}
					$sql = "delete from #_index_item where id_item='".$id."'";
					$d->query($sql);
				}

		} redirect("index.php?com=index_item&act=man_cat");}
		else transfer("Không nhận được dữ liệu", "index.php?com=index_item&act=man_cat");
}

?>


