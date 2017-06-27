<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define('_table','baiviet');
switch($act){
	case "rss":
		initAddRss();
		
		$template = "baiviet/item_add_rss";
		break;
	case "man":
		get_items();
		
		$template = "baiviet/items";
		break;
	case "add":
		$admin->initAdd();
		$template = "baiviet/item_add";
		break;
	case "edit":		
		get_item();	
		$admin->initAdd();
		$template = "baiviet/item_add";
		
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	#===================================================	
	case "man_cat":
		get_cats();
		$template = "baiviet/cats";
		break;
	case "add_cat":
		$template = "baiviet/cat_add";
		break;
	case "edit_cat":
		get_cat();
		$template = "baiviet/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;
		
	/* ********************************************************************** */
		
		#===================================================	
	case "man_danhmuc":
		get_danhmucs();
		$template = "baiviet/danhmucs";
		break;
	case "add_danhmuc":		
		initAdd("baiviet_danhmuc");
		$template = "baiviet/danhmuc_add";
		break;
	case "edit_danhmuc":		
		get_danhmuc();
		$template = "baiviet/danhmuc_add";
		break;
	case "save_danhmuc":
		save_danhmuc();
		break;
	case "delete_danhmuc":
		delete_danhmuc();
		break;
	default:

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
	
	if(@$_REQUEST['update']!='')
	{
	$id_up = @$_REQUEST['update'];
	
	$tinnoibat=time();
	
	$sql_sp = "SELECT id,tinnoibat FROM table_baiviet where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$spdc1=$cats[0]['tinnoibat'];
	//echo "id:". $spdc1;
	if($spdc1==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_baiviet SET tinnoibat ='".$tinnoibat."' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_baiviet SET tinnoibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = @$_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_baiviet where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_baiviet SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_baiviet SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
		if(@$_REQUEST['noibat']!='')
	{
	$id_up = @$_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_baiviet where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['noibat'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_baiviet SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_baiviet SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	$sql = "select * from #_baiviet ";
	if((int)$_REQUEST['id_cat']!='')
	{
	$sql.=" where  	idlt=".$_REQUEST['id_cat']."";
	}
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
	
	$sql = "select * from #_baiviet where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,8);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['link'] = $_POST['link'];
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		$data['noidung_'.$v] = magic_quote($_POST['noidung_'.$v]);			
		$data['mota_'.$v] = magic_quote($_POST['mota_'.$v]);
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);	
		}
	}
	$photos = array();
	foreach($_POST['photos'] as $k=>$v){
		if($v){
			$photos[] = $v;
		}
	
	}
	$data['gallery'] = json_encode($photos);
	initSeo($data);
	
	
	$data['id_item'] = (int)$_POST['id_item'];
	$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;

	if($id){
		$id =  themdau($_POST['id']);
		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_tintuc,$file_name,3);
			
			$d->setTable('baiviet');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				
			}
		}
		
		$data['ngaysua'] = time();
	
		$d->setTable('baiviet');
		$d->setWhere('id', $id);
		if($d->update($data)){
				if($_GET['com']=='baiviet'){
						transfer("Cập nhật thành công", "index.php");
				}
				redirect("index.php?com=".$_GET['com']."&act=man");
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}else{
		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400, 300, _upload_tintuc,$file_name,3);
			
		}
		
		$data['ngaytao'] = time();
		
		$d->setTable('baiviet');
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
		$sql = "select * from #_baiviet where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				delete_file(_upload_tintuc.$row['thumb1']);
			}
			$sql = "delete from #_baiviet where id='".$id."'";
			$d->query($sql);
		}
		
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
		$sql = "select * from #_baiviet where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				delete_file(_upload_tintuc.$row['thumb1']);
			}
			$sql = "delete from #_baiviet where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=".$_GET['com']."&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
}
//===========================================================
function get_cats(){
	global $d, $items, $paging;
	$sql = "select * from #_baiviet_item order by stt";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=".$_GET['com']."&act=man_cat";
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_cat(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_cat");
	
	$sql = "select * from #_baiviet_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man_cat");
	$item = $d->fetch_array();
}

function save_cat(){
	global $d,$config;
	$file_name_item=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_cat");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		
		
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);	
		}
	}

	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	
	
	
	if($id){
			
		$data['ngaysua'] =time();	
		$d->setTable('baiviet_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=".$_GET['com']."&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_cat");
	}else{
			
		$data['ngaytao'] =time();	
		
		$d->setTable('baiviet_item');
		if($d->insert($data))
			redirect("index.php?com=".$_GET['com']."&act=man_cat");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_cat");
	}
}

function delete_cat(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_baiviet_item where id='".$id."'";
		if($d->query($sql))
			redirect("index.php?com=".$_GET['com']."&act=man_cat");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_cat");
	}else transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_cat");
}

/* init add item */
function rss(){
	
}

/* init add rss */


function initAddRss(){
	global $d;
	include_once _lib."simplehtmldom/simple_html_dom.php";
	if(isAjaxRequest()){
		if($_GET['method']=='getlist'){
		
			global $feed;
			include_once _lib."simplepie/autoloader.php";
			$feed = new SimplePie();
			$feed->set_feed_url('http://www.24h.com.vn/upload/rss/thoitrang.rss');
			$feed->enable_cache(true);
			$feed->set_cache_duration(3600);
			$feed->set_cache_location('cache');
			//start the process
			$feed->init();
			$feed->handle_content_type();
			$rss = array();
			$i=0;
			$url = "http://www.24h.com.vn";
			 foreach($feed->get_items(0, 10) as $item){
			 
				$feed = $item->get_feed();
				$rss[$i]['link']  = $item->get_permalink();
				$rss[$i]['name'] = $item->get_title();
				$rs = $item->get_item_tags('','summaryImg');
				$rss[$i]['image'] = null;
				if(count($rs)){
					$rss[$i]['image'] = $url.$rs[0]['data'];
				}

				$i++;
			}
			echo json_encode($rss);

		}
		if($_GET['method'] == 'get-item'){
			
			$name = $_POST['name'];
			$img = $_POST['image'];
			$url = $_POST['url'];
			$d->query("select * from #_baiviet where ten_vi = '".$name."'");
			$data_ = array();
			if($d->num_rows() == 1){
				$data_['cls'] = 'red';
				$data_['stt'] = 'Tin đã tồn tại';
			}else{
				$html = file_get_html($_POST['url']);
				$content = $html->find(".text-conent",0);
				$data['hienthi'] = 1;
				$data['ngaytao'] = time();
				$data['ten_vi'] = (magic_quote($name));
				$data['tenkhongdau'] = changeTitle(magic_quote($name));
				$data['noidung_vi'] = magic_quote($content);
				
				$data['photo'] = $img;
				
				$d->setTable("baiviet");
				if($d->insert($data)){
					$data_['cls'] = 'green';
					$data_['stt'] = 'Thêm thành công';
				}
			}
			echo json_encode($data_);
		}
		die();
}
}

/* */


/*---------------------------------*/
function get_danhmucs(){
	global $d, $items, $paging;
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_baiviet_danhmuc where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_baiviet_danhmuc SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_baiviet_danhmuc SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	
	$sql = "select * from #_baiviet_danhmuc";
	if((int)@$_REQUEST['id_danhmuc']!='')
	{
	$sql.=" where id_danhmuc=".(int)$_REQUEST['id_danhmuc']."";
	}
	$sql.=" order by stt desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=baiviet&act=man_danhmuc";
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_danhmuc(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_danhmuc");
	
	$sql = "select * from #_baiviet_danhmuc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=baiviet&act=man_danhmuc");
	$item = $d->fetch_array();	
}

function save_danhmuc(){
	global $d,$config;
	$file_name=$_FILES['file']['name'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_danhmuc");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data = array();
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['photo'] = $_POST['photo'];
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);
		}
	}
	initSeo($data);
	if($id){		
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_tintuc,$file_name)){
			$data['photo'] = $photo;	
			
			$d->setTable('baiviet_danhmuc');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);	
				delete_file(_upload_tintuc.$row['thumb']);				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('baiviet_danhmuc');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=baiviet&act=man_danhmuc&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=baiviet&act=man_danhmuc");
	}else{			
		  if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_tintuc,$file_name)){
			$data['photo'] = $photo;		
				
		}
     
		$data['ngaytao'] = time();
		
		$d->setTable('baiviet_danhmuc');
		if($d->insert($data))
			redirect("index.php?com=baiviet&act=man_danhmuc");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=baiviet&act=man_danhmuc");
	}
}

function delete_danhmuc(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();		
			//Xóa danh mục cấp 1
			$sql = "delete from #_baiviet_danhmuc where id='".$id."'";
			$d->query($sql);
			//Xóa danh mục cấp 2			
			$sql = "select id,thumb,photo from #_baiviet_list where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_tintuc.$row['photo']);
					delete_file(_upload_tintuc.$row['thumb']);	
				}
				$sql = "delete from #_baiviet_list where id_danhmuc='".$id."'";
				$d->query($sql);
			}
			//Xóa danh mục cấp 3
			$sql = "select id,thumb,photo from #_baiviet_cat where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_tintuc.$row['photo']);
					delete_file(_upload_tintuc.$row['thumb']);	
				}
				$sql = "delete from #_baiviet_cat where id='".$id."'";
				$d->query($sql);
			}
			//Xóa danh mục cấp 4			
			$sql = "select id,thumb,photo from #_baiviet_item where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_tintuc.$row['photo']);
					delete_file(_upload_tintuc.$row['thumb']);	
				}
				$sql = "delete from #_baiviet_item where id_danhmuc='".$id."'";
				$d->query($sql);
			}
			//Xóa sản phẩm thuộc loại đó			
			$sql = "select id,thumb,photo from #_baiviet where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_tintuc.$row['photo']);
					delete_file(_upload_tintuc.$row['thumb']);	
				}
				$sql = "delete from #_baiviet where id_danhmuc='".$id."'";
				$d->query($sql);
			}
		
		
		if($d->query($sql))
			redirect("index.php?com=baiviet&act=man_danhmuc");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=baiviet&act=man_danhmuc");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			
				$sql = "delete from #_baiviet_danhmuc where id='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_baiviet_list where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_baiviet_cat where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_baiviet_item where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_baiviet where id_danhmuc='".$id."'";
				$d->query($sql);
			
		} redirect("index.php?com=baiviet&act=man_danhmuc");} else transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_danhmuc"	    );
}









?>