<?php if(!defined('_lib')) die("Error");
#
#	$id_connect : ket noi database
#
function converLink(){
	global $lang,$com,$fixed_lang;
	$data['vi'] = array("index","gioi-thieu","vai","lien-he","san-pham","khuyen-mai","he-thong-dai-ly");
	$data['en'] = array("home","about-us","fabric","contact","product","promotion","where-to-buys");
	
	
	$ref = @$_SERVER['HTTP_REFERER'];
	if(!isset($_SESSION['change_lang'])){
		foreach($data as $k=>$v){
			if(in_array($com,$v)){
				$lang = $k;
			}
		}
		
	}
	
	$fixed_com="";
	$fixed_lang = "vi";
	
	if($lang=="vi"){
		$fixed_lang = "en";
	}	
	
	foreach($data[$fixed_lang] as $k=>$v){
		if($v==$com){
			$fixed_com = $data[$lang][$k];
		}
	}
	
	unset($_SESSION['change_lang']);
	if($fixed_com){
		$url = getCurrentPageURL();
		$url = str_replace("/$com/","/".$fixed_com."/",$url);
		$url = str_replace("/$com.html","/".$fixed_com.".html",$url);
		redirect($url);
		
	}
	
}

function addLang(){
	global $config;
	$l = $_GET['lang'];
	if($l){
	if(in_array($l,$config['lang'])){
		
		$_SESSION['lang'] = $l;
		if($_SESSION['lang']!=$l){
			redirect(getCurrentPageURL());
		}
		
	}else{
		
		$u = getCurrentPageURL();
	
		$u = str_replace("/$l/","/".$_SESSION['lang']."/",$u);
		
		redirect($u);
		
	}
	}

}
function getLink($str){
	global $lang;
	return $str;
}

function getoXimg($id){
	global $d;
	$d->query("select photo from #_baiviet where id = '".$id."'");
	$r = $d->fetch_array();
	return $r['photo'];
}
function getInlineCssInfo($data){
	$message = '<html><body>';
	$message = '<h3 style="text-align:center;">THÔNG TIN ĐƠN HÀNG <span style="color:red">'.$data['madonhang'].'</span></h3>';
	
	$message .= '<table rules="all" style="border-color: #ccc;border:1px solid #ccc;width:400px;margin:auto" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Tên khách hàng (Thanh toán):</strong> </td><td>" . strip_tags($data['hoten']) . "</td></tr>";
	$message .= "<tr><td><strong>Email (Thanh toán)::</strong> </td><td>" . strip_tags($data['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Điện thoại (Thanh toán)::</strong> </td><td>" . strip_tags($data['dienthoai']) . "</td></tr>";
	$message .= "<tr><td><strong>Địa chỉ (Thanh toán):</strong> </td><td>" . strip_tags($data['diachi']) . "</td></tr>";
	//$message .= "<tr><td><strong>Ghi chú:</strong> </td><td>" . strip_tags($data['msg']) . "</td></tr>";
	$message .= "<tr><td><strong>Ngày đặt hàng:</strong> </td><td>" . date("h:i:s d-m-Y",time()) . "</td></tr>";
	$message .= "</table>";
	$message .= "<hr />";
	$message .= '<table rules="all" style="border-color: #ccc;border:1px solid #ccc;width:400px;margin:auto" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Tên khách hàng (Nhận hàng):</strong> </td><td>" . strip_tags($data['receive_name']) . "</td></tr>";
	$message .= "<tr><td><strong>Email (Nhận hàng)::</strong> </td><td>" . strip_tags($data['receive_email']) . "</td></tr>";
	$message .= "<tr><td><strong>Điện thoại (Nhận hàng)::</strong> </td><td>" . strip_tags($data['receive_phone']) . "</td></tr>";
	$message .= "<tr><td><strong>Địa chỉ (Nhận hàng):</strong> </td><td>" . strip_tags($data['receive_address']) . "</td></tr>";
	//$message .= "<tr><td><strong>Ghi chú:</strong> </td><td>" . strip_tags($data['msg']) . "</td></tr>";
	//$message .= "<tr><td><strong>Ngày đặt hàng:</strong> </td><td>" . date("h:i:s d-m-Y",time()) . "</td></tr>";
	$message .= "</table>";
	
	$message .= '<h3 style="text-align:center;">THÔNG TIN SẢN PHẨM </h3>';
	
	$message .= '<table rules="all" style="border-color: #ccc;border:1px solid #ccc;width:700px;margin:auto" cellpadding="10">';
	$cart_ct = "<tr style='background: #eee;'><td>Tên sản phẩm</td><td>Số lượng</td><td>Đơn giá</td><td>Thành tiền</td></tr>";
	
	foreach($_SESSION['cart'] as $k=>$v){
					$code  =$k;
                    $pid=$v['productid'];
                    $q=$v['qty'];					
                    $color = $v['color'];
                    $size = $v['size'];
                    $info=getProductInfo($pid);
                    $pname=get_product_name($pid);
					$price = number_format(get_price($pid), 0, ',', '.');
					$tt_price = number_format(get_price($pid)*$q, 0, ',', '.');
			$cart_ct.="<tr><td>".$pname." [".$info['maso']."]"."</td><td>".$q."</td><td>".$price."</td><td>".$tt_price."</td></tr>";
	}
	$message.=$cart_ct;
	$message.="<tr><td colspan=4>Hình thức thanh toán : ".$data['httt']."</td></tr>";
	$message.="<tr><td colspan=4>Hình thức vận chuyển : ".$data['htvc']."</td></tr>";
	
	
	$message.="<tr><td colspan=4><div>Tổng tiền: ".number_format(get_order_total(), 0, ',', '.')."</div><div>Ship: ".myformat($data['ship'])."</div><div>Tổng tiền phải thanh toán: ".myformat(get_order_total()+$data['ship'])."</div></td></tr>";
	$message .= "</table>";
	
	$message .= "</body></html>";
	return $message;
}
function getData($filename,$result){
	global $d,$lang,$config_url;
	extract($result);
    ob_start();
	
    include $filename;
	//return $filename."_tpl.php";
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}
function initShowTooltip($item){
		global $lang,$d;
		$str = '<div class="hide example-popover-'.$item['id'].' ">';
		$str.= '<div class="popover-modal"><div class="popover-header">'.$item['ten_'.$lang].'</div>';
		$str.= '<div class="popover-body"><table class="table ">';
		
							$colors = getColorByProductId($item['id']);
							$color_product = array();
							foreach($colors as $k=>$v){
								$list_color[] = $v['id_color'];
								$color_product[$v['id_color']] = $v;
							}
			
						
							$d->query("select * from #_product_color where hienthi = 1 order by stt desc");
							foreach($d->result_array() as $k=>$v){
								$checked = false;
								$is_check = false;
								if(in_array($v['id'],$list_color)){
									$checked = "checked";
									$is_check =true;
								}
		$str.= '<tr><td width="40%">'.$v['ten_vi'].'</td>
				<td>'.@$color_product[$v['id']]['image'].'</td></tr>';				
			}	
		$str.= '</table>';
		$str.= '<div class="title">Tiện ích</div><p></p>';
		$str.= '<table class="table table-bordered">';
								$list_size = array();
								if($item['id']){
									$sizes = getSizeByProductId($item['id']);
									
									foreach($sizes as $k=>$v){
										$list_size[] = $v['id_size'];
									}
								}
								$d->query("select * from #_product_size where hienthi = 1 order by stt desc");
								$i=0;
								foreach($d->result_array() as $k=>$v){
									 
									//if($i==0){
										$str.= '<tr>';
									//	}
									
									 $str.= '<td>'.$v['ten_vi'].'</td>';
									 $str.= '<td>'.((in_array($v['id'],$list_size)) ? '<span class="green"><i class="glyphicon glyphicon-ok"></i></span>' : '<span class="red"><i class="glyphicon glyphicon-remove"></i></span>').'</td>';
									
									$i++;
									//if($i==2){
										$str.= '</tr>';
										$i=0;
									//}
									
								}

							$str.= '</table>';
							$str.= '<div class="clearfix"></div>';
		
		
		
		
		
		$str.= '</div></div></div>';
		return $str;
	
	
}
function convertString($str){
	return str_replace("\r\n","<br />",$str);
}
function removeDupBreak($str){
	return str_replace("<br /><br />","<br />",$str);
}
function PureUrl($x) {
   return implode('/', array_slice(explode('/', preg_replace('/https?:\/\/|www./', '', $x)), 0, 1));
}

function genFeatureSetting($id,$noibat = true){
	global $d;
	$d->query("select ten_vi as  ten,image as value from #_product_color pc,#_product_color_condition pcc where pc.id = pcc.id_color ".(($noibat) ? ' and noibat = 1' : '')." and  id_product = '".$id."' order by stt desc");
	return $d->result_array();
	
}
function comparePassword($secret, $password) {
		return md5($secret . $password);
	}
	function showProduct($v,$options=array(),$k=null){
		
		if(!isset($options['class'])){
			$options['class'] = 'col-xs-12 col-sm-6 col-md-4 col-lg-3 item-product	';
		}
		global $config_url,$lang;
		$error = "this.src='images/no_photo.png'";
		$link = "san-pham/".$v['tenkhongdau'].'-'.$v['id'].".html";
		echo '<div class="'.$options['class'].' wow fadeInUp" data-wow-offset="0" data-wow-duration="1" data-wow-delay="'.(0.2*$k).'s" data-id="'.$v['id'].'" data-name="'.$v['ten_'.$lang].'">';
				echo '<div class="">';
				echo '<div class="wrap-product">';
					echo '<div class="wrap-image col-xs-12 col-md-12 col-sm-12"><div class="row">';
						echo '<div class="relative-image">';
							$rb_cls ='';
							$percent = getPercent($v['giacu'],$v['gia']);
							
						
							if($percent > 0){
								echo '<div class="rb seller">';
								
									echo '<span>-'.$percent.'%</span>';
								
								echo '</div>';
							}
							echo '<div class="xm-image">';
							/*echo '<div class="x-view">
								<a href="'.$link.'" title="'._chitiet.' '._product.' '.$v['ten_'.$lang].'" class="fancybox fancybox.ajax"><i class="fa fa-expand"></i>&nbsp;'._chitiet.'</a>
							</div>';*/
							
							echo '<div class="x-inner"><a href="'.$link.'" title="'.$v['ten_'.$lang].'" class=""><img  src="thumb/270x260/2/'._upload_sanpham_l.$v['photo'].'" onerror="'.$error.'" class="img-responsive" alt="'.$v['ten_'.$lang].'" /></a></div>';
							
							
							echo '</div><!-- end xm-image -->';
							echo '<div class="tools">';
								echo '<div class="wrap-tools"><div class="inner-tools">';
								echo '<div class="clearfix"></div>';
								echo '<div class="name ">';
									echo '<h2><a href="'.$link.'" title="'.$v['ten_'.$lang].'">'.($v['ten_'.$lang]).'</a></h2>';
								echo '</div>';
								echo '<div class="clearfix"></div>';
								echo '<div class="tt">';
									echo '<span>Thể tích: '.$v['thetich'].'</span>';
								echo '</div>';
								echo '<div class="wrap-price">';
								/*if(($v['giacu'] > 0) & ($v['giacu'] > $v['gia']) & $v['gia'] > 0){
								echo '<div class="old-price pull-left">';
									echo '<span class="blue">'.myformat($v['giacu']).'</span>';
								echo '</div>';
								}*/
								echo '<div class="price ">';
									echo _gia.':<span>'.(($v['gia']) ? myformat($v['gia']) : '<a href="lien-he.html" title="Liên hệ">Liên hệ</a></span>').'</span>';
								echo '</div>';
								echo '</div><!-- end wrap-price -->';
							echo '<div class="clearfix"></div>';
							echo '<div class="add-cart">';
								echo '<a href="javascript:void(0)" onclick="doAddCart(\''.$v['ten_'.$lang].'\',\''.$v['id'].'\',1)"><i class="fa fa-shopping-bag"></i>&nbsp;'._addcart.'</a>';
							echo '</div>';
							echo '<div class="clearfix"></div>';
							echo '</div><!--end --></div></div><!-- end inner-tools--> <!-- end tools-->';
							echo '<div class="product-desc anim-05">';
								echo '<h2><a href="'.$link.'" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></h2>';
								echo removeDupBreak(convertString(strip_tags($v['mota_'.$lang])));
							echo '</div>';
						echo '</div>';
					echo '</div></div>';
					
					echo '<div class="wrap-desc col-xs-12 col-md-12 col-sm-12"><div class=" imt">';
						echo '<div class="product-name visible-xs">';
							echo '<h2><a href="'.$link.'" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></h2>';
						echo '</div>';
						echo '<div class="product-price hide">';
							echo '<div class="pull-right add-cart">';
								echo '<a href="javascript:void(0)" onclick="addToCart(\''.$v['id'].'\',\''.$v['ten_'.$lang].'\',1)">'._addcart.'</a>';
							echo '</div>';
							echo '<div class="clearfix"></div>';
						echo '</div>';
						
					
					echo '</div></div>';
				
				echo '</div>';
				echo '</div>';
			
			echo '</div>';
		
	}

	function getPercent($old,$new){
		if($old > $new)
			return round(100-($new/$old)*100);
		return -1;
	}
	function getColorByProductId($pid){
		global $d;
		
		$d->query("select #_product_color_condition.*,#_product_color.ten_vi as ten,bg_color,text_color from #_product_color_condition,#_product_color where #_product_color.id = #_product_color_condition.id_color and hienthi = 1 and id_product = ".$pid." order by stt desc");
		return $d->result_array();
	}
	function getSizeByProductId($pid){
		global $d,$lang;
		if(!$lang){
			$lang = "vi";
		}
		$d->query("select sc.*,s.ten_$lang as ten,photo,id_danhmuc from #_product_size_condition sc,#_product_size s where sc.id_size = s.id and hienthi = 1 and  id_product = ".$pid." order by stt desc");
		return $d->result_array();
	}
	function objectToArray ($object) {
    if(!is_object($object) && !is_array($object))
        return $object;

    return array_map('objectToArray', (array) $object);
}
function sanitize_output2($buffer) {

    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}
	
function sendEmail($to, $from=null, $from_name=null, $subject, $body,$more=array(),$file='') { 
	include_once "phpMailer/class.phpmailer.php";	
	global $error;
	if(!$from_name){
		$from_name = _MAIL_USER;//'noreply@mevabembcare.com';
	}
	if(!$from){
		$from = _MAIL_USER;//'noreply@mevabembcare.com';
	}
	$mail = new PHPMailer();  // tạo một đối tượng mới từ class PHPMailer
	$mail -> CharSet  =  'UTF-8' ;
	$mail->IsSMTP(); // bật chức năng SMTP
	$mail->SMTPDebug = 1;  // kiểm tra lỗi : 1 là  hiển thị lỗi và thông báo cho ta biết, 2 = chỉ thông báo lỗi
	$mail->SMTPAuth = true;  // bật chức năng đăng nhập vào SMTP này
	$mail->Username = _MAIL_USER;  
	$mail->Password = _MAIL_PWD;           
	if(_MAIL_IP){
	
	//$mail->SMTPSecure = 'ssl'; // sử dụng giao thức SSL vì gmail bắt buộc dùng cái này
	$mail->Host = _MAIL_IP;
	//$mail->Port = 465; 
	}else{
												   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
		
	}
	$mail->SetFrom($from, $from_name);
	$mail->IsHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if($file){
		foreach($file as $k=>$v){
				$mail->AddAttachment($v[0],$v[1]);
		}
	}
	if(count($more) > 0){
		foreach($more as $k=>$v){
			$mail->AddAddress($v['email']);
		
		}
		
	}
	
	if(!$mail->Send()) {
		
		//echo 'Gởi mail bị lỗi: '.$mail->ErrorInfo; 
	
		return false;
	} else {
		//$error = 'Thư của bạn đã được gởi đi ';
		return true;
	}
	}  
function ajaxData($item){
	global $lang;
	$arr = array();
	$arr['content'] = $item['noidung_'.$lang];
	$arr['desc'] = $item['mota_'.$lang];
	$arr['name'] = $item['ten_'.$lang];
	echo json_encode($arr);
	die;

}
function initList($name,$field_name,$table,$id=null){
	global $d;
	echo  '<div style="margin:0px 0" class="col-sm-12">
	<div class="form-group form-group-sm">
		<label for="" class="col-sm-4 control-label">'.$name.'</label> 
			<div class="col-sm-6">
				<select required="" id="'.$field_name.'" class="form-control col-sm-6 id_list_chk" name="'.$field_name.'">
						<option value="">-Chọn -</option>';
							$d->query("select * from #_".$table." order by stt desc");
							
							foreach($d->result_array() as $k=>$v){
								$slt = '';
								if($id){
									
									if($v['id'] == $id){
										$slt = "selected";
							
									
									}
									
								}
								
								echo '<option value="'.$v['id'].'" '.$slt.'>'.$v['ten_vi'].'</option>';
								
							
							
							}
						
							echo '</select></div></div></div>';



}



function magic_quote($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		
		return $str;
	}
	
	if (is_numeric($str)) {
		return $str;
	}
	
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}

	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return mysql_real_escape_string($str, $id_connect);
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return @mysql_escape_string($str);
	}
	else
	{
		return addslashes($str);
	}
}

#
#	$id_connect : ket noi database
#
function escape_str($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		
		return $str;
	}
	
	if (is_numeric($str)) {
		return $str;
	}
	
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}

	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return "'".mysql_real_escape_string($str, $id_connect)."'";
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return "'".mysql_escape_string($str)."'";
	}
	else
	{
		return "'".addslashes($str)."'";
	}
}
// dem so nguoi online //
/////////////////////////
function current_url(){
	return getCurrentPageURL();

}
function count_online(){
/*
CREATE TABLE `camranh_online` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `session_id` varchar(255) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
*/
	global $d;
	$time = 600; // 10 phut
	$ssid = session_id();

	// xoa het han
	$sql = "delete from #_online where time<".(time()-$time);
	$d->query($sql);
	//
	$sql = "select id,session_id from #_online order by id desc";
	$d->query($sql);
	$result['dangxem'] = $d->num_rows();
	$rows = $d->result_array();
	$i = 0;
	while(($rows[$i]['session_id'] != $ssid) && $i++<$result['dangxem']);
	
	if($i<$result['dangxem']){
		$sql = "update #_online set time='".time()."' where session_id='".$ssid."'";
		$d->query($sql);
		$result['daxem'] = $rows[0]['id'];
	}
	else{
		$sql = "insert into #_online (session_id, time) values ('".$ssid."', '".time()."')";
		$d->query($sql);
		$result['daxem'] = mysql_insert_id();
		$result['dangxem']++;
	}
	
	
	
	
	$is_add = 0;
	$d->query("select * from #_statistics where st_ip='".$_SERVER['REMOTE_ADDR']."' and st_week = '".date("W")."' and st_day = '".date("d")."' order by st_time desc");
	if($d->num_rows() == 0){
			$is_add = 1;
	}else{
		$rs = $d->fetch_array();
		if($rs['st_time']+300 < time()){
			$is_add = 1;
		}
	}
	if($is_add){
		$sql = "insert into #_statistics(st_time,st_week,st_month,st_day,st_year,st_ip,st_url) value(".time().",".date("W").",".date("m").",".date("d").",".date("Y").",'".$_SERVER['REMOTE_ADDR']."','".current_url()."')";
		$d->query($sql);
	}	

		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".((date("m")))."' and   st_day = '".(date("d")-1)."'";
		
		$d->query($sql);
		$statistics['yesterday'] = $d->num_rows();
		
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".((date("m")))."' and   st_day = '".date("d")."'";
		
		$d->query($sql);
		$statistics['today'] = $d->num_rows();
		
		
		
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".date("m")."' and st_week = '".date("W")."'";
		
		$d->query($sql);
		$statistics['week'] = $d->num_rows();
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_week = '".(date("W")-1)."'";
		$d->query($sql);
		
		$statistics['last_week'] = $d->num_rows();
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".date("m")."'";
		$d->query($sql);
		$statistics['month'] = $d->num_rows();
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".(date("m")-1)."'";
		
		$d->query($sql);
		$statistics['last_month'] = $d->num_rows();
		
		$sql = $sql = "select * from #_statistics";
		$d->query($sql);
		$statistics['all'] = $d->num_rows();
		
		$result['advance'] = $statistics;
		
	
	return $result; // array('dangxem'=>'', 'daxem'=>'')
}

function make_date($time,$dot='.',$lang='vi',$f=false){
	
	$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y",$time) : date("m{$dot}d{$dot}Y",$time);
	if($f){
		$thu['vi'] = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
		$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$str = $thu[$lang][date('w',$time)].', '.$str;
	}
	return $str;
}

function alert($s){
	echo '<script language="javascript"> alert("'.$s.'") </script>';
}

function delete_file($file){
		return @unlink($file);
}

function upload_image($file, $extension, $folder, $newname='',$maxw='',$maxh=''){
	global $config;
	
	if(isset($_FILES[$file]) && !$_FILES[$file]['error']){
		$ar = explode(".",$_FILES[$file]['name']);
		$ext = @end($ar);
		$name = basename($_FILES[$file]['name'], '.'.$ext);
		
		if(strpos($extension, $ext)===false){
			alert('Chỉ hỗ trợ upload file dạng '.$extension);
			return false; // không hỗ trợ
		}
		if($newname){
			$name = $newname;
		}
		$_FILES[$file]['name'] = $name.".".$ext;
		
		if(file_exists($folder.$_FILES[$file]['name'])){
		
					$_FILES[$file]['name'] = $name."-".rand(0,999).'.'.$ext;

				
		}		
		
		
		if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
			if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
				
				return false;
			}
		}
		
		if(smart_resize_image($folder.$_FILES[$file]['name'],(($maxw) ? $maxw : $config['max-width']),(($maxh) ? $maxh : $config['max-height']))){
			return $_FILES[$file]['name'];
		}else{
			return $_FILES[$file]['name'];
		}
		
	}
	
	return false;
}

function thumb_image($file, $width, $height, $folder){	
	
	if(!file_exists($folder.$file))	return false; // không tìm thấy file
	
	if ($cursize = getimagesize ($folder.$file)) {					
		$newsize = setWidthHeight($cursize[0], $cursize[1], $width, $height);
		$info = pathinfo($file);
		
		$dst = imagecreatetruecolor ($newsize[0],$newsize[1]);
		
		$types = array('jpg' => array('imagecreatefromjpeg', 'imagejpeg'),
					'gif' => array('imagecreatefromgif', 'imagegif'),
					'png' => array('imagecreatefrompng', 'imagepng'));
		$func = $types[$info['extension']][0];
		$src = $func($folder.$file); 
		imagecopyresampled($dst, $src, 0, 0, 0, 0,$newsize[0], $newsize[1],$cursize[0], $cursize[1]);
		$func = $types[$info['extension']][1];
		$new_file = str_replace('.'.$info['extension'],'_thumb.'.$info['extension'],$file);
		
		return $func($dst, $folder.$new_file) ? $new_file : false;
	}
}


function setWidthHeight($width, $height, $maxWidth, $maxHeight){
	$ret = array($width, $height);
	$ratio = $width / $height;
	if ($width > $maxWidth || $height > $maxHeight) {
		$ret[0] = $maxWidth;
		$ret[1] = $ret[0] / $ratio;
		if ($ret[1] > $maxHeight) {
			$ret[1] = $maxHeight;
			$ret[0] = $ret[1] * $ratio;
		}
	}
	return $ret;
}


function transfer($msg,$page="index.php")
{	
	global $config_url;
	 $showtext = $msg;
	 $page_transfer = $page;
	 include("./templates/transfer_tpl.php");
	 exit();
}


function redirect($url=''){
	echo '<script language="javascript">window.location = "'.$url.'" </script>';
	exit();
}

function back($n=1){
	echo '<script language="javascript">history.go = "'.-intval($n).'" </script>';
	exit();
}

function chuanhoa($s){
	$s = str_replace("'", '&#039;', $s);
	$s = str_replace('"', '&quot;', $s);
	$s = str_replace('<', '&lt;', $s);
	$s = str_replace('>', '&gt;', $s);
	return $s;
}

function themdau($s){
	$s = addslashes($s);
	return $s;
}

function bodau($s){
	$s = stripslashes($s);
	return $s;
}

function dump($arr, $exit=1){
	echo "<pre>";	
		var_dump($arr);
	echo "<pre>";	
	if($exit)	exit();
}

	function paging($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="<ul class='pagination pagination-sm   append-pagin'>";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];
			
		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			$start=1;
			$end=1;
			$paging1 ="";				 	 
			for($i=1;$i<=$totalPages;$i++)
			{	
				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
				{
					if($start==1) $start=$i;
					if($i==$curPg){
						$paging1.=" <span>".$i."</span> ";//dang xem
					} 		  	
					else    
					{
						$paging1 .= " <a href='".$url."&curPage=".$i."'  class=\"{$class_paging}\">".$i."</a> ";	
					}
					$end=$i;	
				}
			}//tinh paging
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			#if($curPg>$mxP)
			#{
				$paging .=" <a href='".$url."' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau
				
				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
				$paging .=" <a href='".$url."&curPage=".($curPg-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
			#}
			$paging.=$paging1; 
			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			#{
				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				$paging .=" <a href='".$url."&curPage=".($curPg+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				
				$paging .=" <a href='".$url."&curPage=".($totalPages)."' class=\"{$class_paging}\" >&raquo;</a> "; //ve cuoi
			#}
		}
		
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging.'</ul>';
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}
function paging_home($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];
			
		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			$start=1;
			$end=1;
			$paging1 ="";				 	 
			for($i=1;$i<=$totalPages;$i++)
			{	
				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
				{
					if($start==1) $start=$i;
					if($i==$curPg){
						$paging1.="<li class='active'><a href='javascript:voi(0)'><span>".$i."</span></a></li>";//dang xem
					} 		  	
					else    
					{
						$paging1 .= "<li> <a href='".$url."/p=".$i."'  class=\"{$class_paging}\">".$i."</li></a> ";	
					}
					$end=$i;	
				}
			}//tinh paging 
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			#if($curPg>$mxP)
			#{
				$paging = '<div style="text-align:center"><ul class="pagination pagination-sm">';
				$paging .=" <li> <a href='".$url."' class=\"{$class_paging}\" >Trang đầu</a> </li>"; //ve dau
				
				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc
				$paging .="<li> <a href='".$url."/p=".($curPg-1)."' class=\"{$class_paging}\" >&laquo;</a></li> "; //ve truoc
			#}
			$paging.=$paging1; 
			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			#{
				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke
				$paging .=" <li> <a href='".$url."/p=".($curPg+1)."' class=\"{$class_paging}\" >&raquo;</a> </li> "; //ke
				
				$paging .=" <li> <a href='".$url."/p=".($totalPages)."' class=\"{$class_paging}\" >Trang cuối</a></li>  "; //ve cuoi
			#}
			$paging.='</ul></div>';
		}
		$r3['perPage']=$mxR;
		$r3['totalPage']=$totalPages;
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=str_replace("//p=","/p=",$paging);
		$r3['total']=$totalRows;
		
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}
function catchuoi($chuoi,$gioihan){
// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt
// thì không thay đổi chuỗi ban đầu
if(strlen($chuoi)<=$gioihan)
{
return $chuoi;
}
else{
/*
so sánh vị trí cắt
với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt
nếu vị trí khoảng trắng lớn hơn
thì cắt chuỗi tại vị trí khoảng trắng đó
*/
if(strpos($chuoi," ",$gioihan) > $gioihan){
$new_gioihan=strpos($chuoi," ",$gioihan);
$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
return $new_chuoi;
}
// trường hợp còn lại không ảnh hưởng tới kết quả
$new_chuoi = substr($chuoi,0,$gioihan)."...";
return $new_chuoi;
}
}

function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ',
     'D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
   	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
   	  'i'=>'í|ì|ỉ|ĩ|ị',	  
   	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
   	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
   	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
   );
   foreach($unicode as $khongdau=>$codau) {
     	$arr=explode("|",$codau);
   	  $str = str_replace($arr,$khongdau,$str);
   }
return $str;
}// Doi tu co dau => khong dau

function changeTitle($str)
{
	$str = stripUnicode($str);
	$str = strtolower($str);
	$str = trim($str);
	$str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}
function getCurrentPageURL() {
    $pageURL = 'http';
    if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
	$pageURL = explode("/p=", $pageURL);
    return $pageURL[0];
}
function create_thumb($file, $width, $height, $folder,$file_name,$zoom_crop='1'){

// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?
$x = explode(".",$file);
$file_name =$x[0];
$new_width   = $width;
$new_height   = $height;

 if ($new_width && !$new_height) {
        $new_height = floor ($height * ($new_width / $width));
    } else if ($new_height && !$new_width) {
        $new_width = floor ($width * ($new_height / $height));
    }
	
$image_url = $folder.$file;
$origin_x = 0;
$origin_y = 0;
// GET ORIGINAL IMAGE DIMENSIONS
$array = getimagesize($image_url);
if ($array)
{
    list($image_w, $image_h) = $array;
}
else
{
     die("NO IMAGE $image_url");
}
$width=$image_w;
$height=$image_h;

// ACQUIRE THE ORIGINAL IMAGE
$image_ext = @trim(strtolower(end(explode('.', $image_url))));
switch(strtoupper($image_ext))
{
     case 'JPG' :
     case 'JPEG' :
         $image = imagecreatefromjpeg($image_url);
		 $func='imagejpeg';
         break;
     case 'PNG' :
         $image = imagecreatefrompng($image_url);
		 $func='imagepng';
         break;
	 case 'GIF' :
	 	 $image = imagecreatefromgif($image_url);
		 $func='imagegif';
		 break;

     default : die("UNKNOWN IMAGE TYPE: $image_url");
}

// scale down and add borders
	if ($zoom_crop == 3) {

		$final_height = $height * ($new_width / $width);

		if ($final_height > $new_height) {
			$new_width = $width * ($new_height / $height);
		} else {
			$new_height = $final_height;
		}

	}

	// create a new true color image
	$canvas = imagecreatetruecolor ($new_width, $new_height);
	imagealphablending ($canvas, false);

	// Create a new transparent color for image
	$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 0);

	// Completely fill the background of the new image with allocated color.
	imagefill ($canvas, 0, 0, $color);

	// scale down and add borders
	if ($zoom_crop == 2) {

		$final_height = $height * ($new_width / $width);
		
		if ($final_height > $new_height) {
			
			$origin_x = $new_width / 2;
			$new_width = $width * ($new_height / $height);
			$origin_x = round ($origin_x - ($new_width / 2));

		} else {

			$origin_y = $new_height / 2;
			$new_height = $final_height;
			$origin_y = round ($origin_y - ($new_height / 2));

		}

	}

	// Restore transparency blending
	imagesavealpha ($canvas, true);

	if ($zoom_crop > 0) {

		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;

		$cmp_x = $width / $new_width;
		$cmp_y = $height / $new_height;

		// calculate x or y coordinate and width or height of source
		if ($cmp_x > $cmp_y) {

			$src_w = round ($width / $cmp_x * $cmp_y);
			$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);

		} else if ($cmp_y > $cmp_x) {

			$src_h = round ($height / $cmp_y * $cmp_x);
			$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);

		}

		// positional cropping!
		if (@$align) {
			if (strpos ($align, 't') !== false) {
				$src_y = 0;
			}
			if (strpos ($align, 'b') !== false) {
				$src_y = $height - $src_h;
			}
			if (strpos ($align, 'l') !== false) {
				$src_x = 0;
			}
			if (strpos ($align, 'r') !== false) {
				$src_x = $width - $src_w;
			}
		}

		imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

    } else {

        // copy and resize part of an image with resampling
        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    }
	


$new_file=$file_name.'_'.$new_width.'x'.$new_height.'.'.$image_ext;
// SHOW THE NEW THUMB IMAGE
if($func=='imagejpeg') $func($canvas, $folder.$new_file,100);
else $func($canvas, $folder.$new_file,floor ($quality * 0.09));

return $new_file;
}
function ChuoiNgauNhien($sokytu){
$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
for ($i=0; $i < $sokytu; $i++){
	$vitri = mt_rand( 0 ,strlen($chuoi) );
	$giatri= $giatri . substr($chuoi,$vitri,1 );
}
return $giatri;
} 

function check($s){
	echo "<pre>";
	print_r($s);
	echo "</pre>";
}
function getIP(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
return $ip;
}
function getBrowser(){
	return $_SERVER['HTTP_USER_AGENT'];
}

function cutString($str,$len=200,$more=''){
	if ($str=="" || $str==NULL) return $str;
	if (is_array($str)) return $str;
	$str = trim($str);
	if (strlen($str) <= $len) return $str;
	$str = substr($str,0,$len);
	if ($str != "") {
	if (!substr_count($str," ")) {
	if ($more) $str .= " ...";
	return $str;
	}
	while(strlen($str) && ($str[strlen($str)-1] != " ")) {
	$str = @substr($str,0,-1);
	}
	$str = substr($str,0,-1);
	if ($more){ $str .=$more;}else{
					$str .= ' ...';
				}   
					
	}
	return $str;
}
function checkValidUrl($url){
	 $regex = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";   
     return preg_match($regex, $url);
}
function getYoutubeIdFromUrl($url) {
    $parts = parse_url($url);
    if(isset($parts['query'])){
        parse_str($parts['query'], $qs);
        if(isset($qs['v'])){
            return $qs['v'];
        }else if($qs['vi']){
            return $qs['vi'];
        }
    }
    if(isset($parts['path'])){
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path)-1];
    }
    return false;
}
function videoType($url) {
    if (strpos($url, 'youtube') > 0) {
        return 'youtube';
    } elseif (strpos($url, 'vimeo') > 0) {
        return 'vimeo';
    } else {
        return false;
    }
}
function showEr(){
    error_reporting(E_ALL);
}
if(!function_exists("myformat")){
   function myformat($num,$ext='VNĐ',$default = false){
       if($num==0){
         if(!$default){
             return 0;
         }else{
             return myconfig("default_price");
         }
       }else{
           return @number_format($num, 0,'', '.')." ".$ext;
       }
    }
}
function getLocation($address)	{ 
	
	$prepAddr = str_replace(' ','+',$address);
	$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
	$output= json_decode($geocode);
	$latitude = $output->results[0]->geometry->location->lat;
	$longitude = $output->results[0]->geometry->location->lng;
	return array("x"=>$latitude,"y"=>$longitude);
	}
function getThumb($url,$type=0){
	//return "timthumb.php
	
}
function isAjaxRequest(){
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
		return true;
	return false;
}
function initSeo(&$data){
	global $config;
	$data['seo_title'] = $_POST['seo_title'];
	$data['seo_keyword'] = $_POST['seo_keyword'];
	$data['seo_description'] = $_POST['seo_description'];
	
}
 function url_title($str, $separator = 'dash', $lowercase = TRUE)
	{
		
		if ($separator == 'dash')
		{
			$search		= '_';
			$replace	= '-';
		}
		else
		{
			$search		= '-';
			$replace	= '_';
		}
		
		$trans = array(
						'&\#\d+?;'				=> '',
						'&\S+?;'				=> '',
						//'\s+'					=> $replace,
						'/([^\pL\.\ ]+)/u'		=> '',
						//'[^a-z0-9\-\._]'		=> '',
						$replace.'+'			=> $replace,
						$replace.'$'			=> $replace,
						'^'.$replace			=> $replace,
						'\.+$'					=> ''
						
					);

		$str = strip_tags($str);
		$str = str_replace('(','',$str);
		$str = str_replace('.','',$str);
		$str = str_replace(')','',$str);
		$str = str_replace(',','',$str);
		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);
		}
		$str = str_replace('-','',$str);
		
		$str = str_replace('-','',$str);
		if ($lowercase === TRUE)
		{
			$str = mb_strtolower($str,'UTF-8');
		}
		
		return trim(stripslashes($str));
	}
/*
* return an array whose elements are shuffled in random order.
*/
function custom_shuffle($my_array = array()) {
  $copy = array();
  while (count($my_array)) {
    // takes a rand array elements by its key
    $element = array_rand($my_array);
    // assign the array and its value to an another array
    $copy[$element] = $my_array[$element];
    //delete the element from source array
    unset($my_array[$element]);
  }
  return $copy;
}

/* init add table */


	
	
	
	
	
	
	
	
	function smart_resize_image($file,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = true, 
                              $output             = 'file', 
                              $delete_original    = true, 
                              $use_linux_commands = false ) {
							
							  
      
    if ( $height <= 0 && $width <= 0 ) return false;

    # Setting defaults and meta
    $info                         = getimagesize($file);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;

	

	if(($width_old < $width) | ($height_old < $height)){
	
		return false;

	}

    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );

      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
    }
	ini_set('memory_limit', '-1');
    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $image = imagecreatefromjpeg($file);  break;
      case IMAGETYPE_GIF:   $image = imagecreatefromgif($file);   break;
      case IMAGETYPE_PNG:   $image = imagecreatefrompng($file);   break;
      default: return false;
    }
    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);

      if ($transparency >= 0) {
        $transparent_color  = imagecolorsforindex($image, $trnprt_indx);
        $transparency       = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
    
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }

    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
    
    # Writing image according to type to the output destination
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output);   break;
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_PNG:   imagepng($image_resized, $output);    break;
      default: return false;
    }

    return true;
  }
  
  function advanceStatictis(){	
		global $d;
		$is_add = 0;
		$d->query("select * from #_statistics where st_ip='".@$_SERVER['REMOTE_ADDR']."' and st_week = '".date("W")."' and st_day = '".date("d")."' order by st_time desc");
		if($d->num_rows() == 0){
				$is_add = 1;
		}else{
			$rs = $d->fetch_array();
			if($rs['st_time']+300 < time()){
				$is_add = 1;
			}
		}
		if($is_add){
			$sql = "insert into #_statistics(st_time,st_week,st_month,st_day,st_year,st_ip,st_url) value(".time().",".date("W").",".date("m").",".date("d").",".date("Y").",'".$_SERVER['REMOTE_ADDR']."','')";
			$d->query($sql);
		}	
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_week = '".date("W")."'";
		$d->query($sql);
		$statistics['week'] = $d->num_rows();
		$sql = "select * from #_statistics where st_year = '".date("Y")."' and st_month = '".date("m")."'";
		$d->query($sql);
		$statistics['month'] = $d->num_rows();
		$sql = $sql = "select * from #_statistics";
		$d->query($sql);
		$statistics['all'] = $d->num_rows();
		
		
		
		return $statistics;
  
  
  }
function addingSeo($rs) {

    global $keyword, $description;
    if ($rs['seo_keyword']) {
        $keyword = $rs['seo_keyword'];
    }

    if ($rs['seo_description']) {
        $description = $rs['seo_description'];
    }
}