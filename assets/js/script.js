/*
	@author: remy sharp
	@date: 2006-12-15
	@description: step increment object
	@version: $Id$
*/

var stepper = function(s, dp) {
	// sanity watchers
	if (s && typeof s == 'string') s = parseFloat(s)
	if (dp && typeof dp == 'string') dp = parseFloat(dp)
	
	if (arguments.length == 1) dp = -1

	this.s = s // step increment (aka pip)
	this.dp = dp // decimal places to keep

	this.running = true;

	this.validate()

	return this		
}

stepper.prototype = {	
	validate: function() {
		if (parseFloat(this.setDP(this.s)) == 0) {
			alert("The decimal places cannot be shorter than the PIP.\ndp = " + this.dp + ", pip = " + this.s)
		}
	},
	
	mul: function() { return Math.pow(10, this.dp == -1 ? 1 : this.dp) },
	
	upToInt: function(n) {
		return Math.round(n * this.mul()) // handle dp recursion
	},
	
	downToFloat: function(n) {
		return (n / this.mul())
	},
	
	setDP: function(n) {
		var r = n.toString()
		
		// -1 on dp means leave as is
		if (this.dp == -1) return r
		
		// handle whole numbers
		if (this.dpLen(r) == -1 && this.dp > 0) r += ".0"
		else if (this.dpLen(r) == -1 && this.dp == 0) return r
		
		// handle fractions
		if (this.dpLen(r) > this.dp) { // strip
			var i = r.indexOf('.')
			r = r.substring(0, i) + '.' + r.substring(i + 1, i + 1 + this.dp)
		} else { // add
			while (this.dpLen(r) < this.dp) r += "0"
		}
		return r
	},
	
	dpLen: function(n) {
		if (n.indexOf('.') == -1)
			return -1
		else
			return (n.length) - (n.indexOf('.') + 1)
	},

	step: function(n) {
		if (arguments.length) {
			if (arguments[0] && typeof arguments[0] == 'string') {
				this.n = parseFloat(arguments[0])
			} else if (arguments[0] == NaN) {
				this.n = 0
			} else {
				this.n = arguments[0]
			}
		} else {
			alert("stepper::step expects a float value")
			return
		}					
		
		var n = this.upToInt(this.n)
		var s = this.upToInt(this.s)
		var r = this.setDP(this.downToFloat(n - (n % s) + s))
				
		return r
	}
}

/**
 * jQuery mousehold plugin - fires an event while the mouse is clicked down.
 * Additionally, the function, when executed, is passed a single
 * argument representing the count of times the event has been fired during
 * this session of the mouse hold.
 *
 * @author Remy Sharp (leftlogic.com)
 * @date 2006-12-15
 * @example $("img").mousehold(200, function(i){  })
 * @desc Repeats firing the passed function while the mouse is clicked down
 *
 * @name mousehold
 * @type jQuery
 * @param Number timeout The frequency to repeat the event in milliseconds
 * @param Function fn A function to execute
 * @cat Plugin
 */

jQuery.fn.mousehold = function(timeout, f) {
	if (timeout && typeof timeout == 'function') {
		f = timeout;
		timeout = 100;
	}
	if (f && typeof f == 'function') {
		var timer = 0;
		var fireStep = 0;
		return this.each(function() {
			jQuery(this).mousedown(function() {
				fireStep = 1;
				var ctr = 0;
				var t = this;
				timer = setInterval(function() {
					ctr++;
					f.call(t, ctr);
					fireStep = 2;
				}, timeout);
			})

			clearMousehold = function() {
				clearInterval(timer);
				if (fireStep == 1) f.call(this, 1);
				fireStep = 0;
			}
			
			jQuery(this).mouseout(clearMousehold);
			jQuery(this).mouseup(clearMousehold);
		})
	}
}




function setFixSlider(){
		$top = 0;
		if($(window).width() > 767){
			$top = $("header").outerHeight();
			$(".fixed-slider").removeClass("fixed-top");
			$(".fixed-slider").css("top",0);
		}else{
			$(".fixed-slider").addClass("fixed-top");
		}
		$(".fixed-slider").css({marginTop:$top});
	}
	if(!$(".wrap-slider").length){
		$("#page-wrapper").addClass("fixed-slider");
	}
	$(window).bind("load resize",function(){
		setFixSlider();
	})






function setRaty(){
	if($(".raty").length){
		$(".raty").each(function(){
			path = $(this).data("big") ? 'images_big' : 'images';
			$(this).raty({path: 'assets/plugins/raty/'+path,score:$(this).data("score"),readOnly:true});
			
			
		})
	}
}	

function initAjax(options){
  var defaults = { 
    url:      '', 
    type:    'post', 
	data:null,
    dataType:  'html', 
    error:  function(e){console.log(e)},
	success:function(){return false;},
	beforeSend:function(){},
  }; 
  var options = $.extend({}, defaults, options); 
	$.ajax({
		url:options.url,
		data:options.data,
		success:options.success,
		error:options.error,
		type:options.type,
		dataType:options.dataType,
		
	})
	

}
function controlProductQty(){
	
	
	$("button.add-cart").unbind("click");
	$("button.add-cart").click(function(){
		p = $(this).parents(".product-qty");
		doAddCart($(this).data("name"),$(this).data("id"),p.find("input").val());
		return false;	
	})
	
	$(".product-qty .controls button").unbind("mousehold");
	$(".product-qty .controls button").mousehold(function(){
		a = $(this);
		c = $(this).parent().find("input");
		v = parseInt(c.val());
		
		if(a.hasClass("is-up")){
			v++;
		}else{
		v--;
		}
		if(v <1 ){
			v=1;
		}
		
		c.val(v);
		
	})
}
function checkImageError(){
	$("img.image-thumb").attr("onerror","this.onerror=null;this.src='images/no_photo.png'");
	$("img.image-thumb").each(function(){
		d = new Date();
		$(this).attr("src",$(this).attr("src")+"?"+d.getTime());
	})
}
function initBackToTop(){

  $(".back-to-top").click(function () {
	   //1 second of animation time
	   //html works for FFX but not Chrome
	   //body works for Chrome but not FFX
	   //This strange selector seems to work universally
	   $("html, body").animate({scrollTop: 0}, 1000);
	   return false;
	});
  }
function resetEmptyContent(){
	$(".empty-content").each(function(){
		$w = $(this).find("span").width()+70;
		$(this).width($w);
	})
	
	
}
function initMenu(){
	return false;

	$("#main-nav").css({"opacity":"0"});
	$("ul#main-nav li").css({overflow:"hidden"});
$("ul#main-nav li *").attr("style",""); 
$w = 0;
$sl =0;
$("#main-nav > li").each(function(){
	$(this).find("a").css({"padding-left":"0","padding-right":"0"});
	$w+=$(this).outerWidth();
	$sl++;
})
$win = $("nav #main-nav").width();
$sprt = $win;
$pad = (($sprt/$sl));
$xx = 0;
$("#main-nav > li > a").each(function(){
	$padx = (($pad-$(this).width())/2)-5;
	
	$(this).css({"padding-left":$padx,"padding-right":$padx});
	
})
$("#main-nav").css({"opacity":"1"});

setTimeout(function(){	
	$(".s-child").parent().addClass("s");
	$(".title-link").click(function(){
		$(this).next().slideToggle();
		
		return false;
		
	})

	$("#main-nav  li.f").each(function(){
		
		if($(this).find("ul").length){
			$obj = $(this).find("ul").first();
			$w = $obj.find("li.t").first().find("a").width();
			$obj.find("li.t").each(function(){
				
				if($(this).find("a").width() > $w){
					console.log($(this).find("a").width());
					$w = $(this).find("a").width();
				}
			})
			
				$obj.css({"width":$w+20,"display":"none","position":"absolute"});
			
		}
		
	});
	$("#main-nav  li.f").parent().addClass("x");
	 $("#main-nav  li").each(function(){
			
		if($(this).find("ul").length){
			
			$obj = $(this).find("ul.x").first();
			
			$w = $obj.find("li.f").first().find("a").width();
			
			$obj.find("li.f").each(function(){
				
				if($(this).find("a").width() > $w){
					
					$w = $(this).find("a").width();
					
				}
			})
		
			$obj.css({"width":$w+20,"display":"none","position":"absolute"});
			
		}
		
	}); 
	
	
	$("#main-nav  li").css({overflow:"inherit"});	
},1000);
	
	
}
function setList(){
	$w = 0;
	$max = $(".container").width();
	var $stt = 0;
	$(".top-footer .menu ul li a").each(function(){
		$stt++;
		$w+= $(this).width();
	})
	$pd = (($max-$w)/$stt)/2;
	$(".top-footer .menu ul").width($max);
	$(".top-footer .menu ul li").css({"padding":"0 "+$pd+"px"});
	
	
	
}
function setCenterTitle(){
	setTimeout(function(){
	$(".global-title").each(function(){
		$core = $(this).find("h2");
		$core.css("padding","0 30px");
		$core.removeClass("active");
		$core.css({float:"left","margin":"auto"});
		$w = $core[0].clientWidth;
		$core.css({width:$w,"float":"none","padding":0});
		
		$core.addClass("active");
	})
	},200);
	
}




function initQuickView(){
	$(".quick-view-product").click(function(){
		
		$href = $(this).attr("href");
		$.fancybox({
			href:$href,
			type:"ajax",
			autoSize:false,
			width:900,
			height:900,
			afterShow:function(){
				initShowTooltip();
			}
		})
		return false;
		
	})
	
	
}
function initOpenFormMember(){
	
	$(".open_form").click(function(){
		
		if(!$("#form_member").length){
			$("body").append("<div id='form_member' class=''></div>");
		}
		
		$.post(base_url+"/thanh-vien/open-form.html",{type:$(this).data("type")},function(data){
			$("#form_member").html(data);
			
			$("#form_member").append("<a href='' data-toggle='modal' id='tg_modal' data-target='#regestration'>bcddddddd</a>")
			$("#tg_modal").click();
			return false;
		});
		
		return false;
	
	})
}
function showMsg($type,$msg){
	notify({
                    type: $type, //alert | success | error | warning | info
                    title: "Alert",
                    message: $msg,
                    position: {
                        x: "right", //right | left | center
                        y: "top" //top | bottom | center
                    },
                    icon: '<img src="assets/plugins/notify/images/paper_plane.png" />', //<i>
                    size: "normal", //normal | full | small
                    overlay: false, //true | false
                    closeBtn: true, //true | false
                    overflowHide: false, //true | false
                    spacing: 20, //number px
                    theme: "default", //default | dark-theme
                    autoHide: true, //true | false
                    delay: 2500, //number ms
                    onShow: null, //function
                    onClick: null, //function
                    onHide: null, //function
                    template: '<div class="notify"><div class="notify-text"></div></div>'
                });

}
function updateCart(){
		
		NProgress.start();
		$("#content-center").animate({opacity:".9"});
		initAjax({
			url:"ajax/update-cart.html",
			data:$("#box-shopcart form").serialize(),
			success:function(data){
				console.log(data);
			
				refreshCart();
			}
		})
		
		
	}
	function refreshCart(){
		$.post("gio-hang.html",function(data){
			$("#box-shopcart").html(data);
			updateCartNumber();
			NProgress.done();
			$("#content-center").animate({opacity:1});
			$('[data-toggle="tooltip"]').tooltip();
			
		})
		
		
	}
function updateCartNumber(){
	$.post("ajax/get-cart-num.html",function(data){
	$(".cart-num").html(data);
	})
}
function setCenterName(){

				$(".new-product").each(function(){
					$(this).find(".name").height(0);
					$(this).find(".name").height($(this).find("h2").innerHeight());
				})
				$(".content-view-image .desc-view a").each(function(){
					$(this).css({height:$(this).height(),position:"absolute"});
				})
				
				
			}
			
$().ready(function(){
	controlProductQty();
	setKeyPress();
	loadCus();
	setCenterName();
})
function loadCus(){
	$("#email_sub").keyup(function(){
		
			loadCustomerInfo($(this));
	})
		$("#email_sub").change(function(){
			
			loadCustomerInfo($(this));
	})
	
}
function loadCustomerInfo($obj){
		if($("#user_id").val() == ''){
		if(validateEmail($obj.val())){
		initAjax({
			url:"ajax/load-customer-info.html",
			data:{email:$obj.val()},
			dataType:"json",
			success:function(data){
				if(data.stt){
					$.each(data.data,function($k,$v){
						$object = $("#form-payment ."+$k+"_");
						if($k=="district"){
							loadDistrict($(".province_"),$('#district-list'),$v);
						}
						$object.val($v);
						
						
					})
				}
				
		}
		});
		
		}
	}
	
}
function loadDistrict($this,$object,$mid){
	$id = $this.val();
	if($id){
		initAjax({
			url:"ajax/load-district.html",
			data:{id:$id},
			dataType:"json",
			success:function(data){
				$object.find("option:not(:first)").remove();
				$.each(data,function(i,item){
					$str = '';
					if($mid > 0){
						if(item.districtid == $mid){
							$str = "selected";
						}
					}
					$object.append("<option value='"+item.districtid+"' "+$str+">"+(item.type+" "+item.name)+"</option>");
					
				})
			}
			
		})
	}
	
}
	function deleteCart(id){
		if(confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")){
		NProgress.start();
		$("#content-center").animate({opacity:".9"});
		initAjax({
			url:"ajax/delete-cart.html",
			data:{id:id},
			success:function(data){
				refreshCart();
			}
		})
		}
	}
	function clearCart(id){
		if(confirm("Bạn có chắc chắn muốn xóa tất cả sản phẩm?")){
		NProgress.start();
		$("#content-center").animate({opacity:".9"});
		initAjax({
			url:"ajax/clear-cart.html",
			success:function(data){
				refreshCart();
			}
		})
		}
	}
function clearCart(){
	if(confirm("Bạn có muốn xóa toàn bộ sản phẩm trong giỏ hàng?")){
		$(".box_containerlienhe .content").animate({opacity:0.6});
		$.post("gio-hang/clear.html",function(data){
			$(".box_containerlienhe .content").html(data);
			$(".box_containerlienhe .content").animate({opacity:1});
			updateCartNumber();
		})
	}	
}
function setKeyPress(){
	$('.product-qty').keypress(function (e) {
		if (e.which == '13') {
			$(this).parents("tr").find("td").last().find("a:first").click();
			}
	});
}



function smoothScrolling() { /*-------------------------------------------------*/
/* =  smooth scroll in chrome
	/*-------------------------------------------------*/
  try {
    $.browserSelector();
    // Adds window smooth scroll on chrome.
    if ($("html").hasClass("chrome")) {
      $.smoothScroll();
    }
  } catch (err) {

  }

}
function initOpenFormMember(){
	
	$(".open_form").click(function(){
		
		if(!$("#form_member").length){
			$("body").append("<div id='form_member' class=''></div>");
		}
		
		$.post(base_url+"/thanh-vien/open-form.html",{type:$(this).data("type")},function(data){
			$("#form_member").html(data);
			
			$("#form_member").append("<a href='' data-toggle='modal' id='tg_modal' data-target='#regestration'>bcddddddd</a>")
			$("#tg_modal").click();
			return false;
		});
		
		return false;
	
	})
}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}
function initShowTooltip(){
	
  $('[data-toggle="tooltip"]').tooltip()

}
$().ready(function(){
	setRaty();
	$("a[rel=fancybox],.fancybox").fancybox();
	checkImageError();
	initBackToTop();
	//smoothScrolling();
	setList();
	initOpenFormMember();
	
	initMenu();
	//setCenterTitle();
	initQuickView();
	initShowTooltip();
	resetEmptyContent();
	$(window).resize(function(){
		//setCenterTitle();
		//setCenterTitle();
		setCenterName();
		initMenu();
		setList();
		resetEmptyContent();
	})
	
})


function doAddCartSimple($obj){
	doAddCart($obj.parents(".item-product").data("name"),$obj.parents(".item-product").data("id"),1,0,0);
	return false;
}
function doAddCart($name,$id,$qty,$color,$size){
	hideCartMini();
	NProgress.start();
	initAjax({
		url:"ajax/add-cart.html",
		data:{id:$id,qty:$qty,color:$color,size:$size},
		success:function(data){
			$(".num-cart").html(data);
			showMsg("success","Thêm sản phẩm "+$name+" vào giỏ thành công");
			NProgress.done();
			//showCartMini();
		}
	})
return false;		
}

function addCart(){
	
		$("#add-cart").click(function(){
		$color = 0;
		$size = 0;
		$id = $(this).data("id");
		$qty = parseInt($("#qty").val());
		if($("#p_color").length){
			if($("#p_color .color_item.active").length){
				$color = $("#p_color .color_item.active").data("id");
			}else{
				showMsg("warning","Vui lòng chọn màu cho sản phẩm!");
				$("html, body").animate({ scrollTop: $("#p_color").offset().top }, 500);
				return false;
			}
			
		}
		if($("#p_size").length){
			if($("#p_size .size_item.active").length){
				$size = $("#p_size .size_item.active").data("id");
			}else{
				showMsg("warning","Vui lòng chọn kích thước cho sản phẩm!");
				$("html, body").animate({ scrollTop: $("#p_size").offset().top }, 500);
				return false;
			}
			
		}
		doAddCart($(this).data("name"),$id,$qty,$color,$size);
		return false;
});  

}


$().ready(function(){
	$('#x_refesh').bind('contextmenu', function(e) {
    return false;
}); 
	if($(".product-bx").length){
				$(".product-bx").bxSlider({
					minSlides:4,
					infiniteLoop:true,
					maxSlides:4,
					moveSlides:1,
					slideWidth:$("#main-detail").width()/4,
					pager:0,
					auto:1,
					pause:2000,
					onSlideAfter:function($slideElement, oldIndex, newIndex){
						$("#carousel li").eq(newIndex).find("a").click();
						$("#carousel li").eq(newIndex).find("a").find("img").click();
						
						
					
					
					}
					
				})
				}
	//initDescHeight();
	if($(".product-image-list #list-image").length){
		$(".product-image-list #list-image").owlCarousel({
		  items : 4, //10 items above 1000px browser width
		  itemsDesktop : [1000,4], //5 items between 1000px and 901px
		  itemsDesktopSmall : [900,4], // betweem 900px and 601px
		  itemsTablet: [600,4], //2 items between 600 and 0
		  itemsMobile : false,// itemsMobile disabled - inherit from itemsTablet option
		  navigation : false
		});
	}
	$("#qty").change(function(){
		if(!parseInt($(this).val(), 10)){
				$(this).val(1);									
		}
		if(parseInt($(this).val()) < 1){
			$(this).val(1);
		}
	})
	$(".tab-category li a").click(function(){
			$(".tab-category li").removeClass("active");
			$id = $(this).attr("href");
			$(this).parent().addClass("active");
			$(".tab-category .tab").fadeOut(function(){
				$(".tab-category .tab").removeClass("active");
				$(".tab-category .tab"+$id).fadeIn().addClass("active");
				
				
			})
			
			return false;
	})
		
	$(".tab-nav li").click(function(){
		$(this).find("a").click();
	})	
	if($("#img_01").length){
	
	$("#img_01").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: false,
		 loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});
		 //pass the images to Fancybox
		 $("#img_01").bind("click", function(e) {
		 var ez = $('#img_01').data('elevateZoom');
		
		 $.fancybox(ez.getGalleryList()); 
		 });
		
	}
	
	setTimeout(function(){
		 $("#x_refesh .bx-wrapper .bx-slides li a").click(function(){
			$name = $(this).data("name");
			$(".wrap-on-image .desc").html($name);
			return false;
		 })
	},500);
	
})
function initDescHeight(){
	
		if($("#product-detail").length){
			$h = $("#product-detail .desc-place .wrap").height();
			
				if($h > 200){
					$("#product-detail .desc-place").css({"overflow-y":"scroll"});
				}
				$("#product-detail .desc-place").css({visibility:"visible"});

				
	}
	
}

function compareProduct($obj){
	NProgress.start();
	$name =$obj.parents(".item-product").data("name");
	$id = $obj.parents(".item-product").data("id");
	showProductCompare(-200);
	initAjax({
		url:"ajax/add-compare.html",
		data:{id:$id},
		dataType:"json",
		success:function(data){
			console.log(data);
			if(data.stt==1){
				showProductCompare(0);
				
			}else{
				showProductCompare(0);
				showMsg("error","Đã có 4 sản phẩm so sánh!");
			}
			
			NProgress.done();
			setTimeout(function(){
				showProductCompare(-200);
			},5000);
		}
	})
	return false;
}
function removeCompare($obj){
	showProductCompare(-200);
	$.post("ajax/remove-compare.html",{id:$obj.data("id")},function(){
		showProductCompare(0);
	})
}
function showProductCompare($px){
	
	if($px < 0){
	$("#compare-product").animate({"right":$px+"px"});	
	}else{
		
		$.post('ajax/get-compare.html',function(data){
			$("#compare-product .inner").html(data);
			$("#compare-product").animate({"right":$px+"px"});	
			updateCartNumber();
		})
	}
}


/* show notify */
function ShowNotify($msg,$type){
	var t;
		$cls = "error";
		if($type==1){
			$cls = "success";
		}
		if(!$("body").find(".alert-box-container").length){
			$("body").append("<div class='alert-box-container'></div>");
		}
		
		$clss = Math.floor((Math.random() * 999999) + 1);
		$msg = "<div class='cl_"+$clss+" "+$cls+"-box alert-box' style='opacity:0'> <div class='msg'>"+$msg+"</div> <p><a class='toggle-alert' href='#'>Toggle</a></p> </div>";
		$(".alert-box-container").append($msg);
		$(".cl_"+$clss).animate({opacity:1});
		setTimeout(function(){
			$(".alert-box-container .alert-box").first().slideUp(function(){$(".alert-box-container .alert-box").first().remove();})
		},2000);
		$(".alert-box-container .toggle-alert").click(function(){ $(this).parents(".alert-box").slideUp(function(){$(this).parents(".alert-box").remove();}); return false; });
}
/* end show notify */

/* js for member */
function initOpenFormMember(){
	
	$(".open_form").click(function(){
		
		if(!$("#form_member").length){
			$("body").append("<div id='form_member' class=''></div>");
		}
		
		$.post(base_url+"/thanh-vien/open-form.html",{type:$(this).data("type")},function(data){
			$("#form_member").html(data);
			
			$("#form_member").append("<a href='' data-toggle='modal' id='tg_modal' data-target='#regestration'></a>")
			$("#tg_modal").click();
			return false;
		});
		
		return false;
	
	})

}

function intializePopover(option){
		option = $.extend({
		ele:"",
        title: "LĂ¡Â»â€”i",
        content:"",
    }, option);
        option.ele.popover({'placement':'top', title: option.title, content: option.content }).show();
		option.ele.popover('show')
		option.ele.click(function(){
			$(this).popover('hide');
		})
		$(document).on('click', function(event) {
			option.ele.popover('destroy')
		  });
		  
		
		option.ele.focus();
}

/* end js for member */

/* js cart */
var $t;
	function delorder_gh(id){
		if(confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")){
		NProgress.start();
		
		initAjax({
			url:"ajax/delete-cart.html",
			data:{id:id},
			dataType:"json",
			success:function(data){
					NProgress.done();
					updateCartNumber();
					$("#gio_hang_sp_"+id).animate({height:0,opacity:0},function(){
						$(this).remove();
						$("#gio_hang_tong").html(data.total);
						
						if(data.qty==0){
							$(".empty-cart").removeClass("hide");
							$(".cart-enter, p.total").hide();
						}
						
					})

			}
		})
		}
		return false;
	}
	function showCartMini(){
		initAjax({
			url:"ajax/view-mini-cart.html",
			dataType:'json',
			success:function(data){
				clearTimeout($t);
					$("#cart_mini ul").html(data.data);
					$("#gio_hang_tong").html(data.total);
					$("#cart_mini").stop().animate({right:"0%"},1000);
					$(".mini-cart-title").fadeOut();
					$t = setTimeout(function(){
						$("#cart_mini").stop().animate({right:"-370px"},1000,function(){
							$(".mini-cart-title").fadeIn();
						});
						
					},6000);
					

			}
		})
	}
	function hideCartMini(){
		
		$("#cart_mini").animate({right:"-370px"},1000,function(){
			$(".mini-cart-title").fadeIn();
		});
	}
	$().ready(function(){
		$("#cart_mini .close").click(function(){
			$("#cart_mini").animate({right:"-370px"},1000,function(){
				$(".mini-cart-title").fadeIn();
			});
		})
		$(".mini-cart-title").click(function(){
			//alert("x");
			showCartMini();
		})
	})