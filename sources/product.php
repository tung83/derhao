<?php  if(!defined('_source')) die("Error");
$class_bg = "";
@$id_danhmuc =  addslashes($_GET['id_danhmuc']);
@$id_list =  addslashes($_GET['id_list']);
@$id_cat =  addslashes($_GET['id_cat']);
@$id =  addslashes($_GET['id']);




	if(isAjaxRequest() & @$_GET['current_page']){
		$cur = $_GET['current_page'];
		$type = $_GET['type'];
		$did = $_GET['category'];
		$per = $_GET['perpage'];
		$limit = " limit $per,".(($cur)*$per);
		if($did){
			$did = " and id_danhmuc = $did";
		}
		
		
		$sql = "select ten_$lang as ten,new,sale,id,tenkhongdau,photo from #_product where type='$type' $did order by stt desc $limit";
		$d->query($sql);
		echo json_encode(array("data"=>$d->result_array(),"page"=>$cur+1));
		die;
		
		
		
		
	}

if($id!='')
{
    #c�c s?n ph?m kh�c======================
    $sql_lanxem = "UPDATE #_product SET luotxem=luotxem+1  WHERE id ='".$id."'";
    $d->query($sql_lanxem);
    $sql_detail = "select * from #_product where hienthi=1 and id='".$id."'";
    $d->query($sql_detail);
    $row_detail = $d->fetch_array();
    $product_detail = $row_detail;
	if($product_detail['id_brand']){
		$d->query("select * from #_product_brand where id = ".$product_detail['id_brand']." and hienthi = 1");
		if($d->num_rows()){
			$brand = $d->fetch_array();
			$d->reset();
			$d->query("select id,tenkhongdau from #_product_danhmuc where id = ".$product_detail['id_danhmuc']);
			$danhmuc = $d->fetch_array();
		}
	}
    $title_bar=$row_detail['ten_'.$lang].' - ';
	
	addingSeo($row_detail);
    $sql = "select * from #_product where hienthi=1 and id_list='".$row_detail['id_list']."' and id!='".$row_detail['id']."' and id_danhmuc='".$row_detail['id_danhmuc']."' and type='$com' order by stt desc";
    $d->query($sql);
    $product = $d->result_array();
	
	if(isAjaxRequest() | $_GET['iframe']==1){
		include _template."product/quick_detail_tpl.php";
		die;
	}
	if(isset($_GET['type'])){
		if($_GET['type']=="detail"){
			$template = "product/detail_inner";
		}
	}

}
elseif($id_cat!='')
{

    $sql = "select ten_$lang,id from #_product_cat where id='$id_cat' ";
    $d->query($sql);
    $titlex = $d->fetch_array();
    $title_bar = $titlex['ten_'.$lang].' - ';
    $title_cat = $titlex['ten_'.$lang];
	addingSeo($titlex);
    $sql = "select * from #_product where hienthi=1 and id_cat='$id_cat' order by stt desc";
    $d->query($sql);
    $product = $d->result_array();
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
    $product = $paging['source'];
}

elseif($id_danhmuc!='')
{
    $sql = "select * from #_product_danhmuc where id='$id_danhmuc'";
	if(isset($_GET['brand'])){
		$brand = magic_quote($_GET['brand']);
		$d->query("select * from #_product_brand where tenkhongdau ='".$brand."'");
		if($d->num_rows()){
			$brand = $d->fetch_array();			
		}
	}
    $d->query($sql);
    $titlex = $d->fetch_array();
    $title_bar = $titlex['ten_'.$lang].' - ';
    $title_cat = $titlex['ten_'.$lang];
	addingSeo($titlex);
	$sql = "select * from #_product where hienthi=1 and id_danhmuc='$id_danhmuc' order by stt desc";
	if(isset($brand)){
		$title_bar = $titlex['ten_'.$lang].' - '.$brand['ten_'.$lang];
		$title_cat = $titlex['ten_'.$lang]." - ".$brand['ten_'.$lang];
		$sql = "select * from #_product where hienthi=1 and id_danhmuc='$id_danhmuc' and id_brand = '".$brand['id']."' order by stt desc";
		
	}
    $d->query($sql);
    $product = $d->result_array();

    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
	
	$sql.= " limit ".($maxR*$curPage);
	$d->query($sql);
	$product = $d->result_array();
	
	
}
elseif($id_list!='')
{

    $sql = "select * from #_product_list where id='$id_list'";
    $d->query($sql);
    $titlex = $d->fetch_array();
    $title_bar = $titlex['ten_'.$lang].' - ';
    $title_cat = $titlex['ten_'.$lang];
	addingSeo($titlex);
    $sql = "select * from #_product where hienthi=1 and id_list='$id_list' order by stt desc";
    $d->query($sql);
    $product = $d->result_array();

    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
   $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
	
    $product = $paging['source'];
	



}
else
{

    $title_bar= _product.' - ';
    $title_cat= _product.'';


    $d->reset();
	  $sql = "select * from #_product where hienthi=1 ";
	if(isset($type)){
		$sql.= " and $type = 1 ";
		$title_bar= $pfix.' - ';
		$title_cat= $pfix;
	}
	if(isset($stype)){
		$sql.= " and type = '$stype'";
		$title_bar= $pfix.' - ';
		$title_cat= $pfix;
	}
	if(isset($promotion)){
		$sql.= " and ((gia > 0) and (giacu > 0) ) ";
		$title_bar= $pfix.' - ';
		$title_cat= $pfix;
	}
	$sql.= ' order by stt desc';
    $d->query($sql);
  
	
    $product = $d->result_array();
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
	$sql.= " limit ".($maxR*$curPage);
	$d->query($sql);
	$product = $d->result_array();
	
	
	
	
 
	

}
	$slider_cls = "type_2";
	$slider_title = _new_collection;
	
	$array=array("vai"=>"fabric","thanh-pham"=>"product","khuyen-mai"=>"promotion");
	$slider_type = ($array[$com]) ? $array[$com] : $com;
	$com = ($array[$com]) ? $array[$com] : $com;
	if($slider_type=="product"){
		$slider_title = _fabric_and_product;
		
	}
	$_list_product_danhmuc = array();
	$d->query("select ten_$lang,tenkhongdau,id,type from #_product_danhmuc where hienthi = 1 and type='$com' order by stt desc");
	
	$_list_product_danhmuc = $d->result_array();
	
	
	


?>