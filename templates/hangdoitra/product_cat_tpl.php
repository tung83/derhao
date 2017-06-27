<script src="assets/carouFredSel-6.2.1/helper-plugins/jquery.mousewheel.min.js" type="text/javascript"></script>
<script src="assets/carouFredSel-6.2.1/jquery.carouFredSel-6.2.1.js" type="text/javascript"></script>
<script src="assets/js/isotope.js" type="text/javascript"></script>


<div class="col-xs-9">
<div class="row filter">


<section>
<div id="category-product-list">

	<div class='title-global' style="width:98%"><h2><?=$title_cat?></h2></div>
</div>
<div class="list_carousel product-list">

<ul id="foo2">
<?php
	$i=0;
	foreach($product as $k=>$v){
		
		
		echo '<li style="width:179px" class="all item  c_'.$v2['id'].'">';
		
		echo '<div class="col-xs-12"><div class="row">';
			echo '<div class="product-item">';
			echo '<div class="image">';
				echo '<a class="fancybox" rel="g1" href="'.$config_url.$v['photo'].'" title="'.$v['ten_'.$lang].'"><img src="'.$config_url.$v['photo'].'" />';
			echo '</div>';
			echo '<div class="desc">';
				echo '<div class="name"><a class="fancybox" rel="g2" href="'.$config_url.$v['photo'].'" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></div>';
			echo '</div>';
			
			
			
			
			echo '</div>';
		echo '</div></div>';
		
		
		echo '</li>';
		
	}
	
?>
</ul>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</section><div class="clearfix"></div>

</div>
</div>
<div class="col-xs-3">
	<div class="row">
<div class='title-global'><h2><?=_category_?></h2></div>
<div class="numberlist">
	<ol class="list-category">
	<?php foreach($cat as $k=>$v){
		echo '<li><a href="product/'.$v['id'].'_'.$v['tenkhongdau'].'.html" data-filter="c_'.$v['id'].'">'.$v['ten_'.$lang].'</a>';
	}
	?>
	<li><a href="product.html" data-filter="c_32"><?=_all_category?></a></li>
	</ol>
	</div>
</div>


	<style type="text/css" media="all">
	.numberlist a {
position: relative;
display: block;
padding: .4em .4em .4em 10px;
margin: .5em 0;
background: #FFF;
border: 1px solid #ccc;
color: #444;
text-decoration: none;
-moz-border-radius: .3em;
-webkit-border-radius: .3em;
border-radius: .3em;
-moz-transition: all 0.3s ease;
-o-transition: all 0.3s ease;
-ms-transition: all 0.3s ease;
transition: all 0.3s ease;
}
	.numberlist a:hover{
		padding-left:20px;
	}
	.product-list .product-item{
		border:1px solid #ccc;
		margin:3px;
		
	}
	.list-category {
		list-style:none;
		margin:0;
		
	
	}
	.list-category li a{
		font-size:17px;
	}
	.product-list .product-item .desc{
		background: rgba(0, 0, 0, 0.51);
padding: 5px 0;
margin-top: -30px;
z-index: 1234;
position: relative;
	}
	.product-list .product-item .desc a{
		color:#fff;
		font-size:17px;
	}
	.product-list .product-item .contact{
		font-size:18px;
		width:96%;
		padding:5px 2%;
		font-weight:bold
		
	}
	.product-list .product-item .contact a:hover{
		text-decoration:none;
		margin-right:10px;
	}
	.product-list .product-item .contact a:first-child{
		color:red;
	}
	.product-list .product-item .contact a:first-child:hover{
		margin-left:10px;
	}
	.product-list .product-item .desc a:hover{
		text-decoration:none;
	}
	
	.product-list .product-item .image{
		width:100%;
		height:160px;
		overflow:hidden;
	}
	.product-list .product-item .image img{
		max-width:100%;
	}
			.list_carousel {
position:relative;
  
    width: 100%;
}
	.list_carousel .nav-product{
		position:absolute;
		left: -58px;
top: 200px;
	}
	.list_carousel .nav-product.right-arrow{
		position:absolute;
		left: 990px;
top: 200px;
	}
.list_carousel ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: block;
}
.list_carousel li {
    color: #999;
    text-align: center;
    width: 1150px;
	overflow:hidden;
    padding: 0;
	margin:0px 4px;

    display: block;
    float: left;
}
.list_carousel li .item{
    float: left;
    /*width:100px;
    height: 100px;*/
    background: red;
}

.list_carousel.responsive {
    width: auto;
    margin-left: 0;
}
.clearfix {
    float: none;
    clear: both;
}
.prev {
    float: left;
    margin-left: 10px;
}
.next {
    float: right;
    margin-right: 10px;
}
.pager {
    float: left;
    width: 300px;
    text-align: center;
}
.pager a {
    margin: 0 5px;
    text-decoration: none;
}
.pager a.selected {
    text-decoration: underline;
}
.timer {
    background-color: #999;
    height: 6px;
    width: 0px;
}
		</style>