<?php	

	$d->reset();
	$sql_contact = "select * from #_footer ";
	$d->query($sql_contact);
	$company_contact = $d->fetch_array();
	$d->reset();
	$social = "select * from #_config where type='social' ";
	$d->query($social);
	$social = $d->result_array();	
	$d->reset();
	$title = "select * from #_title  ";
	$d->query($title);
	$title = $d->fetch_array();	

?>
<div id="wap_footer">    
		<div id="footer">
		<div id="main_footer">
			<div class="copy">
			<?=$company_contact['noidung_'.$lang]?>
			</div>
			<div class="statistic">
			<?php
				$ol = (count_online());
			?>
				<div>Online: <?=$ol['dangxem']?> </div><div>Total: <?=$ol['daxem']?></div>
			</div>
			<div class="social">
			
			
				<div>
				
				<?php
					foreach($social as $k=>$v){
						if($v['content']){
							echo '<a class="'.$v['key'].'" title="'.$title['ten'].' on '.$v['key'].'" href="'.$v['content'].'"></a>';
						}
						
					}
					
				
				?>
				
				</div>
			</div>
			<div class="clear"></div>
			
		  </div><!---END #menu_bottom-->
		</div><!---END #footer-->
		<div class="clear"></div>
	</div><!---END #wap_footer-->
<?php $company_contact['noidung_'.$lang];?>
