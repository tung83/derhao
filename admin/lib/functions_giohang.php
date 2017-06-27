<?php 
function getProductInfo($pid){
		global $d, $row,$lang;
		$sql = "select * from #_product where id=$pid";
		$d->query($sql);
		return $d->fetch_array();
		
}
function getProductThumbnailWidthColor($id_product,$id_color){
	global $d;
	$d->query("select image from #_product_color_condition where id_color = ".$id_color." and id_product=".$id_product);
	
	$r = $d->fetch_array();
	
	if(count(json_decode($r['image'])) > 0){
		$image = objectToArray(json_decode($r['image']));
		return $image[0];
	}
	
}
	function get_product_name($pid){
		global $d, $row,$lang;
		$sql = "select ten_$lang from #_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['ten_'.$lang];
	}
	
	function get_price($pid){
		global $d, $row;
		$sql = "select gia from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['gia'];
	}
	function remove_product($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	function get_order_total(){
		
		$sum=0;
		foreach($_SESSION['cart'] as $k=>$v){
			$pid=$v['productid'];
			$q=$v['qty'];
			$price=get_price($pid);
			$sum+=$price*$q;
			
		}
		return $sum;

	}
	
	function get_total(){
		$num = 0;
		if(isset($_SESSION['cart'])){
			
			foreach($_SESSION['cart'] as $k=>$v){
				$num+=$v['qty'];
			}
		}
		return $num;
	}
	
	
	function addtocart($pid,$q,$color,$size){
	
		if($pid<1 or $q<1) return;
		$code = md5($pid.$color.$size);
		if(is_array(@$_SESSION['cart'])){
			if(isset($_SESSION['cart'][$code])){
				$_SESSION['cart'][$code]['qty'] = $_SESSION['cart'][$code]['qty']+$q;
			}else{
				
				$_SESSION['cart'][$code]['productid']=$pid;
				$_SESSION['cart'][$code]['qty']=$q;
				$_SESSION['cart'][$code]['color']=$color;
				$_SESSION['cart'][$code]['size']=$size;
			}
		}
		else{
			$_SESSION['cart'] = array();
			$_SESSION['cart'][$code]['productid']=$pid;
			$_SESSION['cart'][$code]['qty']=$q;
			$_SESSION['cart'][$code]['color']=$color;
			$_SESSION['cart'][$code]['size']=$size;
		}
	}
	function product_exists($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				$qty = $_SESSION['cart'][$i]['qty'];
				$_SESSION['cart'][$i]['qty'] = $qty+1;
				$flag=1;
				break;
			}
		}
		return $flag;
	}

?>