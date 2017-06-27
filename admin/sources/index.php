<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define('_table','index');
switch($act){

	case "man":
		get_items();
		
		$template = "index/items";
		break;
	case "add":
		$admin->initAdd();
		$template = "index/item_add";
		break;
	case "edit":		
		$admin->initAdd();
		get_item();	
		$template = "index/item_add";
		
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
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
	
	if(@$_REQUEST['update']!='')
	{
	$id_up = @$_REQUEST['update'];
	
	$noibat=time();
	
	$sql_sp = "SELECT id,noibat FROM table_index where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$spdc1=$cats[0]['noibat'];
	//echo "id:". $spdc1;
	if($spdc1==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_index SET noibat ='".$noibat."' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_index SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = @$_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_index where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_index SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_index SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
		if(@$_REQUEST['noibat']!='')
	{
	$id_up = @$_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_index where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['noibat'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_index SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_index SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	$sql = "select * from #_index ";
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
	
	$sql = "select * from #_index where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,8);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	$data['id_type'] = $_POST['id_type'];
	$data['active_time'] = $_POST['active_time'];
	$data['phone'] = $_POST['phone'];
	$data['id_province'] = $_POST['id_province'];
	$data['id_district'] = $_POST['id_district'];
	$data['address'] = $_POST['address'];
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		$data['noidung_'.$v] = magic_quote($_POST['noidung_'.$v]);			
		$data['mota_'.$v] = magic_quote($_POST['mota_'.$v]);
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);	
		}
	}
	
	$d->query("select name from #_province where provinceid=".$data['id_province']);
	$r = $d->fetch_array();
	$province_name = $r['name'];
	$d->query("select name from #_district where districtid=".$data['id_district']);
	$r = $d->fetch_array();

	$district_name = $r['name'];
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
	$address = str_replace(" ","%20",$data['address']." ".$district_name." ".$province_name." Việt Nam");

	/*$json = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=" . ($address) . "&sensor=true");
	$json = json_decode($json);
	$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};*/
	$x = explode(",",$_POST['lat']);
	$data['lat_'] = $x[0];
	$data['long_'] = $x[1];
	$data['address'] = magic_quote($data['address']);
	
	if($id){
		$id =  themdau($_POST['id']);
		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_news,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_news,$file_name,3);
			
			$d->setTable('index');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
				
			}
		}
		
		$data['ngaysua'] = time();
	
		$d->setTable('index');
		$d->setWhere('id', $id);
		if($d->update($data)){
				if($_GET['com']=='about'){
						transfer("Cập nhật thành công", "index.php");
				}
				redirect("index.php?com=".$_GET['com']."&act=man");
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}else{
		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_news,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_news,$file_name,300);

		}
		
		$data['ngaytao'] = time();
		
		$d->setTable('index');
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
		$sql = "select * from #_index where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
				delete_file(_upload_news.$row['thumb1']);
			}
			$sql = "delete from #_index where id='".$id."'";
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
		$sql = "select * from #_index where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
				delete_file(_upload_news.$row['thumb1']);
			}
			$sql = "delete from #_index where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=".$_GET['com']."&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
}


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
			$d->query("select * from #_index where ten_vi = '".$name."'");
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
				
				$d->setTable("index");
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








?>