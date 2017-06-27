<?php  if(!defined('_source')) die("Error");

@$id_danhmuc =  addslashes($_GET['id_danhmuc']);
@$id_list =  addslashes($_GET['id_list']);
@$id =  addslashes($_GET['id']);

if(isset($_GET['id'])){
	#tin tuc chi tiet
	$id =  addslashes($_GET['id']);
	$sql = "select * from #_album where hienthi=1 and id='".$id."'";
	$d->query($sql);
	$tintuc_detail = $d->fetch_array();
	$title_bar=$tintuc_detail['ten_'.$lang].' - ';
	$title_cat=$tintuc_detail['ten_'.$lang];

	#các tin cu hon
	$sql_khac = "select * from #_album where hienthi=1 and id <'".$id."' order by stt desc limit 0,8";
	$d->query($sql_khac);
	$more = 'Các thông tin khác';
	addingSeo($tintuc_detail);
	$tintuc_khac = $d->result_array();
	
}
elseif($id_danhmuc!='')
{

	
    $sql = "select * from #_album_danhmuc where id='$id_danhmuc'";
    $d->query($sql);
    $title = $d->fetch_array();
    $title_bar = $title['ten_'.$lang].' - ';
	addingSeo($title);
    $sql = "select * from #_album where hienthi=1 and id_danhmuc='$id_danhmuc'  order by stt desc";
    $d->query($sql);
    $tintuc =  $d->result_array();
    $title_cat = $title['ten_'.$lang];

    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=12;
    $maxP=5;
    $paging = paging_home($tintuc, $url, $curPage, $maxR, $maxP);
	
    $tintuc =  $paging['source'];




}
elseif($id_list!='')
{

    $sql = "select * from #_album_list where id='$id_list'";
    $d->query($sql);
    $title = $d->fetch_array();
    $title_bar = $title['ten_'.$lang].' - ';
    $title_cat = $title['ten_'.$lang];
	addingSeo($title);
    $sql = "select * from #_album where hienthi=1 and id_list='$id_list'  order by stt desc";
    $d->query($sql);
    $tintuc =  $d->result_array();

    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=12;
    $maxP=5;
    $paging = paging_home($tintuc, $url, $curPage, $maxR, $maxP);
	
    $tintuc =  $paging['source'];
	



}
else
{
    $title_bar= _album.' - ';
    $title_cat= _album.'';
    $d->reset();
	$sql = "select * from #_album where hienthi=1  order by stt desc";
    $d->query($sql);
    $tintuc =  $d->result_array();
	
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=12;
    $maxP=5;
    $paging = paging_home($tintuc, $url, $curPage, $maxR, $maxP);
    $tintuc =  $paging['source'];
}
?>