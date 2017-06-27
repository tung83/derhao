<?php  if(!defined('_source')) die("Error");

	$title_bar= _partner.' - ';		
	$title_cat= _partner.'';	
	$sql_tintuc = "select * from #_doitac where hienthi=1 order by stt desc";
	$d->query($sql_tintuc);
	$tintuc = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=20;
	$maxP=5;
	$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
	$tintuc=$paging['source'];
	

?>