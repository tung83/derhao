<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define('_table','member');
switch($act){
	case 'get_dist':
		getDistrict();
		die;
		break;
	case "man":
		get_items();
		
		$template = "member/items";
		break;
	case "add":
		initAdd();
		checkEmail();
		$template = "member/item_add";
		break;
	case "edit":		
		get_item();	
		$template = "member/item_add";
		
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
function checkEmail(){
	if(isAjaxRequest()){
		$email =  $_POST['email'];
		global $d;
		if(validEmail($email)){
			$d->query("select * from #_member where email = '".$email."'");
			echo json_encode(array("stt"=>$d->num_rows()));
		}else{
			echo json_encode(array("stt"=>1,'msg'=>'Email không hợp lệ'));
		}
		die;
	
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

function getDistrict(){
	global $d;
	$id = $_POST['id'];
	$d->query("select * from district  where provinceid = ".$id);
	echo "<option value='0'>Chọn</option>";
	foreach($d->result_array() as $k=>$v){
		echo "<option value='".$v['districtid']."'>".$v['name']."</option>";
	}

}
function get_items(){
	global $d, $items, $paging;
	
	if(@$_REQUEST['update']!='')
	{
	$id_up = @$_REQUEST['update'];
	
	$noibat=time();
	
	$sql_sp = "SELECT id,noibat FROM table_member where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$spdc1=$cats[0]['noibat'];
	//echo "id:". $spdc1;
	if($spdc1==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_member SET noibat ='".$noibat."' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_member SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	
	if(@$_REQUEST['isActive']!='')
	{
	$id_up = @$_REQUEST['isActive'];
	$sql_sp = "SELECT id,isActive FROM table_member where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['isActive'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_member SET isActive =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_member SET isActive =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
		if(@$_REQUEST['noibat']!='')
	{
	$id_up = @$_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_member where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['noibat'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_member SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_member SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	$sql = "select * from #_member where 1 = 1 ";
	if(isset($_GET['search'])){
		
		if($_GET['search-code']){
			$sql.=" and fullname like '%".$_GET['search-code']."%'";
		
		}
		if($_GET['search-email']){
		$sql.=" and email like '%".$_GET['search-email']."%'";
		
		}
		
		
	if(isset($_GET['search-price']) & $_GET['search-price']!=''){
		$s = $_GET['search-price'];
		$operator = array(">","<"," >=","<=","=","!=");
		$isset = false;
		foreach($operator as $k=>$v){
			if (strpos($s,$v) !== false) {
				$isset = true;
			}
		}
		$sql.= " and diemtichluy  ".(($isset) ?'' : ' = ').$_GET['search-price'];
	
	}
	if($_GET['search-thanhvien']){
		$sql.=" and isActive = ".$_GET['search-thanhvien'];
	
	}
	
		
		
		
	
	
	}
	$sql.=" order by id desc";

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
	
	$sql = "select * from #_member where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,8);
	$reg = $_POST['reg'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	$data = $_POST['reg'];
			if(isset($_FILES['avatar'])){
				$file_name = time().rand(0,999);
				if($photo = upload_image("avatar", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_member_,$file_name))
				{
					$data['avatar'] = create_thumb($photo, 200,200, _upload_member_,$file_name,3);	
					delete_file(_upload_member_.$photo);
				}
			}
			if(isset($_FILES['com_logo'])){
				$file_name = time().rand(0,999);
				if($photo = upload_image("com_logo", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_member_,$file_name))
				{
					$data['com_logo'] = create_thumb($photo, 200,200, _upload_member_,$file_name,3);	
					delete_file(_upload_member_.$photo);
				}
			}
			if(isset($_FILES['com_dkkd'])){
				$file_name = time().rand(0,999);
				if($photo = upload_image("com_dkkd", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_member_,$file_name))
				{
					$data['com_dkkd'] = $photo;	
				}
			}
			if(!$_POST['old-password']){
				unset($data['password']);
			}else{
				$data['password'] = comparePassword($member_log['secret'],$data['password']);
			}
			
	
	
	//$data['isActive'] = isset($_POST['isActive']) ? 1 : 0;
	
	//initSeo($data);
	
	if($id){
		
		$id =  themdau($_POST['id']);
		
		if(isset($reg['password']) & $reg['password']!=''){
			$data['password'] = comparePassword($_POST['secret'],$reg['password']);
		}
		
		$d->setTable('member');
		$d->setWhere('id', $id);
		
		if($d->update($data)){
				redirect("index.php?com=".$_GET['com']."&act=man");
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}else{
		$data['email'] = $_POST['email'];
		$d->query("select * from #_member where email = '".$_POST['email']."'");
		if($d->num_rows()){
			transfer("Email đã tồn tại", "index.php?com=".$_GET['com']."&act=man");
		}
		
		$d->setTable('member');
		
		$data['secret'] = md5(time());
		$data['password'] = comparePassword($data['secret'],$reg['password']);
		$data['ngaytao'] = time();
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
		$sql = "select * from #_member where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
				delete_file(_upload_news.$row['thumb1']);
			}
			$sql = "delete from #_member where id='".$id."'";
			if($d->query($sql)){
				//$d->query("delete from #_post where id_member = ".$id);
			
			}
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
		$sql = "select * from #_member where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
				delete_file(_upload_news.$row['thumb1']);
			}
			$sql = "delete from #_member where id='".$id."'";
			if($d->query($sql)){
			//	$d->query("delete from #_post where id_member = ".$id);
			
			}
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
			$d->query("select * from #_member where ten_vi = '".$name."'");
			$data_ = array();
			if($d->num_rows() == 1){
				$data_['cls'] = 'red';
				$data_['stt'] = 'Tin đã tồn tại';
			}else{
				$html = file_get_html($_POST['url']);
				$content = $html->find(".text-conent",0);
				$data['hienthi'] = 0;
				$data['ngaytao'] = time();
				$data['ten_vi'] = (magic_quote($name));
				$data['tenkhongdau'] = changeTitle(magic_quote($name));
				$data['noidung_vi'] = magic_quote($content);
				
				$data['photo'] = $img;
				
				$d->setTable("member");
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