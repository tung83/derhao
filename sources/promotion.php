<?php  if(!defined('_source')) die("Error");
if(isset($_GET['id'])){
	#tin tuc chi tiet
	$id =  addslashes($_GET['id']);
	$sql = "select * from #_promotion where hienthi=1  and id='".$id."'";
	$d->query($sql);
	$tintuc_detail = $d->fetch_array();
	$title_bar=$tintuc_detail['ten_'.$lang].' - ';
	$title_cat=$tintuc_detail['ten_'.$lang];
	addingSeo($tintuc_detail);
	#các tin cu hon
	$sql_khac = "select * from #_promotion where hienthi=1   and id <'".$id."' order by stt desc limit 0,8";
	$d->query($sql_khac);
	$more = "Chương trình khuyến mãi khác";
	
	$tintuc_khac = $d->result_array();
	
}else{
	$title_bar= _promotion.' - ';		
	$title_cat= _promotion;	
	$sql_tintuc = "select * from #_promotion where hienthi=1   order by stt desc";
	$d->query($sql_tintuc);
	$tintuc = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=5;
	$maxP=5;
	$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
	$tintuc=$paging['source'];
}
?>