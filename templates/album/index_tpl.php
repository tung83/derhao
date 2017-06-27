<div id="content">
<div id="content">
<div class="scroll">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2></div>
<div class="wrap-box-news">
 	<?php foreach($tintuc as $k=>$v){ ?>
        <div class="col-xs-6 col-md-4 col-sm-4 news-item">
			<div class="fix-row">
				<div class="col-xs-12">
					<div class="fix-row">
						<div class="wrap-album">
					
						<?php
						
							$photo = ($v['photo']) ? $v['photo'] : 'images/noimage.gif';
							if(!checkValidUrl($photo)){
								$photo = _upload_tintuc_l.$photo;
							}
						
						?>
						
						<a href="<?=$com?>/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>"><img class="img-thumbnail" src="<?=$photo?>" /></a>
						<div class="link-retail">
							<div class="rel">
								<a class="" href="album/<?=$v['id']?>/<?=$v['tenkhongdau']?>.html" title="<?=$v['ten_'.$lang]?>"><?=$v['ten_'.$lang]?></a>
							</div>
						</div>
						</div>
					</div>
				</div>
				
				
			</div><!-- end row -->
        </div><!---END .box_new-->
       <?php if(($i+1)%2==0) echo '<div class="clearfix"></div>' ?>
    <?php } ?>
 <div class="clear"></div>    
</div><!---END .wrap-box-news-->
 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>
</div>
</div>
</div>
<style>
	.wrap-album{position:relative}
	.wrap-album img{border-radius:0}
	.wrap-album .link-retail .rel{width:100%;height:100%;cursor: hand;
cursor: pointer;}
	.wrap-album .link-retail{position:absolute;bottom:0;background:rgba(0,0,0,.7);width:100%;height:100%;top:0;left:0;display:none}
	
	.wrap-album .link-retail a{position: absolute;
	color:#fff;
	font-size:20px;
	font-family:uvn_bai_sau_nheregular;
width: 100%;
/* text-align: center; */
top: 0;
left: 0;
right: 0;
bottom: 0;
margin: auto;
text-align: center;
display: table;}
	

</style>
<script>
$().ready(function(){
	$(".wrap-album").hover(function(){
		$(this).find(".link-retail").fadeIn();
	
	},function(){
	$(this).find(".link-retail").fadeOut();
	})
	$(".wrap-album .rel").click(function(){
		$(this).find("a").click();
	})
})
</script>

