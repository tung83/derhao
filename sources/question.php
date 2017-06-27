<?php  if(!defined('_source')) die("Error");
	$title_bar= 'Đăt câu hỏi - ';		
	$title_cat= 'Đăt câu hỏi';
	if(isAjaxRequest()){
		
		$xdata = $_POST['post'];
		foreach($xdata as $k=>$v){
			$xdata[$k] = magic_quote($v);
		}
		$xdata['create_time'] = time();
		$d->setTable("question");
		$d->insert($xdata);
	
		die;
	}
	
	
	$sql_tintuc = "select * from #_question where hienthi=1   order by id desc";
	$d->query($sql_tintuc);
	$tintuc = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=20;
	$maxP=5;
	$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
	$tintuc=$paging['source'];
	
	
?>