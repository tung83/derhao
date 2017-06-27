<div id="content">
 <div class="title-global">
		<h2><?=$title_cat?></h2>
    </div>
	<div class="header-question">
	Ấn vào câu hỏi để xem câu trả lời <button class="btn btn-success pull-right btn-show-form">Đặt câu hỏi</button>
	</div>
	<div class="clearfix"></div>
	<div class="from question" >
	
	<div class='col-xs-12 col-md-8 col-md-offset-2 inner-form'>
	<div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Form đặt câu hỏi</h3>
      </div>
      <div class="panel-body">
      
	<form id="from-post">
  <div class="form-group">
    <label for="exampleInputEmail1">Họ tên</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="post[ten]" required placeholder="Họ tên">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="email" class="form-control" id="exampleInputPassword1" name="post[email]" required placeholder="Email">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Địa chỉ</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="post[address]" required placeholder="Địa chỉ">
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Chuyên mục</label>
    <select class="form-control" name="id_danhmuc">
	
	</select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Câu hỏi</label>
    <textarea  class="form-control" placeholder="Nội dung câu hỏi" name="post[content]" required min-length="100" style="min-height:100px"></textarea>
  </div>
  
  <button type="submit" class="btn btn-default btn-info">Gửi câu hỏi</button>
</form>

      </div>
    </div>
	</div>
	<div class='clearfix'></div>
	</div>
	<div class="inbox-question">
		<?php 
			foreach($tintuc as $k=>$v){
				echo '<div class="item-question">';
					echo '<div class="q">';
						echo $v['content'];
					echo '</div>';
					echo '<div class="a">';
						echo '<div class="info">';
							echo '<p>Họ tên: <strong>'.$v['ten'].'</strong></p>';
							echo '<p>Email: <strong>'.$v['email'].'</strong></p>';
							echo '<p>Địa chỉ: <strong>'.$v['address'].'</strong></p>';
						echo '</div>';
						echo $v['reply'];
					echo '</div>';
				echo '</div>';
				
				
				
			}
		
		?>
	
	</div>
	<?=$paging['paging']?>
</div>
<script>
	$().ready(function(){
		$(".item-question").click(function(){
			$(this).find(".a").slideToggle();
		})
		$(".btn-show-form").click(function(){
			$(".from.question").slideToggle();
			return false;
		})
		if('<?=$_GET['act']?>' == 'active'){
			$(".btn-show-form").click();
		}
		$("#from-post").submit(function(){
			$.post("dat-cau-hoi.html",$(this).serialize(),function(data){
				console.log(data);
				alert("Gửi câu hỏi thành công! Chúng tôi sẽ trả lời trong thời gian sớm nhất. Xin cám ơn!");
				$("#from-post input,#from-post textarea").val("");
			})
			return false;
		})
	})

</script>