<?php

	
	$d->reset();
	$sql="select id,mota,photo from #_doitac where hienthi=1 order by stt,id desc";
	$d->query($sql);
	$doitac=$d->result_array();

?>

<ul id="mycarousel" class="jcarousel-skin-tango" style="overflow:hidden;">
	<?php for($j=0;$j<2;$j++){ ?>
    <?php for($i=0,$count_doitac=count($doitac);$i<$count_doitac;$i++){ ?>
       <li>
        <div class="pic"><a href="<?=$doitac[$i]['mota']?>" title="<?=$doitac[$i]['mota']?>" target="_blank"><img src="<?=_upload_hinhanh_l.$doitac[$i]['photo']?>"  style="height:100px; width:105px;" /></a></div>
      </li> 
     <?php }} ?>
 </ul>