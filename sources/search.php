<?php  if(!defined('_source')) die("Error");
		$class_bg = "";
		if(isset($_GET['keyword'])){
		
			$tukhoa =  $_GET['keyword'];
			
			$tukhoa = trim(strip_tags($tukhoa));    	
    		if (get_magic_quotes_gpc()==false) {
    			$tukhoa = mysql_real_escape_string($tukhoa);    			
    		}	
			/* 
			$d->query("select * from #_service where hienthi = 1 and ten_$lang like '%".$tukhoa."%' order by stt desc");
			$rs_sv = $d->result_array();
			$d->query("select * from #_news where loaitin='news' and  hienthi = 1 and ten_$lang like '%".$tukhoa."%' order by stt desc");
			$rs_news = $d->result_array();
			*/
			
			$sql= "select * from #_product where (ten_".$lang." LIKE '%$tukhoa%') or (noidung_".$lang." LIKE '%$tukhoa%') or (mota_".$lang." LIKE '%$tukhoa%')  and hienthi=1 ".$cat." order by stt desc";		
			
					
			if(isAjaxRequest() & @$_GET['current_page']){
				
				$cur = $_GET['current_page'];
				$tukhoa = $_GET['keyword'];
				$per = $_GET['perpage'];
				$sql= "select * from #_product where (ten_".$lang." LIKE '%$tukhoa%') or (noidung_".$lang." LIKE '%$tukhoa%') or (mota_".$lang." LIKE '%$tukhoa%')  and hienthi=1 ".$cat." order by stt desc  limit $per,".(($cur)*$per);		
				
				
				$d->query($sql);
				
				
				
				
				echo json_encode(array("data"=>$d->result_array(),"page"=>$cur+1));
				die;
				
				
				
				
			}
			
			
			
			$d->query($sql);
			$product = $d->result_array();	
			
			$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
			$url=getCurrentPageURL();
			$maxR=$global_setting['product_paging'];
			$maxP=5;
			$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
			$product=$paging['source'];
			
			$template = "search/product";
			
		}	
		
?>