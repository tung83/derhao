<?php  if(!defined('_source')) die("Error");
	global $d,$loaibds;
	switch($_GET['act']){
		case 'open-form':	
			$type = $_POST['type'];
			if($type=="change"){
				$d->query("select * from #_member where id = ".$_SESSION['member_log']['id']);
				$_SESSION['member_log'] = $d->fetch_array();
				include _template."member/thaydoi_tpl.php";	
				die;
			}
			include _template."member/register_tpl.php";		
			die;
			break;
		case 'thay-doi-thong-tin':
			checkLogin();
			getMember();
			$template = "member/thaydoithongtin";
			break;
		case 'dang-ky':
			$success = false;
			checkIsLogin();
			memberRegister();
			$template = "member/register_default";		
			break;
		case 'valid':
			checkValid();
			break;
		case 'tao-mat-khau':
			if(isAjaxRequest()){
				$respon = array();
				if(isset($_POST['create'])){
					$member_log = $_SESSION['member_log'];
					$respon['stt'] = false;
					$err = array();
					$data = array();
					$u = '';
					if(isset($_POST['username'])){
						$u = $_POST['username'];
						if (!preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/', $u)){
							$err['username'] = 'T�n dang nh?p kh�ng d�ng d?nh d?ng!';
						}else{
							$d->query("select id from #_member where username = '".$u."'");
							if($d->num_rows() != 0){
								$err['username'] = 'T�n dang nh?p d� c� ngu?i x? d?ng!';
							}else{
							$data['username'] = $u;
							}
						}
						
					}
					$p = $_POST['password'];
					$rp = $_POST['repassword'];
					if(strlen($p) < 8){
						$err['password'] = 'M?t kh?u �t nh?t 8 k� t?';
					}else{
						if($p!=$rp){
							$err['repassword'] = 'M?t kh?u nh?p l?i kh�ng d�ng!';
						}
					}
					
					if(count($err) == 0){
						$data['password'] = comparePassword($member_log['secret'],$p);
						$d->setTable("member");
						$d->setWhere("id",$member_log['id']);
						$d->update($data);
						$respon['stt'] = true;
					}
					$respon['data'] = $err;
					echo json_encode($respon);
				}else{
					include_once _template."member/createPassword_tpl.php";
				}
				die();
			}else{
				die("Error");
			}
			break;
		case 'checkcaptcha':
			checkCaptcha();
			break;
		case 'upload':
				checkLogin();
				checkUpload();
			
				break;
		case 'remove':
			checkLogin();
			deleteFile();
			break;
		case 'don-hang':
			checkIsLogin();
			$template = "member/donhang";	
			checkDonHang();
			break;	
		case 'login':
                        
			if(isAjaxRequest()){
				initLogin();
			}
			break;
		case 'dang-nhap':
            checkIsLogin();
			login_member();
		
			$template = "member/login";		
			if(isAjaxRequest()){
				include_once _template.$template."_tpl.php";
				die();
			}
			break;	
		case 'addtag':
			addTag();
			break;
		case 'logout':
			unset($_SESSION['member_log']);
			redirect($config_url);
			break;
		case 'main':
			checkLogin();
			$template = "member/main";		
			break;
		case 'dang-tin':
			checkLogin();
			initMember();
			postTin();
			$template = "member/dangtin";
			break;
		case 'thay-doi-thong-tin':
			checkLogin();
			getMember();
			$template = "member/thaydoithongtin";
			break;	
		case 'tin-dang-hien-thi':
			checkLogin();
			initMember();
			displayPost(1);
			$template = "member/tinhienthi";
			break;	
		case 'tin-chua-duoc-duyet':
			checkLogin();
			initMember();
			displayPost(0);
			$template = "member/tinchuaduyet";
			break;
		case 'tin-khong-duoc-duyet':
			checkLogin();
			initMember();
			displayPost(-1);
			$template = "member/tinkhongduyet";
			break;	
		case 'chinh-sua':
			
			checkLogin();
			initMember();
			postTin();
			editPost();
			$template = "member/suatin";
			break;
		case 'check':
			
			check_valid();
			break;
		default:
			break;
	
	}
	function mInfo($key){
		if(isset($_SESSION['member_log'][$key])){
			return $_SESSION['member_log'][$key];
		}
		return false;
	}
	function checkValid(){
		if(isAjaxRequest()){
		
			global $d,$err,$success;
			
			$reg = $_POST['reg'];
			$error = array();
			$error['stt'] = false;
			if(!isset($_POST['edit'])){
				if(1!=1){//if($_POST['captcha'] != $_SESSION['captcha']){
					$error['data']['captcha'] = "Mã bảo vệ không đúng!";
					$error['stt'] = 1;
				}else{
					$sql = "select * from #_member where email ='".$reg['email']."'";
					$d->query($sql);
					if($d->num_rows()!=0){
						$error['data']['email'] = "Email đã được sử dụng!";
						$error['stt'] = 1;
					}
				
				}
				if(!$error['stt']){
					if(strlen($reg['password']) < 8){
						$error['data']['password'] = "Mật khẩu ít nhất 8 ký tự!";
						$error['stt'] = 1;
					}
				}
				if(!$error['stt']){
					if($_POST['re-password'] != $reg['password']){
						$error['data']['re-password'] = "Mật khẩu nhập lại không chính xác!";
						$error['stt'] = 1;
					}
				}
			
				
				
			}else{
				$post = $_POST;
				
				if(1!=1){//if($_POST['captcha'] != $_SESSION['captcha']){
					$error['data']['captcha'] = "Mã bảo vệ không đúng!";
					$error['stt'] = 1;
				}else{
				
					if(!$error['stt']){
						
						if(strlen(trim($post['old-password'])) > 0){
							if(comparePassword(mInfo("secret"),$post['old-password'])!=mInfo("password")){
							$error['data']['old-password'] = "Mật khẩu cũ không đúng!";
							$error['stt'] = 1;
							}else{
								if(strlen($reg['password']) < 8){
									$error['data']['password'] = "Mật khẩu ít nhất 8 ký tự!";
									$error['stt'] = 1;
								}else{
									if($post['re-password'] != $reg['password']){
										$error['data']['re-password'] = "Mật khẩu nhập lại không chính xác!";
										$error['stt'] = 1;
									}
								}
							}
						}else{
							
						
						}
				}
			}
			
		}
		echo json_encode(array("error"=>$error,"post"=>$_POST	,"success"=>$success));
		die;
		
		
	
	
	}
	}
	
	function checkDonHang(){
	
		
		global $d,$rs_donhang,$rs_item,$has_id,$template;
		$has_id = false;
		if(!isset($_GET['id'])){
	
		$d->query("select * from #_donhang where thanhvien = ".$_SESSION['member_log']['id']);
		$rs_donhang = $d->result_array();
		
		}else{
			$id = $_GET['id'];
			$d->query("select * from #_donhang where thanhvien = ".$_SESSION['member_log']['id']." and id = ".$id);
			$rs_item = $d->fetch_array();
			$has_id = true;
			$template = "member/donhang_simple";
		
		}
		
		
		
		
	
	}
	function addTag(){
		if(isAjaxRequest()){
			global $d;
			$name = $_POST['name'];
			$d->query("select * from #_tag where name ='".$name."'");
			if($d->num_rows() == 0){
				$d->setTable("tag");
				$d->insert(array("name"=>$name));
			}
			$d->query("select * from #_tag");
			$rs = $d->result_array();
			$fix_rs = array();
			foreach($rs as $k=>$v){
			
				$fix_rs[] = $v['name'];
			
			}
			echo json_encode($fix_rs);
			die();
		}
	}
	
	function initLogin(){
		if(isAjaxRequest()){
		getMemberByEmail($_POST['email'],$_POST['name']);
		die();
		}
	}
	
	

	
	function getMemberByEmail($email,$name){
		global $d;
		$sarray = array();
		$sql = "select * from #_member where email = '".$email."'";
		$d->query($sql);
		if($d->num_rows() == 0){
			$secret = md5(time());
			$array = array("email"=>$email,"isActive"=>1,"full_name"=>$name,"secret"=>$secret);
			$d->setTable("member");
			$d->insert($array);
			$sarray['stt'] = 0;
			$sarray['msg'] = "�ang k� th�nh c�ng!";
			$sarray['pwd'] = false;
			loginSocial($email);
		}else{
			$rs = $d->fetch_array();
			if($rs['isActive'] == 0){
				$sarray['stt'] = 0;
				$sarray['msg'] = "T�i kho?n chua x�c th?c! Vui l�ng k�ch ho?t email d? dang tin!";
			}else{
				$sarray['stt'] = 1;
				$sarray['pwd'] = $rs['password'];
			
			
			$sarray['msg'] = "�ang nh?p th�nh c�ng!";
			$_SESSION['member_log'] = $rs;
			}
			
			
		
		}
		
		echo json_encode($sarray);
	
	}
	function getMember(){
		global $d,$member_log,$err,$success;
		$success = 0;
		$d->query("select * from #_member where id = ".$_SESSION['member_log']['id']);
		$member_log = $d->fetch_array();
		if(isset($_POST['required'])){
			$data = $_POST['reg'];
			if(isset($_FILES['avatar'])){
				$file_name = time().rand(0,999);
				if($photo = upload_image("avatar", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_member_l,$file_name))
				{
					$data['avatar'] = create_thumb($photo, 200,200, _upload_member_l,$file_name,3);	
					delete_file(_upload_member_l.$photo);
				}
			}
			if(isset($_FILES['com_logo'])){
				$file_name = time().rand(0,999);
				if($photo = upload_image("com_logo", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_member_l,$file_name))
				{
					$data['com_logo'] = create_thumb($photo, 200,200, _upload_member_l,$file_name,3);	
					delete_file(_upload_member_l.$photo);
				}
			}
			if(isset($_FILES['com_dkkd'])){
				$file_name = time().rand(0,999);
				if($photo = upload_image("com_dkkd", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_member_l,$file_name))
				{
					$data['com_dkkd'] = $photo;	
				}
			}
			if(!$_POST['old-password']){
				unset($data['password']);
			}else{
				$data['password'] = comparePassword($member_log['secret'],$data['password']);
			}
			$d->setTable("member");
			$d->setWhere("id",$_SESSION['member_log']['id']);
			if($d->update($data)){
				global $config_url;
				transfer("Chỉnh sửa thông tin thành công",$config_url."/thanh-vien/main.html");
			}
		}
	}
	function getMember2(){
		global $d,$member_log,$err,$success;
		
		$success = 0;
		
		
		$d->query("select * from #_member where id = ".$_SESSION['member_log']['id']);
		$member_log = $d->fetch_array();
		
		
		
		if(isset($_POST['required'])){
			
			$err = array();
			$error = false;
			
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$pwd = $_POST['old-password'];
			$newpwd = $_POST['new-password'];
			$uname = $_POST['username'];
			$pass = $_POST['password'];
			$
			$renewpwd = $_POST['renew-password'];
			
				if(!$error){
			
					if(strlen($name) < 5){
							$err['name'] = 'H? t�n �t nh?t 5 k� t?';
							$error = true;				
					}
				}
				
				if(!$error){
				$str="(([0-9]){1}){10,12}";  
				
				if(strlen($phone) < 9){ // N?u n� th?a c? 2 di?u ki?n so v?i 2 bi?n $str v� $str2
				   
					$err['phone']="�i?n tho?i kh�ng h?p l?"; 
					$error = true;
				}
				}
				
				
				
				
			if(!$error  & $uname){
				if( !ctype_alpha( $uname ) ){
					$err['username'] = 'T�n dang nh?p kh�ng h?p l?';
					$error = true;
				}else{
				
			
				$sql = "select * from #_member where username = '".$uname."' id=!".$member_log['id'];
				$d->query($sql);
				if($d->num_rows() != 0){
					$err['username'] = 'T�n dang nh?p d� t?n t?i';
					$error = true;
				}else{
					if (strpos($uname, ' ') !== false) {
						$err['username'] = 'T�n dang nh?p kh�ng du?c c� kho?ng tr?ng';
						$error = true;
					}
				
				}
				}
			}
			if(!$error & isset($_POST['password'])){
				if(strlen($pass) < 8){
					
					$err['password'] = 'M?t kh?u �t nh?t 8 k� t?';
					$error = true;
				}else{
					$data['password'] = comparePassword($member_log['secret'],$pass);
				
				}
			}
		
			if($pwd){
				
				if(!$error){
					$sql = "select * from #_member where password ='".comparePassword($member_log['secret'],$pwd)."' and id=".$member_log['id'];
					$d->query($sql);
					if($d->num_rows()==0){
						$error = true;
						$err['old-password'] = 'M?t kh?u kh�ng ch�nh x�c';
					}
				}
				if(!$error){
					if(strlen($newpwd )< 8){
						$err['new-password'] = 'M?t kh?u �t nh?t 8 k� t?';
						$error = true;
					}else{
						if($renewpwd != $newpwd){
							$err['renew-password'] = 'M?t kh?u nh?p l?i kh�ng d�ng';
							$error = true;
						}
					
					}
				}
				if(!$error){
				
					$data['password'] = comparePassword($member_log['secret'],$newpwd);
				}
				
			
			}
			if(!$error){
				$data['full_name'] = $name;
				if($uname){
					$data['username'] = $uname;
				}
				$data['phone'] = $phone;
				$d->setTable("member");
				$d->setWhere("id",$_SESSION['member_log']['id']);
				if($d->update($data)){
					$success = true;
				}
			}
		
		}
		
		}

	function mainMember(){
		
	
	}
	function checkLogin(){
		global $config_url;
		if(!isset($_SESSION['member_log'])){
			header("location:".$config_url."/san-giao-dich.html");
		}
	
	}
	function editPost(){
		global $d,$config_url,$item;
		
		
		$d->query("select * from #_post where id = ".$_GET['id']." and id_member = ".$_SESSION['member_log']['id']);
		
		$item = $d->fetch_array();
		
		if($d->num_rows() == 0){
			header("location:".$config_url);
		}
		
	
	
	}
	function displayPost($stt){
		global $d,$posts;
		
		$d->query("select * from #_post where tinhtrang = '".$stt."' and id_member =".$_SESSION['member_log']['id']);
		$posts = $d->result_array();
	
	}
	function checkCaptcha(){
		echo ($_POST['cap']==$_SESSION['captcha']) ? 1 : 0;
		die();
	}
	function getItem(){
		
		global $item,$d;
		if(isset($_SESSION['member_log'])){
			$d->query("select * from #_member where id =".$_SESSION['member_log']['id']);
			$item = $d->fetch_array();
		}
		header("location:".$_SERVER['HTTP_REFERER']);
	
	
	}
	function postTin(){
		
		global $error,$p,$a,$u,$xconfig,$success;
		$success = 0;
		if(isset($_POST['submit'])){
			
			
			$id = @$_POST['id'];
			global $d;
			$p = $_POST['p'];
			$a = $_POST['a'];
			$u = $_POST['u'];
			
			$configx = $_POST['config'];
			if(1==1){//$_POST['captcha']==$_SESSION['captcha']){
			
			
			$data = array();
			foreach($_POST['p'] as $k=>$v){
					$data[$k] = htmlspecialchars($v);
			
			}
			foreach($_POST['a'] as $k=>$v){
			$data[$k] = htmlspecialchars($v);
			}
			foreach($_POST['u'] as $k=>$v){
			$data[$k] = htmlspecialchars($v);
			}
			$data['config_post'] = mysql_real_escape_string(json_encode($_POST['config']));
			
			if(isset($_FILES)){
				 if($_FILES['file']['name']){
				
				$file_name = md5(time().rand(0,2131));
				$upload_dir = 'upload/usercontent/'.$_SESSION['member_log']['id'];
				if (!file_exists($upload_dir."/")) {
					@mkdir($upload_dir, 0777);
				} 
				$data['photo'] = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_l."/" ,$file_name);
				$data['thumb'] = create_thumb($data['photo'], 400, 400, _upload_l."/",$file_name,3);	
				}
			
			}
			$md5 = $_POST['md5'];
			if($id){
				$data['md5'] = $_POST['md5'];
				$data['ngaysua'] = time();
			}else{
				$data['ngaytao'] = time();
			}
			$data['id_member'] = $_SESSION['member_log']['id'];
			
			$d->setTable("post");
				if(!$id){
					$sql="select * from #_post";
					$d->query($sql);
					$stt = $d->num_rows();
					$data['stt'] = $stt+1;
					$data['md5'] = $md5;
					if($d->insert($data)){
						$success = 1;
						$sql = "select * from #_post where id_member = ".$_SESSION['member_log']['id']." and md5 = '".$md5."'";
						$d->query($sql);
						$fetch  = $d->fetch_array();
						$id = $fetch['id'];
					}
				}else{
					$d->setWhere("id",$id);
					if($d->update($data)){
						$success = 1;
					}
				
				}
				$d->query("delete from #_tag_post where post_id = ".$id);
				foreach($_POST['tags'] as $k=>$v){
					$d->setTable("tag_post");
					$d->insert(array("post_id"=>$id,"tag"=>$v,"tag_slug"=>changeTitle($v)));
					
				
				}
			}
			
		}else{
			$error[] = 'M� b?o v? kh�ng d�ng';
		
		}
	
	}
	function check_valid(){
		if(isAjaxRequest()){
		
			check($_POST);
			die();
		}
	
	}
	function initMember(){
		global $d,$loaigd,$loaibds,$tinhtp,$quanhuyen2,$huong,$rs_post_config;
		$d->query("select * from #_loaigiaodich where hienthi = 1 order by stt desc");
		foreach($d->result_array() as $k=>$v){
			$loaigd[$v['id']] = $v['ten_vi'];
		}
		$d->query("select * from #_loaibds where hienthi = 1 order by stt desc");
		foreach($d->result_array() as $k=>$v){
			$loaibds[$v['id']] = $v['ten_vi'];
		}
		$d->query("select * from #_province order by name desc");
		foreach($d->result_array() as $k=>$v){
			$tinhtp[$v['id']] = $v['name'];
			$d->query("select * from #_district where provinceid = ".$v['id']." order by name desc");
			$tmp = array();
			foreach($d->result_array() as $k2=>$v2){
				$tmp= array("id"=>$v2['id'],"name"=>$v2['name']);
				$quanhuyen2[$v['id']][] = $tmp;
			
			}	
		}
		
		$d->query("select * from #_huong where hienthi = 1 order by stt desc");
		foreach($d->result_array() as $k=>$v){
			$huong[$v['id']] = $v['ten_vi'];
			
		}
		$d->query("select * from #_post_config where hienthi = 1 order by stt desc ");
		$rs_post_config = $d->result_array();
		
		
	}
	function loginSocial($email){
		global $d;
		$d->query("select * from #_member where email = '".$email."'");
		$rs_login = $d->fetch_array();
		$_SESSION['member_log'] = $rs_login;
	
	}

	function login_member(){
		if(isAjaxRequest() & isset($_POST['action'])){
		global $d,$stt,$msg,$success;
		
		$error = array();
		$error['stt'] = false;
		$error['input'] = false;
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		if(1!=1){//if($_POST['captcha'] != $_SESSION['captcha']){
			$error['data']['captcha'] = "Mã bảo vệ không đúng!";
			$error['stt'] = 1;
			$error['input'] = true;
			
		}
		//if(checkEmailValid($email)){
			$d->query("select * from #_member where email = '".$email."'");
		//}else{
		//	$d->query("select * from #_member where username = '".$email."'");
		//}
		$rs_login = $d->fetch_array();
		if($d->num_rows() == 0){
			
			$error['stt'] = 1;
			$error['msg'] = "Tài khoản không tồn tại";
		}else{
			$secret = $rs_login['secret'];
			if(comparePassword($secret,$password)==$rs_login['password']){
				if(!$rs_login['isActive']){
					$error['stt'] = 1;
					$error['msg'] = "Tài khoản chưa kích hoạt";				
				}else{
				
					$success = "Đăng nhập thành công!";
					//$d->query("update #_member set lastlogin =".time()." where id = ".$rs_login['id']);
					$_SESSION['member_log'] = $rs_login;
					
				}
			}else{
				$error['stt'] = 1;
				$error['msg'] = "Mật khẩu không đúng";
			
			}
		
		}
		echo json_encode(array("error"=>$error,"success"=>$success));
		
		die();
		}
	
	}
	function memberRegister(){
		global $success;
		if(isset($_POST['required'])){
				$reg = $_POST['reg'];
				
				if(isset($_FILES['avatar'])){
					
					$file_name = time().rand(0,999);
					if($photo = upload_image("avatar", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_member_l,$file_name))
					{
						$reg['avatar'] = create_thumb($photo, 200,200, _upload_member_l,$file_name,3);	
						delete_file(_upload_member_l.$photo);
					}
				}
				
				if(isset($_FILES['com_logo'])){
					$file_name = time().rand(0,999);
					if($photo = upload_image("com_logo", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_member_l,$file_name))
					{
						$reg['com_logo'] = create_thumb($photo, 200,200, _upload_member_l,$file_name,3);	
						delete_file(_upload_member_l.$photo);
					}
				}
				if(isset($_FILES['com_dkkd'])){
					$file_name = time().rand(0,999);
					if($photo = upload_image("com_dkkd", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_member_l,$file_name))
					{
						$reg['com_dkkd'] = $photo;	
					}
				}
			
				$reg['birthday'] = $_POST['date']."-".$_POST['month']."-".$_POST['year'];
				$reg['secret'] = md5(time());
				
				$reg['password'] = comparePassword($reg['secret'] ,$reg['password']);
				$reg['ngaytao'] = time();
				$reg['isActive'] = 0;
				if(CreateMember($reg)){
					global $config_url,$d;
					$d->query("select * from #_hotline limit 1");
					$r = $d->fetch_array();
					$email_ = '<p><span style="font-size:12px; line-height:19.2px">Đây là email thông báo active tài khoản tại website Derhao.com.vn</span></p>

<p><span style="font-size:12px; line-height:19.2px">Quý khách vui lòng click vào <a href="'.$config_url.'?action=active&code='.$reg['secret'].'">đây</a> để xác nhận tài khoản.</span></p>

<p><span style="font-size:12px; line-height:19.2px">Xin cám ơn quý khách.</span></p>

<p><strong>'.$r['ten_vi'].'</strong></p>

<p>Địa chỉ: '.$r['diachi_vi'].'</p>

<p>Điện thoại: '.$r['dienthoai_vi'].';</p>

<p>Email: '.$r['email_vi'].'</p>';
					sendEmail($reg['email'],null, 'Derhao Việt Nam', "Email xác nhận tài khoản", $email_);
					transfer("Đăng ký tài khoản thành công.<div>Vui lòng vào hộp thư để active tài khoản.</div>",$config_url);
				}	
			}
		}
	function register_member2(){
		if(isset($_POST['required'])){
		
			check($_POST);die;
		
		}
		global $d,$err,$success;
		if(isAjaxRequest()){
			$reg = $_POST['reg'];
			$error = array();
			$error['stt'] = false;
			if(1!=1){//if($_POST['captcha'] != $_SESSION['captcha']){
				$error['data']['captcha'] = "Mã bảo vệ không đúng!";
				$error['stt'] = 1;
			}else{
				$sql = "select * from #_member where email ='".$reg['email']."'";
				$d->query($sql);
				if($d->num_rows()!=0){
					$error['data']['email'] = "Email đã được sử dụng!";
					$error['stt'] = 1;
				}
			
			}
			if(!$error['stt']){
				if(strlen($reg['password']) < 8){
					$error['data']['password'] = "Mật khẩu ít nhất 8 ký tự!";
					$error['stt'] = 1;
				}
			}
			if(!$error['stt']){
				if($_POST['re-password'] != $reg['password']){
					$error['data']['re-password'] = "Mật khẩu nhập lại không chính xác!";
					$error['stt'] = 1;
				}
			}
			
			if(!$error['stt']){
				$reg['birthday'] = $_POST['date']."-".$_POST['month']."-".$_POST['year'];
				$reg['secret'] = md5(time());
				$reg['password'] = comparePassword($reg['secret'] ,$reg['password']);
				$reg['ngaytao'] = time();
				$reg['isActive'] = 1;
				
				if(CreateMember($reg)){
					$success = "Tạo tài khoản thành công !";
				}	
			
			}
			echo json_encode(array("error"=>$error,"post"=>$reg,"success"=>$success));
			die;
		}	
	}
	
	
	
	
	
	
	function change_member2(){
		global $d,$err,$success;
		if(isAjaxRequest()){
			$reg = $_POST['reg'];
			$error = array();
			$error['stt'] = false;
			$member_log = $_SESSION['member_log'];
			if(1!=1){//if($_POST['captcha'] != $_SESSION['captcha']){
				$error['data']['captcha'] = "Mã bảo vệ không đúng!";
				$error['stt'] = 1;
			}
			$pwd = false;
			if(!$error['stt']){
				
				if(strlen($reg['old-password']) > 1 & comparePassword($member_log['secret'],$reg['old-password']) != $member_log['password']){
					$error['data']['old-password'] = "Mật khẩu không chính xác!";
					$error['stt'] = 1;
				}
				if(strlen($reg['old-password']) > 1 & comparePassword($member_log['secret'],$reg['old-password']) == $member_log['password']){
					if(strlen($reg['password']) < 8){
						$error['data']['password'] = "Mật khẩu ít nhất 8 ký tự!";
						$error['stt'] = 1;
					}
					if(!$error['stt']){
						if($_POST['re-password'] != $reg['password']){
							$error['data']['re-password'] = "Mật khẩu nhập lại không chính xác!";
							$error['stt'] = 1;
						}
					}
					if(!$error['stt']){
						$reg['password'] = comparePassword($member_log['secret'] ,$reg['password']);
					}
					$pwd = true;
				}
				
			}
			if(!$pwd){
				
				unset($reg['password']);
				
			
			}
			unset($reg['old-password']);
			
		
			if(!$error['stt']){
				$reg['birthday'] = $_POST['date']."-".$_POST['month']."-".$_POST['year'];
				$reg['ngaytao'] = time();
				
				$reg['isActive'] = 1;
				
				if(changeMemberInfo($reg)){
						$d->query("select * from #_member where id = ".$_SESSION['member_log']['id']);
						$_SESSION['member_log'] = $d->fetch_array();
						$success = "Thay đổi thông tin thành công !";
				}	
			
			}
			echo json_encode(array("error"=>$error,"post"=>$reg,"success"=>$success));
			die;
		}	
	}
	
	
	
	
	
	
	
	function changeMemberInfo($data){
		global $d;
		$d->setTable("member");
		
		$d->setWhere("id",$_SESSION['member_log']['id']);
		return $d->update($data);
	
	}
	
	
	
	
	function CreateMember($data){
		global $d;
		$d->setTable("member");
		return $d->insert($data);
	
	}
	
	
	function deleteFile(){
		if(isAjaxRequest()){
			global $d;
			$file = $_POST['file'];
			@unlink($file);
			$d->query("delete from #_photopost where photo = '".$file."'");
			exit();
		}
	
	}	
	function getExtension($str)
{
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}
	function checkUpload(){
		$upload_dir = 'upload/usercontent/'.$_SESSION['member_log']['id'];
		if (!file_exists($upload_dir."/")) {
			@mkdir($upload_dir, 0777);
		} 
	
		require(_lib.'Uploader.php');
		
		
		$valid_extensions = array('gif', 'png', 'jpeg', 'jpg');

		$Upload = new FileUpload('uploadfile');
		$Upload->newFileName = (md5(time().rand(0,999))).".".@end(explode(".",$_GET['uploadfile']));
		$result = $Upload->handleUpload($upload_dir, $valid_extensions);

		if (!$result) {
			echo json_encode(array('success' => false, 'msg' => $Upload->getErrorMsg()));   
		} else {
			global $d;
			$d->setTable("photopost");
			smart_resize_image($upload_dir."/".$Upload->getFileName(),600,600);
			$d->insert(array("md5"=>$_GET['md5'],'photo'=>$upload_dir."/".$Upload->getFileName()));
			//$d->query("select id from photopost where photo='".$upload_dir."/".$Upload->getFileName()."'
			echo json_encode(array('success' => true, 'file' => $upload_dir."/".$Upload->getFileName()));
		}
		die();
	}
        function checkIsLogin(){
            global $member,$config_url;
            if(count($member) > 0){
              
                    redirect($config_url);
                    
                
            }
            
            
        }
?>