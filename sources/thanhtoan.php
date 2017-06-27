<?php  if(!defined('_source')) die("Error");		
	// thanh tieu de
	$title_bar .= "Thanh toán - ";
	

	
	if(!empty($_POST)){
		
	
		//validate dữ liệu
	
			 
			if(is_array($_SESSION['cart']))
			{
					$body = ' <table id="giohang" class="table table-bordered " style="margin-top:10px">';
                    if(is_array($_SESSION['cart'])){
                    $body .= '<thead><th align="center"></th><th>'._pname.'</th><th align="center">'._price.'</th><th align="center">'._quantity.'</th><th align="center">'._total_price.'</th></thead>';
                    foreach($_SESSION['cart'] as $k=>$v){
					$code  =$k;
                    $pid=$v['productid'];
                    $q=$v['qty'];					
                    $color = $v['color'];
                    $size = $v['size'];
                    $info=getProductInfo($pid);
                    $pname=get_product_name($pid);
                    $image = $config_url."/"._upload_sanpham_l.$info['thumb'];
                    if($color){
                    $img = getProductThumbnailWidthColor($pid,$color);
                    if($img){
                    $image = $config_url.$img;
                    }
                    }
                    if($q==0) continue;
                  
                     $body .='<tr bgcolor="#FFFFFF"><td width="10%" align="center"><a target="_blank"  href="'.$config_url.'san-pham/'.$info['id'].'/'.$info['tenkhongdau'].'.html"><img src="'.$image.'" class="img-responsive" /></a></td>';
                     $body .='<td width="35%"><a target="_blank" href="'.$config_url.'san-pham/'.$info['id'].'/'.$info['tenkhongdau'].'.html">'.$pname.'</a>';
					if ($color) {
					$colors = getColorByProductId($pid);
					 $body .= '<div class="product-option"><label>Màu sắc: </label>';
    
    foreach ($colors as $k2 => $v2) {
		if($v2['id_color'] == $color){
			$body .= "<strong class='red'>".$v2['ten']."</strong>";
		}
    }
$body .='<div class="clearfix"></div></div>';
}
if ($size) {
    $sizes = getSizeByProductId($pid);
    $body .= '<div class="product-option"><label>Kích thước: </label>';
   
    foreach ($sizes as $k2 => $v2) {
        if($v2['id_size'] == $size){
			$body .= "<strong class='red'>".$v2['ten']."</strong>";
		}
    }
   

    $body .='<div class="clearfix"></div></div>';
}
                      $body .= '</td>';
                       $body .= '<td width="10%" align="center">';
                           
                            if ($info['giacu'] > 0) {
                              $body .='<div class="price-old">' . myformat($info['giacu']) . '</div>';
                            }
                            $body .='<div class="price-real">' . myformat($info['gia']) . '</div>';
                           
                       $body .= '<td width="10%" align="center"><input type="text" name="product['.$code.']" value="'.$q.'" maxlength="3" size="2" style="text-align:center; border:1px solid #F0F0F0" />&nbsp;</td>';                    
                        $body .='<td width="18%" align="center" class="price-total">'.number_format(get_price($pid) * $q, 0, ',', '.').'&nbsp;VNĐ</td>';
                       
                      $body .='</tr>';
}
                     $body .=' <tr><td colspan="6" style="padding:0">';
                           $body .='<h3 class="all-cart-price">'._total_price.':'.number_format(get_order_total(), 0, ',', '.').'&nbsp;VNĐ</h3>';
                       $body .='   </td></tr>';
                   
                    
                    }
                    
            $body .=' </table>	';
			$mahoadon=strtoupper (ChuoiNgauNhien(6));
			$data['hoten'] = $_POST['bill']['name'];
			$data['dienthoai'] = $_POST['bill']['phone'];
			$data['diachi'] = $_POST['bill']['address'];
			$data['email'] = $_POST['bill']['email'];
			
			$data['receive_name'] = $_POST['receive']['name'];
			$data['receive_phone'] = $_POST['receive']['phone'];
			$data['receive_address'] = $_POST['receive']['address'];
			$data['receive_email'] = $_POST['receive']['email'];
			
			$data['hinhthucthanhtoan'] = $_POST['trans'];
			$data['hinhthucvanchuyen'] = $_POST['trans2'];
			$data['madonhang'] = $mahoadon;				
			
			$d->query("select * from #_hinhthucthanhtoan where id = '".$data['hinhthucthanhtoan']."'");
			$httt = $d->fetch_array();
			$d->query("select * from #_hinhthucvanchuyen where id = '".$data['hinhthucvanchuyen']."'");
			$htvc = $d->fetch_array();
			
			
			$data_email = $data;
			$data_email['httt'] = $httt['ten_'.$lang];
			$data_email['htvc'] = $htvc['ten_'.$lang]." - ".myformat($htvc['gia']);
			$data_email['ship'] = $htvc['gia'];
			$email_info = getInlineCssInfo($data_email);
			$ngaydangky=time();
			$tonggia=get_order_total();
			foreach($_SESSION['cart'] as $k=>$v){
					$xcart[] = addProduct($v['productid']);					
				}
			foreach($data as $k=>$v){
				$data[$k] = magic_quote($v);
			}
			$data['chitiet'] = mysql_real_escape_string(json_encode(($xcart)));
			$data['donhang'] = magic_quote($body);
			$data['ngaytao'] = $ngaydangky;
			$data['tinhtrang'] = 1;
			$data['tonggia'] = get_order_total()+ $htvc['gia'];
			$d->reset();
			$d->setTable("donhang");
			$d->insert($data);
			$d->query("select ten_$lang from #_hotline");
			$htl = $d->fetch_array();	
			sendEmail($global_setting['email_contact'],null,$htl['ten_'.$lang], "Thư đặt hàng từ ".$htl['ten_'.$lang], $email_info);
				 unset($_SESSION['cart']);
				 
				 
			}
			transfer("Đơn hàng của bạn đã được gửi", "index.html");
			
		
	}
	
	
		function addProduct($id){
			global $d;
			$d->query("select * from #_product where id =".$id);
			return $d->fetch_array();
		}