<?php
	$d->reset();
	$sql_slider = "select ten,photo,link from #_slider order by stt,id desc";
	$d->query($sql_slider);
	$result_slider=$d->result_array();
	
?>  
<?php
$arr =array("cube","cubeSpread","paralell","cubeStop","horizontal","directionRight","tube","directionBottom","showBarsRandom","cubeRandom","cubeStopRandom","showBarsRandom","cubeHide","fade","fadeFour","block","blind","blindHeight","blindWidth","cubeSize","showBars","directionRight","directionLeft");
?>
<!-- 
<div class="box_skitter box_skitter_large">
        <ul>
        <?php  for($i=0,$count_result_slider=count($result_slider);$i<$count_result_slider;$i++){ ?>
            <li><a href="<?=$result_slider[$i]['link']?>"><img src="<?= _upload_hinhanh_l.$result_slider[$i]['photo'] ?>" class="<?php echo $arr[$i]; ?>" /></a></li>	
            <?php } ?>			
        </ul>
</div>
-->
<img src="images/slide.jpg" />