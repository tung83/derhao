<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define("_table","content");
switch($act){
	case "rss":
		initAddRss();
		
		$template = "content/item_add_rss";
		break;
	case "deleteall":
		deleteAll();
		redirect("index.php");
		break;	
	case "man":
		get_items();
		
		$template = "content/items";
		break;
	case "add":
		$admin->initAdd();
		$template = "content/item_add";
		break;
	case "edit":	
		$admin->initAdd();		
		get_item();	
		$template = "content/item_add";
		
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
		$template = "content/danhmucs";
		break;
	case "add_danhmuc":
		$admin->initAdd("content_danhmuc");
		$template = "content/danhmuc_add";
		break;
	case "edit_danhmuc":
		get_danhmuc();
		$template = "content/danhmuc_add";
		break;
	case "save_danhmuc":
		
		
		save_danhmuc();
		break;
	case "delete_danhmuc":
		delete_danhmuc();
		break;
	#===================================================	
	case "man_list":
		get_lists();
		$template = "content/lists";
		break;
	case "add_list":
		$admin->initAdd("content_list");
		$template = "content/list_add";
		break;
	case "edit_list":
		$admin->initAdd("content_list");
		get_list();
		$template = "content/list_add";
		break;
	case "save_list":
		
		
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;	
	default:
		$template = "index";

}

function deleteAll(){
	global $d;
	$d->query("select * from #_content_danhmuc ");
	foreach($d->result_array() as $k=>$v){
		delete_file(_upload_tintuc.$v['photo']);
		delete_file(_upload_tintuc.$v['thumb']);
		
	}
	$d->query("select * from #_content_list");
	foreach($d->result_array() as $k=>$v){
		delete_file(_upload_tintuc.$v['photo']);
		delete_file(_upload_tintuc.$v['thumb']);
		
	}
	$d->query("select * from #_content");
	foreach($d->result_array() as $k=>$v){
		delete_file(_upload_tintuc.$v['photo']);
		delete_file(_upload_tintuc.$v['thumb']);
		
	}
	$d->query("TRUNCATE TABLE #_content_danhmuc");
	$d->query("TRUNCATE TABLE #_content_list");
	$d->query("TRUNCATE TABLE #_content");
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
	global $d, $items, $paging,$admin;
	$request = "&class=".$_GET['class']."&type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	$sql = "select * from #_content where 1 = 1 and type='".$_GET['type']."'";
	if((int)@$_REQUEST['id_danhmuc']!='')
	{
	$sql.=" and id_danhmuc =".$_REQUEST['id_danhmuc']."";
	}
	if((int)@$_REQUEST['id_list']!='')
	{
	$sql.=" and	id_list =".$_REQUEST['id_list']."";
	}
	$sql.=" order by stt desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=".$_GET['com']."&act=man".$request;
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
	
	$sql = "select * from #_content where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,8);
	$request = "&class=".$_GET['class']."&gallery=".$_GET['gallery']."&type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man".$request);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
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
	$data['price'] = str_replace(".","",$_POST['price']);
	$data['gallery'] = json_encode($photos);
	$data['id_danhmuc'] = $_POST['id_danhmuc'];
	$data['id_list'] = $_POST['id_list'];
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['is_index'] = isset($_POST['is_index']) ? 1 : 0;
	$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
	$data['type'] = $_GET['type'];
	initSeo($data);
	if($id){
		$id =  themdau($_POST['id']);
		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$data['tenkhongdau'])){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_tintuc,$data['tenkhongdau'],3);
			$d->setTable('content');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				
			}
		}
		if($photo = upload_image("file3", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG|zip|rar|7z|tar|doc|docx|pdf|xls|xlsx|ppt|pptx',_upload_tintuc,null)){
			$data['file'] = $photo;
			$d->setTable('content');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['file']);				
			}
		}
		if($photo = upload_image("file2", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$data['tenkhongdau'])){
			$data['icon'] = $photo;
		
			$d->setTable('content');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['icon']);
			
			}
		}
		
		$data['ngaysua'] = time();
	
		$d->setTable('content');
		$d->setWhere('id', $id);
		if($d->update($data)){
				redirect("index.php?com=".$_GET['com']."&act=man".$request);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man".$request);
	}else{
		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$data['tenkhongdau'])){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400, 300, _upload_tintuc,$data['tenkhongdau']);
			
		}
		if($photo = upload_image("file2", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$data['tenkhongdau'])){
			$data['icon'] = $photo;
		}
		if($photo = upload_image("file3", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG|zip|rar|7z|tar|doc|docx|pdf|xls|xlsx|ppt|pptx',_upload_tintuc,null)){
			$data['file'] = $photo;
		}
		
		$data['ngaytao'] = time();
		
		$d->setTable('content');
		if($d->insert($data)){
				redirect("index.php?com=".$_GET['com']."&act=man".$request);
			}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man".$request);
	}
}

function delete_item(){
	global $d;
	$request = "&class=".$_GET['class']."&type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_content where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
			}
			$sql = "delete from #_content where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=".$_GET['com']."&act=man$request");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man$request");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_content where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
			}
			$sql = "delete from #_content where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=".$_GET['com']."&act=man$request");} else transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man$request");
}
//===========================================================
function get_danhmucs(){
	$request = "type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	global $d, $items, $paging;
	$sql = "select * from #_content_danhmuc where type='".$_GET['type']."' order by stt desc";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=".$_GET['com']."&act=man_danhmuc&$request";
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_danhmuc(){
	$request = "type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_danhmuc&$request");
	
	$sql = "select * from #_content_danhmuc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man_danhmuc");
	$item = $d->fetch_array();
}

function save_danhmuc(){
	$request = "type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	global $d,$config;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_danhmuc");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		if($_GET['content']){
			$data['noidung_'.$v] = magic_quote($_POST['noidung_'.$v]);			
		}
		if($_GET['desc']){
			$data['mota_'.$v] = magic_quote($_POST['mota_'.$v]);
		}
		if(!@$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);	
		}
	}
	$data['type'] = $_GET['type'];
	$data['stt'] = $_POST['stt'];		
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
	if($id){	
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$data['tenkhongdau'])){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_tintuc,$data['tenkhongdau'],3);
			
			$d->setTable('content_danhmuc');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				
			}
		}
		$data['ngaysua'] =time();	
		$d->setTable('content_danhmuc');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=".$_GET['com']."&act=man_danhmuc&curPage=".$_REQUEST['curPage']."&$request");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_danhmuc&$request");
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$data['tenkhongdau'])){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 300, 200, _upload_tintuc,$data['tenkhongdau']);
			
		}
		$data['ngaytao'] =time();	
		$d->setTable('content_danhmuc');
		if($d->insert($data))
			redirect("index.php?com=".$_GET['com']."&act=man_danhmuc&$request");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_danhmuc&$request");
	}
}

function delete_danhmuc(){
	$request = "type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	global $d;
	if(isset($_GET['id']) | isset($_GET['listid'])){
		if(@$_GET['id']){
			$ar[] = @$_GET['id'];
		}else{
			$ar = explode(",",$_GET['listid']);
		}
		foreach($ar as $k2=>$v2){
		$id =  themdau($v2);
		$d->reset();		
		$d->query("select photo,thumb from #_content_danhmuc where id='".$id."'");
		$row = $d->fetch_array();
		$d->reset();		
		$sql = "delete from #_content_danhmuc where id='".$id."'";
			if($d->query($sql)){
				$d->query("select * from #_content where id_danhmuc = ".$id);
				foreach($d->result_array() as $k=>$v){
					delete_file(_upload_tintuc.$v['photo']);
					delete_file(_upload_tintuc.$v['thumb']);
					$d->query("delete from #_content where id=".$v['id']);
				}
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				
			}
		}
		
		redirect("index.php?com=".$_GET['com']."&act=man_danhmuc&$request");
	}

	transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_danhmuc&$request");
}

/*********************************************/
//===========================================================
function get_lists(){
	$request = "type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	global $d, $items, $paging;
	$sql = "select * from #_content_list where type='".$_GET['type']."' order by stt desc";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=".$_GET['com']."&act=man_list&$request";
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_list(){
	$request = "type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_list&$request");
	
	$sql = "select * from #_content_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man_list&$request");
	$item = $d->fetch_array();
}

function save_list(){
	$request = "type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	global $d,$config;
	$file_name_item=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_list&$request");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		$data['noidung_'.$v] = magic_quote($_POST['noidung_'.$v]);			
		$data['mota_'.$v] = magic_quote($_POST['mota_'.$v]);
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);	
		}
	}
	$data['stt'] = $_POST['stt'];		
	$data['id_danhmuc'] = $_POST['id_danhmuc'];		
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $_GET['type'];
	if($id){	
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$data['tenkhongdau'])){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_tintuc,$data['tenkhongdau'],3);
			
			$d->setTable('content_danhmuc');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				
			}
		}
		$data['ngaysua'] =time();	
		$d->setTable('content_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=".$_GET['com']."&act=man_list&curPage=".$_REQUEST['curPage']."&$request");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_list&$request");
	}else{
		$data['ngaytao'] =time();	
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$data['tenkhongdau'])){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_tintuc,$data['tenkhongdau'],3);
		}
		$d->setTable('content_list');
		if($d->insert($data))
			redirect("index.php?com=".$_GET['com']."&act=man_list&$request");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_list&$request");
	}
}

function delete_list(){
	$request = "&type=".$_GET['type']."&title=".$_GET['title']."&img=".$_GET['img']."&desc=".$_GET['desc']."&content=".$_GET['content'];
	global $d;
	if(isset($_GET['id']) | isset($_GET['listid'])){
		if(@$_GET['id']){
			$ar[] = @$_GET['id'];
		}else{
			$ar = explode(",",$_GET['listid']);
		}
		foreach($ar as $k2=>$v2){
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_content_list where id='".$id."'";
		if($d->query($sql)){
			$d->query("select * from #_content where id_list = ".$id);
			foreach($d->result_array() as $k=>$v){
				delete_file(_upload_tintuc.$v['photo']);
				delete_file(_upload_tintuc.$v['thumb']);
				$d->query("delete from #_content where id=".$v['id']);
			}
		}
		}
		redirect("index.php?com=".$_GET['com']."&act=man_list$request");
	}else transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_list$request");
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
			$feed->set_feed_url($_GET['url']);
			$feed->enable_cache(false);
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
				$rss[$i]['host'] = $_GET['type'];
				$description =  $item->get_description();
				$desc_dom = str_get_html($description);
				$image = $desc_dom->find('img', 0);
				$image_url = $image->src;
				$rss[$i]['image'] = $image_url;
				
				// $rs = $item->get_item_tags('','summaryImg');
				// if(count($rs)){
						
				// 	$rss[$i]['image'] = (checkValidUrl($rs[0]['data'])) ? $rs[0]['data'] : $url.$rs[0]['data'];
				// }

				$i++;
			}
			echo json_encode($rss);
		}
		if($_GET['method'] == 'get-item'){
			
			$name = $_POST['name'];
			$img = $_POST['image'];
			$url = $_POST['url'];
			$type = $_GET['type'];
			$d->query("select * from #_content where ten_vi = '".$name."' and type='".$type."'");
			$data_ = array();
			if($d->num_rows() == 1){
				$data_['cls'] = 'red';
				$data_['stt'] = 'Tin đã tồn tại';
			}else{
				$html = file_get_html($_POST['url']);
				if($_POST['type2']=='24h.com.vn'){
				$data['mota_vi'] = $html->find("p.baiviet-sapo",0)->plaintext;
				$content = $html->find(".text-conent",0);
				$data['hienthi'] = 1;
				$data['ngaytao'] = time();
				$data['ten_vi'] = (magic_quote($name));
				if($content->find(".baiviet-bailienquan",0)){
					$content->find(".baiviet-bailienquan",0)->outertext ="";
				}
				
				$content->find(".fb-like",0)->outertext ="";
				$content->find(".padB5",0)->outertext ="";
				$x = $content;
				$data['tenkhongdau'] = changeTitle(magic_quote($name));
			
				$data['noidung_vi'] = magic_quote($content);
				}
				if($_POST['type2']=='ngoisao.net'){
				$data['mota_vi'] = $html->find("p.lead",0)->plaintext;
				$content = $html->find(".fck_detail",0);
				$data['hienthi'] = 1;
				$data['ngaytao'] = time();
				$data['ten_vi'] = (magic_quote($name));
				/*if($content->find(".baiviet-bailienquan",0)){
					$content->find(".baiviet-bailienquan",0)->outertext ="";
				}
				
				$content->find(".fb-like",0)->outertext ="";
				$content->find(".padB5",0)->outertext ="";
				$x = $content;
				*/
				$data['tenkhongdau'] = changeTitle(magic_quote($name));
				$data['noidung_vi'] = magic_quote($content);
				}
				if(checkValidUrl($img)){
					$photo_name = rand(0,9999)."-".@end(explode("/",$img));
					save_image($img,_upload_tintuc.$photo_name);
					$data['photo'] = $photo_name;
					$data['thumb'] = $photo_name;
					
				}
				$d->query("select id from #_"._table." where type = '".$type."'");
				
				$data['stt'] = $d->num_rows()+1;
				$d->reset();
				$d->setTable("content");
				$data['type'] = $type;
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
function save_image($inPath,$outPath)
{ //Download images from remote server
   /* $in=    fopen($inPath, "rb");
    $out=   fopen($outPath, "wb");
	
    while ($chunk = fread($in,8192))
    {
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
	*/
	copy($inPath, $outPath);
	return true;
	$url = $inPath;
	$img = $outPath;
	file_put_contents($img, file_get_contents($url));
	
	
}


?>