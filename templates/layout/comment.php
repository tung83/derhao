<script src="assets/comment/jquery.form.js"></script>  
<link href="assets/comment/comment.css" rel="stylesheet" type="text/css" />     
<script src="assets/comment/comment.js"></script>     
   
	 <div class="wrapcomment">
        <div id="comment" class="comment" cmtcategoryid="2" siteid="2" detailid="71693" cateid="2002" urlpage="/may-lanh/daikin-ftkc25pvmv" nameproduct="M&#225;y lạnh Daikin FTKC25PVMV 1 Hp">
<h4 id="id-comment-title">
	Bình luận cho sản phẩm: <?=$product_detail['ten_'.$lang]?>
</h4>
<form id="form-comment" action="" method="POST" class="form_reply" enctype="multipart/form-data">
<div class="x-wrap-editor">

<input type="hidden" name="id" value="<?=$row_detail['id']?>" />
<input type="hidden" class="parent_id_comment" name="parent_id" id="parent" value="" />
<div class="dropfirst textarea div-edit" contenteditable="true" id="content" name="content" style="overflow-y: visible;">
</div>
<div class="showfirst wrap-attaddsend">  
 <div class="attach" onclick="cmtInsertImg();">       
 <i class="iconcom-picture"></i>     
 <img class="load hide" src="https://s.tgdd.vn/commentnew/content/images/add.gif">       
 <span>Gửi hình</span>                    </div>        
<input type="file" class="upload-image" itemid="0" id="upload-image" title="Chèn ảnh kích thước tối đa 1MB/hình" name="file" style="display:none;" accept="image/x-png, image/gif, image/jpeg"> 
      <div class="dropicon addicon"><i class="iconcom-addemotion"></i>Chèn icon <label>Mới</label></div>  
	  <div class="userinfo <?=(isset($_SESSION['user_comment'])) ? '' : 'hide' ?>" id="userinfoLog">
			<i class="glyphicon glyphicon-user"></i><span class="uname"><?=@$_SESSION['user_comment']['name']?> </span><a onclick="editName();" href="javascript:void(0)">(Sửa tên)</a>	  
	  </div> 
	  <div class="dropdown sendclick" id="btnSendCmt"> 
	  <span>Gửi</span>      
	  
      <img class="load hide" src="https://s.tgdd.vn/commentnew/content/images/add.gif">  
      </div>   
	  <div class="captchacmt hide"></div> 
	  </div>
	  
	  <div class="showdropdown wrap_loginpost">  
	  <div class="closeIfo">   
	  <b class="iconcom-closeloi"></b>  
      Đóng 
	  </div> 
	  <aside class="asideleft">  
      <label class="hide">Đăng nhập bằng tài khoản  để bình luận của bạn được duyệt &amp; trả lời nhanh hơn</label> 
	 <div class="hide"> <a href="javascript:void(0);"><i class="iconcom-facebook"></i></a>    
	  <a href="javascript:void(0);"><i class="iconcom-googleplus"></i></a>  
	  </div>
      <a href="javascript:void(0);" class="dropsub">     
	  <i class="iconcom-mobileworld"></i>  
      </a>    
	  <div class="showsub infologin hide">       
	  <input class="userlogin" name="loginemail" type="text" placeholder="Email hoặc số di động" autocomplete="off"> 
	  <input class="userlogin" name="loginpass" type="password" placeholder="Mật khẩu" autocomplete="off">   
	  <a class="forgetpass" href="#">Quên mật khẩu</a>   
	  <button class="loginpost" id="btnSendReplyLogin" data-id="6580407">Đăng nhập &amp; Gửi</button>   
	  <div class="clr"></div> 
	  </div>     
	  <div class="noaccount">Bạn chưa có tài khoản  <a target="_blank" href="https://www.thegioididong.com/dang-ky">Đăng ký ngay</a></div>   
	  <!-- report -->        <div class="reportinfo hide">     
	  <i></i><b class="iconcom-closereport"></b>          
	  Vui lòng kiểm tra lại thông tin<br>      
	  - Không tìm thấy Email và số di động như trên       
	  </div>    </aside>    <aside class="asideright">   
	  <label>Hoặc nhập thông tin của bạn</label>    
	  <input class="infoname" name="sendwithname" type="text" value="<?=@$_SESSION['user_comment']['name']?>" placeholder="Họ tên" maxlength="50" autocomplete="off">  
      <input class="infoname" name="sendwithemail" type="text" value="<?=@$_SESSION['user_comment']['email']?>" placeholder="Email" autocomplete="off">   
	  <input class="infoname hide" name="sendwithIfoSocial" type="text">  
      <a class="finalpost" href="javascript:void(0);" id="btnSendReplyNoLogin" data-id="6580407">Hoàn tất &amp; gửi</a>    </aside>
	  
	  </div>
	  
	  
	  
	  
	  
</div>
<textarea class="dropfirst textarea txtEditor" name="textEditor" placeholder="Mời bạn thảo luận, vui lòng nhập tiếng Việt có dấu" id="txtEditor" ></textarea>
</form>
<div class="infocomment">
<!-- show comment -->






	<?php 
	$d->query("select * from #_comment where product_id = ".$row_detail['id']." and parent_id = 0 order by create_time asc");
		foreach($d->result_array() as $k=>$v){
			
			echo showComment($v);
		} ?>

<?php 
	function showComment($v,$child=false){
		global $d;
		$str ='<div class="comment_ask" id="'.$v['id'].'">';

		$str .='<i class="iconcom-user">'.mb_substr(trim($v['name']),0,1,'UTF-8').'</i>';
	
		$str .='<strong onclick="selCmt('.$v['id'].')" class="comment_name_'.$v['id'].'">'.$v['name'].'</strong>';
		$str .='<div class="infocom_ask">'.$v['content'].'</div>';
		$str .='<div class="relate_infocom" data-cl="0">';
		$str .='<span class="reply" onclick="cmtaddreplyclick('.$v['id'].')">Trả lời </span>';
		//$str .='<b class="dot">●</b>';
		//$str .='<span class="numlike"> <i class="iconcom-like"></i> <span class="like" onclick="likeCmt('.$v['id'].');"> Thích</span> </span>';
		$str .='<span class="date">';
		$str .='<b class="dot">●</b> '.humanTiming($v['create_time']).' </span>';
		//$str .='<span id="rp6542949" class="baoloi" onclick="reportErr('.$v['id'].',1);">';
		//$str .='<b class="dot">●</b> Báo lỗi</span>';
		$str .='</div>';
		$str .='</div>';
		if(!$child){
		$str .='<div class="comment_reply hide reply_'.$v['id'].'" id="'.$v['id'].'"><i class="arrow_box"></i>';
		}
	$d->query("select * from #_comment where parent_id = ".$v['id']);

	if($d->num_rows()){
		foreach($d->result_array() as $k2=>$v2){
			$str .=showComment($v2,true);
		
		}
	}
	

	if(!$child){
		$str.='</div>';
		}
	
	return $str;
	}


?>










<!-- show comment -->





</div>
</div>
</div>