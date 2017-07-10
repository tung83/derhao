<link href="assets/css/rp-menu.css" rel="stylesheet" type="text/css" />
<div class="title-rpmenu">
		
		<div class="wrap">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
		<div class="clearfix"></div>
		</div>
		

	</div>
<div id="responsive-menu">
	
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		
		
		
	<div class="clearfix"></div>
	<div class="content">
		
	</div>	
	<div class="clearfix"></div>
</div>
<script>

	$().ready(function(){
		$menu = $("#main-nav").clone();
		$menu.removeAttr("id");
		$menu.find(".no-index").remove();
		$("#responsive-menu .content").append($menu);
		$("#responsive-menu .content").append('<div class="clearfix"></div>');
		$menu = $("#responsive-menu .content ul");
		$menu.find("li").each(function(){
			if($(this).find("ul").length){
				$(this).addClass("has-child");
				$(this).find("a").first().append("<span class='toggle-menu'><i class='fa fa-sort-desc'></i></span>");
			}
		})
		$("#responsive-menu .toggle-menu").click(function(){
				$(this).find("i").toggleClass("glyphicon-menu-down");
				$(this).find("i").toggleClass("glyphicon-menu-up");
			if(!$(this).hasClass("active")){
				$(this).parent().parent().find("ul").first().slideDown();
				$(this).addClass("active");
			}else{
				$(this).parent().parent().find("ul").first().slideUp();
				$(this).removeClass("active");
			}
			return false;
		})
		$("#responsive-menu .title").click(function(){
			$list = $(this).next().next().find("ul").first();
			console.log($list.is(":visible"));
			
			if($list.is(":visible")){
				$list.slideUp();
			}else{
				
				$list.slideDown();
			}
		})
		$("#responsive-menu").attr("data-top",$("#responsive-menu").offset().top);
		$(window).scroll(function(){
			$top = $(window).scrollTop();
			$ele = $("#responsive-menu").attr("data-top");
			if($top > $ele){
				//$("#responsive-menu").css({position:"fixed"});
			}else{
			//	$("#responsive-menu").css({position:"relative"});
			}
			
		})
		
		
		$(".title-rpmenu").click(function(){
		$("body").css({
				"overflow-x":"hidden"
		})
		$("#responsive-menu,#xmen,header").css({'transition' : 'all 0.7s ease-in-out',
		'transform' : 'translateX(300px)'});
		$(".title-rpmenu").fadeOut();

		return false;
	})
	
	$("#responsive-menu button.close,#nav-page-wrapper,#xmen").click(function(){
		$("#responsive-menu,#xmen,header").css({
		'transform' : 'translateX(0px)'});
		setTimeout(function(){
			$(".title-rpmenu").fadeIn();
			$("body").css({
				"overflow-x":"auto"
		})
		},1000)
	})
		
		
		
		
		
		
		
		
		
		
		
	})
</script>