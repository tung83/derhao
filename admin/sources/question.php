<?php	if(!defined('_source')) die("Error");
global $lang;
@define('_table','question');
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$id=@$_REQUEST['id'];
switch($act){

	
	case "man":
		get_items();
		$template = "question/items";
		break;	
	case "add":		
		$admin->initAdd();
		$template = "question/item_add";
		break;
	case "edit":	
		$admin->initAdd();	
		get_item();		
		$template = "question/item_add";
		break;
	case "save":
	

		save_item();
		break;
	case "delete":
		delete_item();
		break;
	#===================================================	
	case "man_item":
		get_loais();
		$template = "question/loais";
		break;
	case "add_item":		
		$template = "question/loai_add";
		break;
	case "edit_item":		
		get_loai();
		$template = "question/loai_add";
		break;
	case "save_item":
		save_loai();
		break;
	case "delete_item":
		delete_loai();
		break;
	
	case "man_danhmuc":
		get_danhmucs();
		$template = "question/danhmucs";
		break;
	case "add_danhmuc":		
		initAdd("question_danhmuc");
		$template = "question/danhmuc_add";
		break;
	case "edit_danhmuc":		
		get_danhmuc();
		$template = "question/danhmuc_add";
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

#====================================
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
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hot']!='')
	{
	$id_up = $_REQUEST['hot'];
	$sql_sp = "SELECT id,hot FROM table_question where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['hot'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_question SET hot ='$time' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_question SET hot =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['spbanchay']!='')
	{
	$id_up = $_REQUEST['spbanchay'];
	$sql_sp = "SELECT id,spbanchay FROM table_question where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$spbanchay=$cats[0]['spbanchay'];
	if($spbanchay==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_question SET spbanchay =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_question SET spbanchay =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['noibat']!='')
	{
	$id_up = $_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_question where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$noibat=$cats[0]['noibat'];
	if($noibat==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_question SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_question SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['spmoi']!='')
	{
	$id_up = $_REQUEST['spmoi'];
	$sql_sp = "SELECT id,spmoi FROM table_question where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$spmoi=$cats[0]['spmoi'];
	if($spmoi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_question SET spmoi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_question SET spmoi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_question where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_question SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_question SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	$sql = "select * from #_question";	
	if((int)@$_REQUEST['id_danhmuc']!='')
	{
	$sql.=" where id_danhmuc=".(int)$_REQUEST['id_danhmuc']."";
	}
	if((int)@$_REQUEST['id_list']!='')
	{
	$sql.=" and id_list=".(int)$_REQUEST['id_list']."";
	}
	if((int)@$_REQUEST['id_cat']!='')
	{
	$sql.=" and id_cat=".(int)$_REQUEST['id_cat']."";
	}
	if((int)@$_REQUEST['id_item']!='')
	{
	$sql.=" and id_item=".(int)$_REQUEST['id_item']."";
	}
	//$sql.=" order by id_danhmuc,id_list,id_cat,id_item,create_time desc";
	$sql.=" order by create_time desc";
	
	$d->query($sql);
	$items = $d->result_array();
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=question&act=man&id_danhmuc=".@$_GET['id_danhmuc']."&id_list=".@$_GET['id_list']."&id_cat=".@$_GET['id_cat']."&id_item=".@$_GET['id_item'];
	$maxR=20;
	$maxP=20;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}
function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=question&act=man");
	
	$sql = "select * from #_question where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=question&act=man");
	$item = $d->fetch_array();	
	$d->query("update #_question set hienthi = 1 where id = ".$id);
}

function save_item(){
	
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,6);
	$data = array();
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=question&act=man");
	
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	//$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
	
	$data['ten'] = magic_quote($_POST['ten']);
	$data['email'] = magic_quote($_POST['email']);
	$data['address'] = magic_quote($_POST['address']);
	$data['content'] = magic_quote($_POST['content']);
	$data['reply'] = magic_quote($_POST['reply']);
	if($id){
		
		$id =  themdau($_POST['id']);
		$d->reset();
		
	
		$d->setTable('question');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=question&act=man&curPage=".$_REQUEST['curPage']."&id_danhmuc=".$_REQUEST['id_danhmuc']."&id_list=".$_REQUEST['id_list']."&id_cat=".$_REQUEST['id_cat']."&id_item=".$_REQUEST['id_item']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=question&act=man");
	}else{

		
		$data['ngaytao'] = time();
		$d->setTable('question');
		if($d->insert($data)){
			redirect("index.php?com=question&act=man");
			}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=question&act=man");
	}
}

function delete_item(){
	global $d;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
	
		$sql = "delete from #_question where id='".$id."'";	
		if($d->query($sql))
			redirect("index.php?com=question&act=man".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=question&act=man");
	}
}



/*---------------------------------*/
function get_danhmucs(){
	global $d, $items, $paging;
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_question_danhmuc where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_question_danhmuc SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_question_danhmuc SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	
	$sql = "select * from #_question_danhmuc";
	if((int)@$_REQUEST['id_danhmuc']!='')
	{
	$sql.=" where id_danhmuc=".(int)$_REQUEST['id_danhmuc']."";
	}
	$sql.=" order by create_time desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=question&act=man_danhmuc";
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_danhmuc(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=question&act=man_danhmuc");
	
	$sql = "select * from #_question_danhmuc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=question&act=man_danhmuc");
	$item = $d->fetch_array();	
}

function save_danhmuc(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,6);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=question&act=man_danhmuc");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data = array();
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);
		}
	}
	initSeo($data);
	if($id){		
		$id =  themdau($_POST['id']);
				
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_sanpham,$file_name,3);
			
			$d->setTable('service');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('question_danhmuc');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=question&act=man_danhmuc&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=question&act=man_danhmuc");
	}else{			
				
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_sanpham,$file_name,3);
			
			
		}
     
		$data['ngaytao'] = time();
		
		$d->setTable('question_danhmuc');
		if($d->insert($data))
			redirect("index.php?com=question&act=man_danhmuc");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=question&act=man_danhmuc");
	}
}

function delete_danhmuc(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();		
			//Xóa danh mục cấp 1
			$sql = "delete from #_question_danhmuc where id='".$id."'";
			$d->query($sql);
			//Xóa danh mục cấp 2			
			$sql = "select id,thumb,photo from #_question_list where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_question_list where id_danhmuc='".$id."'";
				$d->query($sql);
			}
			//Xóa danh mục cấp 3
			$sql = "select id,thumb,photo from #_question_cat where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_question_cat where id='".$id."'";
				$d->query($sql);
			}
			//Xóa danh mục cấp 4			
			$sql = "select id,thumb,photo from #_question_item where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_question_item where id_danhmuc='".$id."'";
				$d->query($sql);
			}
			//Xóa sản phẩm thuộc loại đó			
			$sql = "select id,thumb,photo from #_question where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_question where id_danhmuc='".$id."'";
				$d->query($sql);
			}
		
		
		if($d->query($sql))
			redirect("index.php?com=question&act=man_danhmuc");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=question&act=man_danhmuc");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			
				$sql = "delete from #_question_danhmuc where id='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_question_list where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_question_cat where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_question_item where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_question where id_danhmuc='".$id."'";
				$d->query($sql);
			
		} redirect("index.php?com=question&act=man_danhmuc");} else transfer("Không nhận được dữ liệu", "index.php?com=question&act=man_danhmuc"	    );
}


function capnhatsoluong(){
	global $d, $item;
	$d->query("SET NAMES 'utf8'");
	if(isset($_POST['id'])){
		
		$ar = array();
		foreach($_POST['ten'] as $k=>$v){
			if($v){
			$row['ten'] = $v;
			$row['soluong'] = $_POST['soluong'][$k];
			$ar[] = $row;
			}
		}
		$d->query("SET NAMES 'utf8'");
		
		$sql = "update #_question_soluong set content ='".magic_quote(json_encode($ar))."'";
		$d->query($sql);
		transfer("Cập nhật thành công", "index.php");
	}
	$sql = "select * from #_question_soluong";
	$d->query($sql);
	
	$item = $d->fetch_array();	
}
?>


