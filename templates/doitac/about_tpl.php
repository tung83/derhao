<section id="list-article" class="news">
<div class="scroll">
	<ul>
	<?php	
	    $id  = @$_GET['id'];

		foreach($tintuc as $k=>$v){
            $cls = "";
            if(!$id & $k == 0){
                $cls = "class='active'";
            }

            if($id == $v['id']){

                $cls = "class='active'";
            }
			echo '<li '.$cls.'><div class="article-item">';
				echo '<div class="image anim">';
					echo '<a href="gioi-thieu/'.$v['id'].'/'.$v['tenkhongdau'].'.html" class="anim about-item" title="'.$v['ten_'.$lang].'"><img src="'._upload_tintuc_l.$v['thumb'].'" alt="'.$v['ten_'.$lang].'" /></a>';
				echo '</div>';
				echo '<div class="name">';
					echo '<a href="gioi-thieu/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a>';
				echo '</div>';
			echo '</div></li>';
			
		}
	?>
        <?php
            $d->reset();
            $d->query("select * from #_resource where id = 1");
            $rs = $d->fetch_array();

        ?>
       
	</ul>
	<div class="clearfix"></div>

<div id="content" class="content-wrapper">
    <div id="content" class="content-wrapper-incontent">


<div class="scrollbar" id="ex3">

<div class="news-content">
<div class="title-global"><h2><?=$tintuc_detail[0]['ten_'.$lang]?></h2>
<div class="date"><?=date("d-m-Y",$tintuc_detail[0]['ngaytao'])?></div></div>
<?php


?>

<div class="box_containerlienhe">
<div class="description"><?=$tintuc_detail[0]['mota_'.$lang]?></div>   
<div class="content">             
      <?=$tintuc_detail[0]['noidung_'.$lang]?><br />           
	  <?php
	  if(count($tintuc_khac) > 0) { ?>
        <div class="othernews">
             <h1><?=$more?></h1>
             <ul>          
                <?php foreach($tintuc_khac as $tinkhac){?>
                <li>&raquo;&nbsp;<a href="<?=$com?>/<?=$tinkhac['id']?>/<?=$tinkhac['tenkhongdau']?>.html" style="text-decoration:none;" title="<?=htmlentities($tinkhac['ten_'.$lang], ENT_QUOTES, "UTF-8")?>"><?=$tinkhac['ten_'.$lang]?></a> <span class="date">(<?=make_date($tinkhac['ngaytao'])?>)</span></li>
                <?php }?>
             </ul>
        </div>
		<?php } ?>

</div>
</div>
</div>
</div>

<!-- end news -->
	</div><!-- end container -->
	</div><!-- end container -->
</div>
</section>