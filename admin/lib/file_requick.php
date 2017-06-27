<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);
	$d->query("select * from #_setting");
	$global_setting = $d->fetch_array();
	if(!isset($_SESSION['lang'])){
		$_SESSION['lang']=$global_setting['default_lang'];
	}
	if(count($config['lang']) == 1){
		$lang=$global_setting['default_lang'];
	}else{
		$lang=$_SESSION['lang'];
	}
	if(!$com){
		if($lang=="vi"){
				redirect($config_url."/index.html");
		}else{
			redirect($config_url."/home.html");
		}
	}
	converLink();
	$maintenance = false;
	addLang();
	
	if($global_setting['site_maintenance'] & @$_GET['com']==""){
		$maintenance = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$maintenance.= $global_setting['site_maintenance_message']."</body></html>";
		
	}
	
	if(isset($_GET['action'])){
		if($_GET['action']=='active'){
			$code = $_GET['code'];
			$d->query("select id from #_member where secret='$code' and isActive=0");
			if(!$d->num_rows()){
				transfer("Mã xác nhận không tồn tại hoặc đã được kích hoạt!",$config_url);
			}else{
				$r = $d->fetch_array();
				$d->query("update table_member set isActive = 1 where id = ".$r['id']);
				transfer("Xác nhận thành công! Vui lòng đăng nhập.",$config_url);
			}
		}
	}	
	
	if (class_exists('model')) {
		
		$model = new model($d,$lang);
	}
	require_once _source."lang_$lang.php";
	
	switch($com)
	{
		case 'detect':
			include_once _template."detect.php";
			die();
			break;
		
		case 'ajax':
			$source = "ajax";
			break;	
		case 'home':
			$source = "index";
			$template = (isset($_GET['id'])) ? "index_item" : "index";
		break;	
		
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			break;
				case 'thanh-vien':
			$source = "member";
			
			break;
		case 'tag':
			$source = "tag";
			$template = isset($_GET['id']) ? $source."/detail" : $source."/index";
		break;
		
		case changeTitle(_wheretobuy):
			$source = "where";
			$template = $source."/index";
		break;	
		case 'css':
			$source = "css";
			//$template = "camera/index";
		break;
		
		
		case changeTitle(_about):
			$source = "baiviet";
			$_GET['id'] = 1;
			$template = "baiviet/detail";
			break;	
		case 'bai-viet':
			$source = "baiviet";
			$template = "content/detail";
			break;	
				
		case 'tuyen-dung':
			$source = "baiviet";
			$_GET['id'] = 2;
			$template = "content/detail";
			break;	
		case 'video':
			$source = "video";
			$template = isset($_GET['id']) ? "video/detail" : "video/index";
			break;	
		case changeTitle(_fabric):
			$stype = "fabric";
			$pfix = _fabric;
			$source = "product";
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
			break;	
		case changeTitle(_product):
			$stype = "product";
			$pfix = _product;
			$source = "product";
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
			break;
		
		case changeTitle(_promotion):
			$stype = "instock";
			$pfix = _instock;
			$source = "product";
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
			break;		
		/* case changeTitle(_promotion):
			$source = "product";
			$pfix = "Khuyến mãi";
			$promotion = 1;
			$template = isset($_GET['id']) ? "product/detail" : "product/index";
			break; */		
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			break;	
		case 'thanh-toan':
			$source = "thanhtoan";
			$template = "thanhtoan";
			break;		


		
		case 'dat-cau-hoi':
			$source = "question";
			$template =  "question/index";
			break;	
		case changeTitle(_exhibition):
			$source = "content";
			$type = "trienlam";
			$suffix = _exhibition;
			$template = @isset($_GET['id']) ? "content/detail_like_product" : "content/index_photo";
			break;	
		case 'tai-lieu':
			$source = "content";
			$type = "document";
			$suffix = "Tài liệu";
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_document";
			break;
		case 'thuc-don':
			$source = "menu";
			$template = isset($_GET['id']) ? "menu/detail" : "menu/index";
			break;
			
			case "phap-ly";
			$type = "juridical";
			$suffix = "Pháp lý";
			$source = "content";
			$template = @isset($_GET['id']) ? "content/detail" : "content/index";
			break;
			case "tham-dinh-gia";
			$type = "valuation";
			$suffix = "Thẩm định giá";
			$source = "content";
			$template = isset($_GET['id']) ? "content/detail" : "content/index";
			break;
		
		case 'tien-ich':
			$source = "content";
			$type = "tool";
			$perpage = 12;
			$suffix = "Tiện ích";
			$template = isset($_GET['id']) ? "content/detail" : "content/index_special2";
			break;	
		case 'du-an':
			$source = "content";
			$type = "project";
			$suffix = "Dự án";
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;		
		case 'dich-vu':
			$source = "content";
			$type = "service";
			$suffix = _service;
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;
		case 'cong-trinh':
			$source = "content";
			$type = "company";
			$suffix = "Công trình";
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;	
		case 'bang-gia':
			$source = "content";
			$type = "price";
			$suffix = "Bảng giá";
			$template = isset($_GET['id']) ? "content/detail_service" : "content/service_index";
			break;	
		case 'tin-tuc':
			$source = "content";
			$type = "news";
			$suffix = _news;
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;	
		case 'tu-van':
			$source = "content";
			$type = "tuvan";
			$suffix = 'Tư vấn';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
		break;
		case 'chinh-sach':
			$source = "content";
			$type = "chinhsach";
			$suffix = 'Chính sách';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
		break;
			case 'y-nghia-cac-loai-nuoc-hoa':
			$source = "content";
			$type = "poison";
			$suffix = 'Ý nghĩa các loại nước hoa';
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;
		case 'gioi-thieu2':
			$source = "content";
			$type = "about";
			$suffix = _about;
			$template = isset($_GET['id']) ? "content/detail_special" : "content/index_special";
			break;	
		
		
		
		case 'contact':
		case 'lien-he':
			$source = "contact";
			$template = "contact";
			break;	
		case 'search':
			$source = "search";
			$template = "search/product";
			break;	
		case 'ngonngu':
			if(isset($_GET['lang']))
			{
				switch($_GET['lang'])
					{
					case 'vi':
						$_SESSION['lang'] = 'vi';
						break;
					case 'en':
						$_SESSION['lang'] = 'en';
						break;
					case 'cn':
						$_SESSION['lang'] = 'cn';
						break;	
					
					default: 
						$_SESSION['lang'] = 'vi';
						break;
					}
			}
			else{
			$_SESSION['lang'] = 'vi';
			}
			$_SESSION['change_lang']=1;
			$_url = $_SERVER['HTTP_REFERER'];
			if(!$_url){
				$_url = "index.php";
			}else{
				$lang = $_SESSION['lang'];
				if($lang=="vi"){
					$_url = str_replace("/en/","/vi/",$_url);
				}else{
					$_url = str_replace("/vi/","/en/",$_url);	
				}
			}
			
			redirect($_url);
			break;				
		case '404':
			$source = "index";
			$template = "404";
			include _template.$template."_tpl.php";die;
			break;
		default: 
			$source = "index";
			$template = "index";
			break;
	}
	

	#  lay meta tim kiem
	$sql_meta = "select * from #_meta limit 0,1";
	$d->query($sql_meta);
	$row_meta= $d->fetch_array();	
	$title = $row_meta['title'];
	$description = $row_meta['description'];
	$keyword = $row_meta['keyword'];
	if($source!="") include _source.$source.".php";
	if(@$_REQUEST['com']=='logout')
	{
	session_unregister($login_name);
	header("Location:index.php");
	}

?>
