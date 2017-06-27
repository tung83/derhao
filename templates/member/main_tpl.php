<?php
$d->query("select  * from #_baiviet where id = 1");
$r = $d->fetch_array();

echo $r['noidung_'.$lang];
	

?>
