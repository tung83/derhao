function appendPage(){
	$(".append-pagin span,.append-pagin a").wrap("<li></li>");
	$(".btn").addClass("btn-flat");
}
function searchForm($request){
	$dm = $("#id_danhmuc");
	$list = $("#id_list");
	$cat = $("#id_cat");
	$key = $("#keyword");
	$url = "index.php?com="+$("#com").val()+"&act="+$("#act").val()+$request;
	if($dm.length){$url+="&id_danhmuc="+parseInt($dm.val());}
	if($list.length){$url+="&id_list="+parseInt($list.val());	}
	if($cat.length){$url+="&id_cat="+parseInt($cat.val());}
	window.location =$url+"&keyword="+$key.val();
}
function initCk(){
	var $id_array = new Array();
	$is_ = false;
	$count = 0;
	$(".editor").each(function(){
		$count++;
		$is_ = true;
		$id = $(this).attr("id");
		$id_array.push($id);
	})
	if($is_){
		if($id_array.length == 0 | ($id_array.length != $count)){
			alert("Missing id for editor!");
		}else{
			var $new_array = new Array();
			$.each($id_array,function(i,item){
				if(!in_array(item,$new_array)){
					$new_array.push(item);
				}else{
					alert('Some id is conflict');
				}
			})
		}
		$.each($new_array,function(i,item){
			$mini = false;
			if($("#"+item).hasClass("mini")){
				$mini = true;
			}
			setupFullEditor(item,$mini);
			//var editor = setupFullEditor(item);
			//CKFinder.setupCKEditor( editor, '/ckfinder/' );
		})
	}
//	if($id_array
	
}
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function initLink(){
	$(".link").change(function(){
		if($(this).val()){
		
		if (!/^http:\/\//.test($(this).val())) {
				$(this).val("http://" + $(this).val());
		}
		}
	})



}

function initSwitch(){
	
	$(".switch-input").each(function(){
		if($(this).attr("checked")=='checked'){
			$(this).attr("checked","true");
		}
		
	})

	$(".switch-input").bootstrapSwitch({onColor:'info',size:'mini',offColor:'danger',onSwitchChange:function(event, state){
		NProgress.start();
		initAjax({url:base_url+"/admin/index.php",data:{id:$(this).data("id"),com:$(this).data("com"),type:$(this).data("type"),value:((state) ? 1 : 0),ajax:true},success:function(data){
			NProgress.done();
		}});
	}
	});


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

  // Overwrite default options 
  // with user provided ones 
  // and merge them into "options". 
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
function initNumber(){
	$(".price").autoNumeric({aSep: '.',vMax:10000000000,vMin:'0',aDec:','});

}
function setCategory($js1,$js2,$js3){
/* core */

	$(".id_danhmuc_chk").change(function(){
		$(".id_cat_chk").html("<option value='0'>-Chọn danh mục-</option>");
		$val = $(this).val();
		$.each($js2,function($item,$i){
			$content = "<option value='0'>-Chọn danh mục-</option>";
			if($item == $val){
				$.each($i,function($item2,$i2){
					$content+="<option value='"+$item2+"'>"+$i2+"</option>";
				})
				$(".id_list_chk").html($content);
			
				
			}
		})
		
	})
	$(".id_list_chk").change(function(){
				$val = $(this).val();
				$.each($js3,function($item3,$i3){
					$content = "<option value='0'>-Chọn danh mục-</option>";
					if($item3 == $val){
						$.each($i3,function($item4,$i4){
							$content+="<option value='"+$item4+"'>"+$i4+"</option>";
						})
						$(".id_cat_chk").html($content);
						
						
					}
				})
			})

}
function setupFullEditor(item,$simple){
var config = new Array();
	// Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
  var basicConfig = {
    height: 100,
    plugins: 'about,basicstyles,clipboard,floatingspace,list,indentlist,enterkey,entities,link,toolbar,undo,wysiwygarea',
    removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript',
    toolbarGroups: [
      { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
      { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
     
    ]
  };
	
    var basicConfig = {
		enterMode:CKEDITOR.ENTER_DIV,
    height: 100,
	entities: false,
	htmlEncodeOutput: false,
    plugins: 'about,basicstyles,clipboard,floatingspace,list,indentlist,enterkey,entities,link,toolbar,undo,wysiwygarea',
    removeButtons: 'Anchor,Underline,Strike,Subscript,Superscript',
    toolbarGroups: [
      { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
      { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
      { name: 'forms' },
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
      { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
      { name: 'links' },
      { name: 'insert' },
      { name: 'styles' },
      { name: 'colors' },
      { name: 'tools' },
      { name: 'others' },
      { name: 'about' }
    ]
  };

 var fullConfig = {
    height: 300,
    plugins: 'about,a11yhelp,basicstyles,bidi,blockquote,clipboard,colorbutton,colordialog,contextmenu,dialogadvtab,div,elementspath,enterkey,entities,filebrowser,find,flash,floatingspace,font,format,forms,horizontalrule,htmlwriter,image,iframe,indentlist,indentblock,justify,language,link,list,liststyle,magicline,maximize,newpage,pagebreak,pastefromword,pastetext,preview,print,removeformat,resize,save,scayt,selectall,showblocks,showborders,smiley,sourcearea,specialchar,stylescombo,tab,table,tabletools,templates,toolbar,undo,wsc,wysiwygarea,image2,widget,lineutils,youtube',
    removeButtons: '',
    removeDialogTabs : '',
	entities: false,
	enterMode:CKEDITOR.ENTER_DIV,
	htmlEncodeOutput: false,
	skin:'bootstrapck',
    toolbarGroups: [
      { name: 'document',	   groups: [ 'mode', 'document', 'doctools'  ] },
      { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
      { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
    //  { name: 'forms' },
      '/',
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
      { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
        { name: 'links' },
     
      '/',
      { name: 'styles' },
      { name: 'colors' },
      
      
     // { name: 'about' },
	   { name: 'insert' },
	
    ]
  };
	
	if($simple){
			var editor = CKEDITOR.replace( item,  CKEDITOR.tools.extend( { height:100 }, basicConfig ) );
	}else{
	var editor = CKEDITOR.replace( item,  CKEDITOR.tools.extend( { height:300 }, fullConfig ) );
	
	CKFinder.setupCKEditor( editor, base_url+'/admin/assets/ckfinder/' );
	}

}
function initInput(){
	$(".form-group").addClass("form-group-sm");
	$(".input-group").addClass("input-group-sm");
	$(".btn").addClass("btn-sm");
	$("input:not(.big),btn:not(.big)").addClass("input-sm");
	$("input[type=radio]").each(function(){
		$(this).removeClass("input-sm");
	
	})

	$("#gal-container-option .form-group,#gal-container .form-group").removeClass("form-group-sm");

}
function Viewfile($class){
	url = $("."+$class).val();
	openFancybox(url);
}
function getUrlParameter(sPageURL,sParam)
{
		
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}  
function initEditStt(){
	$is_edit = 0;
	$com = $("#com").val();
	$act = $("#act").val();
	
	$(".table-bordered tbody tr").each(function(){
		$tr = $(this);
		$id = 0;
		
		if($tr.find("td").length){
		$href = $tr.find("td").last().find("a").attr("href");
		if($href){
		$id  = getUrlParameter($href,"id");
		
		$td = $(this).find("td").first();
		if($td.has("input[type=check]")){
			$td = $td.next();
		}
		
		$txt = $td.html();
		if(parseInt($txt) > 0){
			$td.html("<a href='#' id='' class='edit-stt' data-type='select' data-pk='"+$id+"' data-url='index.php?get_stt=1&save=1&com="+$com+"&act="+$act+"' data-value="+$txt+" data-title='Chọn stt'>"+$txt+"</a>");
		
			$is_edit = 1;
		}
		}
		}
	})
	
	if($is_edit){
		
		
		 
	}
	
	
	
	
}
function initColorPicker(){
	  $('.colorpicker').colorpicker();
}
$().ready(function(){
	appendPage();
	initEditStt();
	initInput();
	initCk();
	initGal();
	initBrowserServer();
	initForm();
	addHttp();
	initNumber();

	initSwitch();
	
	initColorPicker();
	
})
function addHttp(){
	$(".link,input[name=link]").change(function(){
		if($(this).val()){
		if(!isValidURL($(this).val())){
			$(this).val("http://"+$(this).val());
			
		}
		}
	
	})	
	
}

function initTab(){
	$('#myTab a').click(function (e) {
	  e.preventDefault()
	  
	  $(this).tab('show');
		for(var instanceName in CKEDITOR.instances){
			obj = CKEDITOR.instances[instanceName];
			obj.destroy();
			CKEDITOR.replace(instanceName);
		}
	 // initCk();
	})
	$('#myTab a:first').tab('show') // Select first tab
}

function initBrowserServer(){
	$(".browser").click(function(){
		$change = false;
		if($(this).hasClass("show")){
			$change = true;
		}
		BrowseServer($(this).data("for"),$change);
		return false;
	})
}
function BrowseServer($id,$change)
{
	
	var finder = new CKFinder();
	
	finder.selectActionFunction = function( fileUrl, data ) {
		
		$("#"+$id).val(fileUrl.replace(server_folder,''));
		if($change){
			$src = rel_url+fileUrl.replace(server_folder,'');
			//$("#main-image").attr("src",$src).tooltip("show");
			$("#main-image").parent().attr("href",$src);
			$("#image-link").attr("href",$src);
		
		}
		
	}
	finder.popup();

}
function initForm(){	
	$(".form-horizontal input").change(function(){
		$name = $(this).attr("name");
		$(".form-horizontal input[name="+$name+"]").val($(this).val());
		
	})
}
function initGal(){	
	$("a[rel=g]").addClass("fancybox");
	$(".fancybox").fancybox();
}
function isValidURL(url){
    var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    if(RegExp.test(url)){
        return true;
    }else{
        return false;
    }
}
function in_array(needle, haystack){
    var found = 0;
    for (var i=0, len=haystack.length;i<len;i++) {
        if (haystack[i] == needle) return i;
            found++;
    }
    return false;
}
function initDelete(){
$(".delete_photo").click(function(){
	if(confirm("X�a ?nh n�y?")){
	$parent =  $(this).parent();
	$id = $parent.find("input").data("id");
	$parent.html("");
	$parent.append("<input type='hidden' name='delete_photo["+$id+"]' />");
	}
	return false;
	})
}
function initAddImage(){
	$("#add-image").click(function(){

	id = makeid();
	$content = "<div><input type='file' name='_"+id+"'></div>";
	$(".photo-side").append($content);
	return false;
	})
}

function makeid()
{
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for( var i=0; i < 5; i++ )
		text += possible.charAt(Math.floor(Math.random() * possible.length));

	return text;
}
