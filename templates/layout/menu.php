<nav class="">
	<div class="wrap-nav">	
	<ul id="main-nav">
	
		
		
			<li class=" <?php if($template=='index'){ echo 'active';}?>"><a href="" title="<?=_home?>"><?=_home?></a></li>
			<li class=" <?php if($com==changeTitle(_about)){ echo 'active';}?>"><a href="<?=getLink(changeTitle(_about).".html")?>" title="<?=_about?>"><?=_about?></a></li>
			<li <?php if($com==changeTitle(_fabric)){ echo 'class="active"';}?>><a href="<?=getLink(changeTitle(_fabric).".html")?>" title="<?= _fabric ?>"><?=_fabric?></a></li>
			<li <?php if($com==changeTitle(_product)){ echo 'class="active"';}?>><a href="<?=getLink(changeTitle(_product).".html")?>" title="<?=_product?>"><?=_product?></a></li>
			<li <?php if($com==changeTitle(_promotion)){ echo 'class="active"';}?>><a href="<?=getLink(changeTitle(_promotion).".html")?>" title="<?=_instock?>"><?=_instock?></a></li>
			<li <?php if($com==changeTitle(_wheretobuy)){ echo 'class="active"';}?>><a href="<?=getLink(changeTitle(_wheretobuy).".html")?>" title="<?=_wheretobuy?>"><?=_wheretobuy?></a></li>
			<li  class=" <?php if($com==changeTitle(_contact)){ echo 'active';}?>"><a href="<?=getLink(changeTitle(_contact).".html")?>" title="<?=_contact?>"><?=_contact?></a></li>
			
			
			
	<div class="clearfix"></div>
	</ul>
	
	
	
	<div class="clearfix"></div>
	
	</div>
</nav>
<div class="clearfix"></div>

	