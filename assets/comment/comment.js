function initEditor(){
	$(".txtEditor").click(function(){
		$(".txtEditor").hide();
		$(".x-wrap-editor").show();
		$("#txtEditor").hide();
		if($(".x-wrap-editor .div-edit").find("span").length){
			$(".x-wrap-editor .div-edit span").focus();
		}else{
		$(".x-wrap-editor .div-edit").focus();
		}
	})
}
$().ready(function(){
	initEditor();
	$(".comment_reply").each(function(){
		if($(this).find(".comment_ask").length){
			$(this).removeClass("hide");
		}
	})
})
function cmtInsertImg(){
	$("#upload-image").click();
	
	
}
$().ready(function(){
	
	setClick();
	
	
           
})

function setClick(){
	$("#btnSendCmt,#btnSendReplyNoLogin").click(function(){
		$name = $("input[name='sendwithname']");
		$email = $("input[name='sendwithemail']");
		if(!$(".wrap_loginpost").is(":visible") & $name.val()==''){
			$(".wrap_loginpost").slideToggle();
			return false;
		}else{
			if(checkCommentName()){
				postComment();
			}
		}
		
		
		
	})	
	
	$(".closeIfo").click(function(){
		$(".wrap_loginpost").slideToggle();
		return false;
	})
	
	
	$(".upload-image").change(function(){
		if($(this).val()){
			
			$('#form-comment').attr("action","comment/upload.html");
			$('#form-comment').trigger("submit");
		}
	})
	$('#form-comment').ajaxForm({ 
		success:function(data){
			$(".div-edit").html($(".div-edit").html()+"<img src='"+data+"' style='max-width:600;max-height:600' class='img-responsive'>");
		}
	});
	
	}
	function likeCmt(id){
		$.post("ajax/like.html",{id:id},function(data){
			console.log(data);
		})
		return false;
	}
function setCode(data,reply){
	
	$str="";
	if(reply == true){
		$str+='<div class="comment_reply comment_reply reply_'+data.id+'" id="'+data.id+'"><i class="arrow_box"></i>';
	}
		
	$str = '<div class="comment_ask" id="'+data.id+'">';
	$str += '<i class="iconcom-user">'+data.first_char+'</i>';
	$str += '<strong class="comment_name_'+data.id+'" onclick="selCmt('+data.id+')">'+data.name+'</strong>';
	$str += '<div class="infocom_ask">'+data.content+'</div>';
	$str += '<div class="relate_infocom" data-cl="0">';
	$str += '<span class="reply" onclick="cmtaddreplyclick('+data.id+')">Trả lời </span>';
	//$str += '<b class="dot">●</b>';
	//$str += '<span class="numlike"> <i class="iconcom-like"></i> <span class="like" onclick="likeCmt('+data.id+');"> Thích</span> </span>';
	$str += '<span class="date">';
	$str += '<b class="dot">●</b> '+data.time+'</span>';
	//$str += '<span id="rp6542949" class="baoloi" onclick="reportErr('+data.id+',1);">';
	//$str += '<b class="dot">●</b> Báo lỗi</span>';
	$str += '</div>';
	$str += '</div>';
	if(reply == 1){
		$str+="</div>";
	}else{
		$str+='<div class="comment_reply hide"><i class="arrow_box"></i></div>';
	}
	return $str;
	
}
function editName(){
	$("#userinfoLog").addClass("hide");
	$(".wrap_loginpost").slideDown();
	$(".infoname").val("");
	return false;

}
function postComment(){
		$(".txtEditor").val($(".div-edit").html());
		$id_parent = $(".parent_id_comment").val();
		if($(".txtEditor").val().length < 10){
			alert("Kí tự quá ít.");
			$(".div-edit").focus();
			return false;
		}
			$.ajax({
				url:"comment/save.html",
				type:"post",
				dataType:"json",
				data:$("#form-comment").serialize(),
				success:function(data){
					if($id_parent==''){
					$(".infocomment").append(setCode(data));
					}else{
						if($(".reply_"+$id_parent).length){
							$(".reply_"+$id_parent).append(setCode(data));
						}else{
							$(".comment_ask#"+$id_parent).parent().append(setCode(data));
						}
					}
					
					loadCmt(data.id);
					$(".div-edit").html('');
					$(".parent_id_comment").val('');					
					$form = $("#form-comment").clone();
					
					$("#form-comment").remove();
					$form.find(".wrap_loginpost").hide();
					
					$form.find("#userinfoLog").removeClass("hide");
					$form.find("#userinfoLog").find(".uname").html(data.name);
					/*$form.find(".div-edit").hide();*/
					$form.find("#txtEditor").hide();
					$("#id-comment-title").before($form);
					$("#comment_ask#"+data.id).focus();
					//$(".div-edit").focus();
					initEditor();
					showMsg("success","Gửi bình luận thành công");
					return false;
					
				}
			})
			return false;
		}
		function loadCmt(id){
			//if($(".comment_ask#"+id).find(".infocom_ask").find("img").length){
			$.post("comment/load.html",{id:id},function(data){
				$(".comment_ask#"+id).find(".infocom_ask").html(data);
			})
			//}
			
		}
		function checkCommentName(){
			$stt = true;
		if($("input[name='sendwithname']").val()==''){
			alert("Vui lòng nhập tên");
			$("input[name='sendwithname']").focus();
			$stt = false;
		}
		if($stt & $("input[name='sendwithemail']").val()==''){
			alert("Vui lòng nhập email");
			$("input[name='sendwithemail']").focus();
			$stt = false;
		}
		return $stt;
	}
		
		
	function cmtaddreplyclick($id){
		 $content = $("#form-comment").clone();
		 $("#form-comment").remove();
		 $name = $("#comment .comment_name_"+$id).html();
		 $content.find(".div-edit").html("<span>@"+$name+":</span> ");
		 if($(".reply_"+$id).length){
			$obj = $(".reply_"+$id);
			
			if($obj.find(".comment_ask").length){
				$obj.find(".comment_ask").first().before($content);
			}else{
				$(".reply_"+$id).removeClass("hide").append($content);
			}
		 }else{
			 $(".comment_ask#"+$id).after($content);
		 }
		
		 $(".parent_id_comment").val($id);
		 initEditor();
		 setClick();
		 $(".txtEditor").trigger("click");
		 return false;
	}	