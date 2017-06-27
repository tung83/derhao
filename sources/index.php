<?php  if(!defined('_source')) die("Error");
		$d->reset();
		$d->query("select * from #_product where hienthi = 1 and noibat = 1 order by stt desc");
		$product = $d->result_array();
					

?>