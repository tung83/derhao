<?php  if(!defined('_source')) die("Error");
if(@isset($_GET['id']) | @$id){
	#tin tuc chi tiet
	$id =  addslashes($_GET['id']);
	$sql = "select * from #_baiviet where id='".$id."'";
	$d->query($sql);
	$tintuc_detail = $d->fetch_array();
	$title_bar=$tintuc_detail['ten_'.$lang].' - ';
	$title_cat=$tintuc_detail['ten_'.$lang];
	addingSeo($tintuc_detail);	
	if($_GET['com']=="about"){
		$slider_type = "about";
		$slider_title = _about_derhao_textile;
	}
	
}
?>