<?php
		
	$d->reset();
	$sql_hotro="select ten,yahoo,dienthoai from #_yahoo where hienthi=1 order by stt,id desc";
	$d->query($sql_hotro);
	$result_hotro=$d->result_array();
	
	$d->reset();
	$sql_tinmoi="select id,ten,tenkhongdau,mota,thumb,photo from #_news where hienthi=1 and noibat=1 order by stt,id desc";
	$d->query($sql_tinmoi);
	$tinmoi=$d->result_array();
	
	

?>
<h3 class="tieude">Hỗ trợ trực tuyến</h3>
    <div id="hotro">
        <ul>
        	 <?php for($i=0,$count_result_hotro=count($result_hotro);$i<$count_result_hotro;$i++){	?>
            	<li><?=$result_hotro[$i]['ten']?><a href="ymsgr:sendIM?<?=$result_hotro[$i]['yahoo']?>"><img src="http://opi.yahoo.com/online?u=<?=$result_hotro[$i]['yahoo']?>&amp;m=g&amp;t=2" width="99px" height="20px"><br /><?=$result_hotro[$i]['dienthoai']?></a></li>
            <?php } ?>
        </ul>
    </div><!---END #hotro-->
    <div class="trong"></div>
    
    <h3 class="tieude">Tiện ích website</h3>
    <div id="tienich">
        <ul>
        <?php include _template."layout/tienich.php";?>

        </ul>
    </div><!---END #tienich-->
    <div class="trong"></div>
    
    <h3 class="tieude">Quảng cáo</h3>
    <div id="quangcao">
         <div id="ctsdiv" style="text-align:center; position:relative; height:350px; overflow:hidden">
                    <table width="200px" border="0" cellspacing="0" cellpadding="0" id="ctstbl" style="position:relative; margin:0px">  
                     <?php for($i=0,$count_result_quangcao=count($result_quangcao);$i<$count_result_quangcao;$i++){	?>
                            <tr>
                                 <td valign="top">
                                       <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                               <tr>
                                                  <td valign="top">     	  
                                      <a target="_blank" href="<?=$result_quangcao[$i]['mota']?>"><img src="<?php if($result_quangcao[$i]['photo']!=NULL) echo _upload_hinhanh_l.$result_quangcao[$i]['photo']; else echo 'images/noimage.gif';?>" /></a>	        
                      </td>
                                               </tr>
                                        </table>
                                    </td>      
                           </tr>  
                        <?php } ?>    
                    </table>
                 </div>
                 <script type="text/javascript">createScroller("myScroller", "ctsdiv", "ctstbl",0,70,2,0,1);</script>  
    </div><!---END #quangcao-->
    <div class="trong"></div>