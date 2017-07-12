<nav class="menu">
	<div class="wrap-nav">	
	<ul id="main-nav" >	
			<li class=" <?php if($com==changeTitle(_about)){ echo 'active';}?>"><a href="<?=getLink(changeTitle(_about).".html")?>" title="<?=_about?>"><?=_about?></a></li>
			<li <?php if($com=='fabric'){ echo 'class="active"';}?>><a href="<?=getLink(changeTitle(_fabric).".html")?>" title="<?= _fabric ?>"><?=_fabric?></a>
                            <ul >
                                <?php 
                                        $link1=changeTitle(_fabric);
                                        echo '<li><a href="'.$link1.'.html">'._all.'</a></li>';

                                        $d->query("select ten_$lang,tenkhongdau,id,type from #_product_danhmuc where hienthi = 1 and type='fabric' order by stt desc");
                                        $_list_product_danhmuc1 = $d->result_array();
                                        foreach($_list_product_danhmuc1 as $k=>$v){
                                            echo '<li><a href="'.$link1.'/'.$v['tenkhongdau'].'-'.$v['id'].'/" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
                                        }
                                ?>
                            </ul>
                        </li>
			<li <?php if($com=='product'){ echo 'class="active"';}?>><a href="<?=getLink(changeTitle(_product).".html")?>" title="<?=_product?>"><?=_product?></a>
                            <ul >
                                <?php 
                                        $link2=changeTitle(_product);
                                        echo '<li><a href="'.$link2.'.html">'._all.'</a></li>';

                                        $d->query("select ten_$lang,tenkhongdau,id,type from #_product_danhmuc where hienthi = 1 and type='product' order by stt desc");
                                        $_list_product_danhmuc2 = $d->result_array();
                                        foreach($_list_product_danhmuc2 as $k=>$v){
                                            echo '<li><a href="'.$link2.'/'.$v['tenkhongdau'].'-'.$v['id'].'/" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
                                        }
                                ?>
                            </ul>
                        </li>
			<li <?php if($com==changeTitle(_news)){ echo 'class="active"';}?>><a href="<?=getLink(changeTitle(_news).".html")?>" title="<?=_news?>"><?=_news?></a>
                            <ul >
                                <?php 
                                        $link2=changeTitle(_news);
                                        echo '<li><a href="'.$link2.'.html">'._all.'</a></li>';

                                        $d->query("select ten_$lang,tenkhongdau,id,type from #_news_danhmuc where hienthi = 1 order by stt desc");
                                        $_list_news_danhmuc2 = $d->result_array();
                                        foreach($_list_news_danhmuc2 as $k=>$v){
                                            echo '<li><a href="'.$link2.'/'.$v['tenkhongdau'].'-'.$v['id'].'/" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></li>';
                                        }
                                ?>
                            </ul>
                        </li>
			<li <?php if($com==changeTitle(_wheretobuy)){ echo 'class="active"';}?>><a href="<?=getLink(changeTitle(_wheretobuy).".html")?>" title="<?=_wheretobuy?>"><?=_wheretobuy?></a></li>
			<li  class=" <?php if($com==changeTitle(_contact)){ echo 'active';}?>"><a href="<?=getLink(changeTitle(_contact).".html")?>" title="<?=_contact?>"><?=_contact?></a></li>
			
			
			
	<div class="clearfix"></div>
	</ul>
	
	
	
	<div class="clearfix"></div>
	
	</div>
</nav>
<div class="clearfix"></div>

	