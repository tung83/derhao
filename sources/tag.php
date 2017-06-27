<?php  if(!defined('_source')) die("Error");		
	
	$list = $model->getContentWithTag($_GET['slug']);
	$data = array();
	$title_cat = "Tag ".$list['name'];
	if(count($list['id']) > 0){
		$d->query("select * from #_content where id in (".implode(",",$list['id']).") order by stt desc");
		$data = $d->result_array();
	
	
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();
		$maxR=$global_setting['news_paging'];
		$maxP=5;
		$paging=paging_home($data, $url, $curPage, $maxR, $maxP);
		$data=$paging['source'];
	}
	
	
	
	
	
	