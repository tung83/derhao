<?php  if(!defined('_source')) die("Error");

if(isset($_GET['id'])){
	#tin tuc chi tiet
	$id =  addslashes($_GET['id']);
	$sql = "select * from #_content where hienthi=1  and id='".$id."'";
	$d->query($sql);
	$tintuc_detail = $d->fetch_array();
	$title_bar=$tintuc_detail['ten_'.$lang].' - ';
	$title_cat=$tintuc_detail['ten_'.$lang];
	addingSeo($tintuc_detail);
	#các tin cu hon
	$sql_khac = "select * from #_content where hienthi=1   and id <'".$id."' and type='".$type."' order by stt desc limit 0,8";
	$d->query($sql_khac);
	$more = _more_info;
	
	$tintuc_khac = $d->result_array();
	
}else{
	$title_bar= $suffix.' - ';		
	$title_cat= $suffix.'';	
	if($type=="album" & !isset($_GET['id_danhmuc'])){
		$d->query("select id,ten_$lang,tenkhongdau,photo from #_content_danhmuc where type='album' and hienthi = 1 order by stt desc");
		$tintuc = $d->result_array();
		$template = 'content/album';
		
	}else{
	$sql_tintuc = "select * from #_content where hienthi=1  and type='".$type."' order by stt desc";
	if(isset($_GET['id_danhmuc'])){
		$id_danhmuc = magic_quote($_GET['id_danhmuc']);
		$d->query("select ten_$lang from #_content_danhmuc where id = ".$id_danhmuc);
		$r = $d->fetch_array();
		$sql_tintuc = "select * from #_content where hienthi=1  and type='".$type."' and id_danhmuc = '".$id_danhmuc."' order by stt desc";
		$title_bar= $r['ten_'.$lang].' - ';		
		$title_cat= $r['ten_'.$lang];	
		
	}
	if(isset($_GET['id_list'])){
		$id_list = magic_quote($_GET['id_list']);
		$d->query("select ten_$lang from #_content_list where id = ".$id_list);
		$r = $d->fetch_array();
		$sql_tintuc = "select * from #_content where hienthi=1  and type='".$type."' and id_list = '".$id_list."' order by stt desc";
		$title_bar= $r['ten_'.$lang].' - ';		
		$title_cat= $r['ten_'.$lang];	
		
	}
	$d->query($sql_tintuc);
	$tintuc = $d->result_array();
	if(count($tintuc) == 1 & @$onepage){
		$row = $tintuc[0];
		redirect($config_url."/".$com."/".$row['id']."/".$row['tenkhongdau']."html");
	}
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=$global_setting['news_paging'];
	$maxP=5;
	$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
	$tintuc=$paging['source'];
	}
}
?>