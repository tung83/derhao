<?php  if(!defined('_source')) die("Error");
	if(isAjaxRequest()){
	switch($_GET['act']){
		case 'update-transtype':
			transType();
			break;
		case 'add-cart':
			addCart();
			break;
			
		case 'get-cart-num':
			echo get_total();
			break;
		case 'get-location':
			echo get_location();
			break;	
		case 'newsletter':
			addNewsLetter();
			break;
		case 'contact':
			contact();
			break;
		case 'add-compare':
			addCompare();
			break;
		case 'get-compare':
	
			echo showCompare();
			break;
		case 'remove-compare':
			removeCompare();
			break;	
		case 'view-mini-cart':
			viewMiniCart();
			break;	
		case 'update-cart':
			updateCart();
			break;
		case 'delete-cart':
			deleteCart($_POST['id']);
			break;
		case 'clear-cart':
			unset($_SESSION['cart']);
			break;	
		
	}
	die;
	}
	die("<h2>ERROR</h2>");
	function get_location(){
		global $d;
		$lang = "vi";
		$id_province = $_POST['province'];
		$id_district = $_POST['district'];
		$sql = "select * from #_index where hienthi = 1";
		if($id_province){
			$sql.= " and  id_province = '".$id_province."' ";
		}if($id_district){
			$sql.= " and id_district = '".$id_district."' ";
		}
		$d->query($sql);
		
		$rs = $d->result_array();
		$arr = array();
		$i=0;
		
		foreach($rs as $k=>$v){
			
			$xa = '<img src="thumb/260x160/1/'._upload_news_l.$v['photo'].'" height="160" width="260" border="0"><br><br><strong>'.$v['ten_'.$lang].'</strong><br>'.$v['noidung_'.$lang];
			$xa.= "<p>"._address.": ".$v['address'].'</p>';
			$xa.= "<p>"._dienthoai.": ".$v['phone'].'</p>';
			$xa.= "<p>"._active_time2.": ".$v['active_time'].'</p>';
			$arr[$i][] = $xa;
			$arr[$i][] = $v['lat_'];
			$arr[$i][] = $v['long_'];
			$arr[$i][] = 3;
			$arr[$i]['id'] = $v['id'];
			$i++;
			
		}
		
		
		
		echo json_encode($arr);die;
	}
	function transType(){
		
		$price = get_order_total();
		echo json_encode(array("ship"=>myformat($_POST['price']),"price"=>myformat($price),"all"=>myformat($price+$_POST['price']),false));
		
	}	
	function contact(){
		global $d,$lang,$global_setting,$config_url;
		if(!empty($_POST))
		{
			
			$d->query("select ten_$lang from #_hotline");
			$htl = $d->fetch_array();	
			
				 
			$body = $global_setting['email_contact_form'];
			$arr = array("website"=>$config_url,"name"=>$_POST['name'],"phone"=>$_POST['phone'],"email"=>$_POST['email'],"date"=>date("h:i:s d-m-Y",time()),"content"=>$_POST['content']);
			foreach($arr as $k=>$v){
				$body = str_replace("%".$k."%",$v,$body);
			}
			echo json_encode (array("stt"=>sendEmail($global_setting['email_contact'],null,$htl['ten_'.$lang], "Thư liên hệ từ ".$htl['ten_'.$lang], $body)));
			
		}
	}
function addNewsletter(){
		global $d;
		$sql = "select * from #_newsletter where email = '".$_POST['email']."'";
		$d->query($sql);
		if(!$d->num_rows()){
				$d->setTable("newsletter");
				$d->insert(array("email"=>$_POST['email']));
		}
		die;
	
}
function viewMiniCart(){
global $config_url;
$str = '';
 if(is_array($_SESSION['cart'])){
	foreach($_SESSION['cart'] as $k=>$v){
					$code  =$k;
                    $pid=$v['productid'];
                    $q=$v['qty'];					
                    $color = $v['color'];
                    $size = $v['size'];
                    $info=getProductInfo($pid);
                    $pname=get_product_name($pid);
                    $image = _upload_sanpham_l.$info['thumb'];
                    if($color){
                    $img = getProductThumbnailWidthColor($pid,$color);
                    if($img){
                    $image = $config_url.$img;
                    }
                    }
                  

				$str.='<li id="gio_hang_sp_'.$k.'">';
				$str.='<a href="san-pham/'.$info['id'].'/'.$info['tenkhongdau'].'.html" target="_blank">';
				$str.='<img src="timthumb.php?src='.$config_url."/".$image.'&w=60&h=60"  alt="'.$pname.'" class="cart-img"></a>';
				$str.='<h3><a href="san-pham/'.$info['id'].'/'.$info['tenkhongdau'].'.html" target="_blank" title="'.$pname.'">'.cutString($pname,40).'</a></h3>';
				$str.='<h2>'.myformat($info['gia']).'<u></u></h2><a href="javascript:;" class="cart-less">x</a><span>'.$q.'</span>';
				$str.='<a href="javascript:;" class="cart-remove" onclick="delorder_gh(\''.$k.'\');" title="Xóa sản phẩm">Xóa</a><div class="clearfix"></div></li>';









	}					
	 
	 
	 
 }
 echo json_encode(array("data"=>$str,"total"=>myformat(get_order_total())));
 die;

}	

	
	
function deleteCart($id){
	unset($_SESSION['cart'][$id]);
	echo json_encode(array("total"=>myformat(get_order_total()),"qty"=>get_total()));
	die;
}
function updateCart(){
	
	$color = $_POST['color'];
	$size  = $_POST['size'];
	$product = $_POST['product'];
	
	foreach($product as $k=>$v){
		
		$_SESSION['cart'][$k]['qty'] = $v;
		$_SESSION['cart'][$k]['color'] = $color[$k];
		$_SESSION['cart'][$k]['size'] = $size[$k];
	}
	$tmp = array();
	foreach($_SESSION['cart'] as $k=>$v){
		md5($pid.$color.$size);
		$code = md5($v['productid'].$v['color'].$v['size']);
		
		if(isset($tmp[$code])){
			$tmp[$code]['qty'] = $tmp[$code]['qty']+$v['qty'];
		}else{
			$tmp[$code] = $v;
		}
	}
	$_SESSION['cart'] = $tmp;
}
function removeCompare(){
	$id = $_POST['id'];
	if(isset($_SESSION['product_compare'][$id])){
		unset($_SESSION['product_compare'][$id]);
	}
}
function showCompare(){
	global $lang;
	$str = '';
	if(count($_SESSION['product_compare']) == 0){
		$str = '<div style="border:1px solid #ccc;padding:5px;text-align:center;width:100%">Không có sản phẩm nào</div>';
		
		
	}else{
		
		if($_SESSION['product_compare']){
			foreach($_SESSION['product_compare'] as $k=>$v){
				
				$str.= '<div class="item">';
					$str.='<div class="tool">';
						$str.= '<a href="" onclick="removeCompare($(this));return false;" data-id="'.$k.'"><i class="glyphicon glyphicon-remove"></i></a>';
					$str.= '</div>';
					
					$str.= '<div class="name">';
						$str.= '<a href="san-pham/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>';
					$str.= '</div>';
				$str.= '<div class="clearfix"></div></div>';
			}		
		}
	}
	return $str;
}
function addCompare(){
	
	global $d,$lang;
	$id = $_POST['id'];
	$data['stt'] = 0;
	
	if(count($_SESSION['product_compare']) < 4){
	$d->query("select id,ten_$lang,mota_$lang,gia,tenkhongdau,thumb from #_product where id = ".$id);
		$rs = $d->fetch_array();
		$_SESSION['product_compare'][$rs['id']] = $rs;
		$data['stt'] = 1;
		
	}
	//$data['data'] = $_SESSION['product_compare'];
	echo json_encode($data);
	die;
}
function addCart(){
	
	$id = $_POST['id'];
	$qty = $_POST['qty'];
	
	$color = $_POST['color'];
	$size = $_POST['size'];
	if($color){
		$colors = getColorByProductId($id);
		if(count($colors)>0){
			$color = $colors[0]['id_color'];
		}
		
	}
	if($size){
		$sizes = getSizeByProductId($id);
		if(count($sizes)>0){
			$size = $sizes[0]['id_size'];
		}
		
	}
	addtocart($id,$qty,$color,$size);
	
	echo get_total();
	
}