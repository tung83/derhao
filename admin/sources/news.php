<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define("_table","news");
switch($act){
	case "deleteall":
		deleteAll();
		redirect("index.php");
		break;	
	#===================================================	
	case "man":
		get_items();
		$template = "news/items";
		break;	
	case "add":		
		$admin->initAdd();
		$template = "news/item_add";
		break;
	case "edit":	
		$admin->initAdd();	
		get_item();		
		$template = "news/item_add";
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
		$template = "news/danhmucs";
		break;
	case "add_danhmuc":
		$admin->initAdd("news_danhmuc");
		$template = "news/danhmuc_add";
		break;
	case "edit_danhmuc":
		get_danhmuc();
		$template = "news/danhmuc_add";
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

function deleteAll(){
	global $d;
	$d->query("select * from #_news ");
	foreach($d->result_array() as $k=>$v){
		delete_file(_upload_tintuc.$v['photo']);
		delete_file(_upload_tintuc.$v['thumb']);
		
	}
}
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
	$sql = "select * from #_news where 1 = 1";
	if((int)@$_REQUEST['id_danhmuc']!='')
	{
            $sql.=" and id_danhmuc=".(int)$_REQUEST['id_danhmuc']."";
	}
	$sql.="  order by stt desc";
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
	
	$sql = "select * from #_news where id='".$id."'";
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
	$data['stt'] = $_POST['stt'];	
	$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];	
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
	if($id){	
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$data['tenkhongdau'])){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_tintuc,$data['tenkhongdau'],3);
			
			$d->setTable('news');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				
			}
		}
		$data['ngaysua'] =time();	
		$d->setTable('news');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=".$_GET['com']."&act=man&curPage=".$_REQUEST['curPage']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$data['tenkhongdau'])){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 300, 200, _upload_tintuc,$data['tenkhongdau']);
			
		}
		$data['ngaytao'] =time();	
		$d->setTable('news');
		if($d->insert($data))
			redirect("index.php?com=".$_GET['com']."&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}
}

function delete_item(){
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
		$d->query("select photo,thumb from #_news where id='".$id."'");
		$row = $d->fetch_array();
		$d->reset();		
		$sql = "delete from #_news where id='".$id."'";
			if($d->query($sql)){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				
			}
		}
		
		redirect("index.php?com=".$_GET['com']."&act=man");
	}

	transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
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

/*---------------------------------*/
function get_danhmucs(){
	global $d, $items, $paging;
	$sql = "select * from #_news_danhmuc";
	
	$sql.=" where type='".@$_GET['type']."' order by stt desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=news&act=man_danhmuc&type=".@$_GET['type'];
	$maxR=30;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_danhmuc(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_danhmuc&type=".$_GET['type']);
	
	$sql = "select * from #_news_danhmuc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=news&act=man_danhmuc&type=".$_GET['type']);
	$item = $d->fetch_array();	
}

function save_danhmuc(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,6);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_danhmuc&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data = array();
	$data['stt'] = $_POST['stt'];
	$data['type'] = $_GET['type'];
	$data['background_color'] = $_POST['background_color'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		$data['noidung_'.$v] = magic_quote($_POST['noidung_'.$v]);
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);
		}
	}
	initSeo($data);
	if($id){		
		$id =  themdau($_POST['id']);
				
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_sanpham,$data['tenkhongdau'])){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_sanpham,$data['tenkhongdau'],3);
			
			$d->setTable('news_danhmuc');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('news_danhmuc');
		$d->setWhere('id', $id);
		if($d->update($data)){
			saveBrandProduct($id);
			redirect("index.php?com=news&act=man_danhmuc&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
			
		}	
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_danhmuc&type=".$_GET['type']);
	}else{			
				
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_sanpham,$data['tenkhongdau'])){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_sanpham,$data['tenkhongdau'],3);
			
			
		}
     
		$data['ngaytao'] = time();
		
		$d->setTable('news_danhmuc');
		if($d->insert($data)){
			$d->query("select id from #_news_danhmuc order by id desc limit 1");
			$r = $d->fetch_array();
			saveBrandProduct($r['id']);
			redirect("index.php?com=news&act=man_danhmuc&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_danhmuc&type=".$_GET['type']);
	}
}

function delete_danhmuc(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();		
			//Xóa danh m?c c?p 1
			$sql = "delete from #_news_danhmuc where id='".$id."'";
			$d->query($sql);
			//Xóa danh m?c c?p 2			
			$sql = "select id,thumb,photo from #_news_list where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_news_list where id_danhmuc='".$id."'";
				$d->query($sql);
			}
			//Xóa danh m?c c?p 3
			$sql = "select id,thumb,photo from #_news_cat where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_news_cat where id='".$id."'";
				$d->query($sql);
			}
			//Xóa danh m?c c?p 4			
			$sql = "select id,thumb,photo from #_news_item where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_news_item where id_danhmuc='".$id."'";
				$d->query($sql);
			}
			//Xóa s?n ph?m thu?c lo?i dó			
			$sql = "select id,thumb,photo from #_news where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_news where id_danhmuc='".$id."'";
				$d->query($sql);
			}
		
		
		if($d->query($sql))
			redirect("index.php?com=news&act=man_danhmuc&type=".$_GET['type']);
		else
			transfer("Xóa dự liệu bị lỗi", "index.php?com=news&act=man_danhmuc&type=".$_GET['type']);
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			
				$sql = "delete from #_news_danhmuc where id='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_news_list where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_news_cat where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_news_item where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_news where id_danhmuc='".$id."'";
				$d->query($sql);
			
		} redirect("index.php?com=news&act=man_danhmuc&type=".$_GET['type']);} else transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_danhmuc&type=".$_GET['type']	    );
}
/* special */
function getBrandByCategory(){
	
	$id = $_POST['id'];
	$arr = getBrandByProductCateId($id);
	echo json_encode($arr);
	die;
}

?>