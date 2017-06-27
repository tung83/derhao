<?php  if(!defined('_source')) die("Error");

if(isset($_POST['send-email'])){
	$data_['email'] = $_POST['email'];
	
	$data_['ngaytao'] = time();
	$data_['hienthi'] = 1;
	$sql="select * from  #_newsletter where email = '".$_POST['email']."'";
	$d->query($sql);
	if($d->num_rows() == 0){
	$d->reset();
	$d->setTable("newsletter");
	
	if($d->insert($data_)){
		transfer(_subscribe_success_, $_SERVER['HTTP_REFERER']);
	}else{
			transfer(_subscribe_fail_, $_SERVER['HTTP_REFERER']);
	}
	}else{
		transfer(_subscribe_fail_exist_, $_SERVER['HTTP_REFERER']);
	}
	
}
?>