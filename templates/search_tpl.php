

<script language="javascript">
	function addtocart(pid){
		document.form1.productid.value=pid;
		document.form1.command.value='add';
		document.form1.submit();
	}
</script>

<form name="form1" action="index.php">
	<input type="hidden" name="productid" />
    <input type="hidden" name="command" />
</form>

<div class="tieude_giua">Kết quả tìm kiếm</div>
<div class="wap_item">
	<?php for($i=0,$count_product=count($product);$i<$count_product;$i++){	?>
    <div class="item">
         <a href="san-pham/<?=$product[$i]['id']?>/<?=$product[$i]['tenkhongdau']?>.html">
            <img src="<?php if($product[$i]['thumb']!=NULL) echo _upload_sanpham_l.$product[$i]['thumb']; else echo 'images/noimage.gif';?>" onmouseover="doTooltip(event, '<?=_upload_sanpham_l.$product[$i]['photo']?>')" onmouseout="hideTip()"/>
            <h3><?=$product[$i]['ten']?></h3>
        </a>
        <h4>Giá: <span><?php if($product[$i]['gia']!='')echo number_format($product[$i]['gia'],0, ',', '.').' VNĐ';else echo 'Liên hệ' ?></span></h4>
        <a><img src="images/dathang.png" onclick="addtocart(<?=$product[$i]['id']?>)" style="cursor:pointer;" class="dathang"/></a>
    </div><!---END .item-->
    <?php } ?>
    <?php if(($i+1)%3==0) echo '<div class="clear"></div>';?>
    <div class="clear"></div>
    <div class="phantrang" ><?=$paging['paging']?></div>
   
</div><!---END .wap_item-->