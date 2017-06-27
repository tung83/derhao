<?php  if(!defined('_source')) die("Error");
	$d->reset();
	$sql_contact = "select * from #_lienhe ";
	$d->query($sql_contact);
	$company_contact = $d->fetch_array();	
	$title_bar = _contact." - ";
	$title_tcat = _contact;

	
	
		
		if(!empty($_POST) & isset($_POST['captcha']))
		{
			
			if($_POST['captcha']!=$_SESSION['captcha']){
				$error ="Mã bảo vệ không đúng";
			}else{
			
			$d->query("select ten_$lang from #_hotline");
			$htl = $d->fetch_array();	
			
				 
			$body = $global_setting['email_contact_form'];
			$arr = array("website"=>$config_url,"name"=>$_POST['name'],"address"=>$_POST['address'],"phone"=>$_POST['phone'],"email"=>$_POST['email'],"date"=>date("h:i:s d-m-Y",time()),"title"=>$_POST['title'],"content"=>$_POST['content']);
			foreach($arr as $k=>$v){
				$body = str_replace("%".$k."%",magic_quote($v),$body);
			}
			if(sendEmail($global_setting['email_contact'],null,$htl['ten_'.$lang], "Thư liên hệ từ ".$htl['ten_'.$lang], $body)){ 
				$data = array("name"=>$_POST['name'],"email"=>$_POST['email'],"create_date"=>time(),"content"=>$body);
				$d->setTable("contact_info");
				$d->insert($data);
				transfer("Thông tin liên hệ được gửi.<br>Cảm ơn.", "index.html");
				
			}else{
				transfer("Thông tin KHÔNG gửi được.<br>Cảm ơn.", "lien-he.html");
			}
		}}
		
		$d->reset();
		$sql_hotline="select * from #_hotline limit 0,1";
		$d->query($sql_hotline);
		$result_hotline=$d->fetch_array();