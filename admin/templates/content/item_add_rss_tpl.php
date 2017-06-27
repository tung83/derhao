<script src="media/queue/src/jQuery.ajaxQueue.js" type="text/javascript"></script>
<div class="box-header with-border">
<h3>Rss</h3>
</div>
<div class="box-body">
<div>
<?php
	$ar['24h.com.vn'] = array(array("name"=>"Tin tức trong ngày","url"=>"http://www.24h.com.vn/upload/rss/tintuctrongngay.rss"),
					   array("name"=>"An ninh hình sự","url"=>"http://www.24h.com.vn/upload/rss/anninhhinhsu.rss"),
					   array("name"=>"Thời trang hitech","url"=>"http://www.24h.com.vn/upload/rss/thoitranghitech.rss"),
					   array("name"=>"Thời trang","url"=>"http://www.24h.com.vn/upload/rss/thoitrang.rss"),
					   array("name"=>"Bóng đá","url"=>"http://www.24h.com.vn/upload/rss/bongda.rss"),
					   array("name"=>"Giài trí","url"=>"http://www.24h.com.vn/upload/rss/giaitri.rss"),
					   array("name"=>"Sức khỏe đời sống","url"=>"http://www.24h.com.vn/upload/rss/suckhoedoisong.rss"),
	
	
						);
	$ar['ngoisao.net'] = array(array("name"=>"Phong cách","url"=>"http://ngoisao.net/rss/phong-cach.rss"),
					   array("name"=>" Khỏe đẹp","url"=>"http://ngoisao.net/rss/khoe-dep.rss"),
					   array("name"=>" Thời trang","url"=>"http://ngoisao.net/rss/thoi-trang.rss"),
					   array("name"=>" Làm đẹp","url"=>"http://ngoisao.net/rss/lam-dep.rss"),
					   array("name"=>"Miss","url"=>"http://ngoisao.net/rss/miss.rss"),
					   array("name"=>"Cô dâu","url"=>"http://ngoisao.net/rss/co-dau.rss"),
					
						);					
						
	foreach($ar as $k=>$v){
		?>
		
		<div class="col-xs-4">
		<div class="form-group">
		<label><?=$k?>:</label>
			<?php foreach($v as $k2=>$v2){
					echo '<p><a class="add-list" data-type="'.$k.'" href="'.$v2['url'].'">'.$v2['name'].'</a></p>';
				
				}	
			?>
			
			<p></p>
		
	  </div>
	  </div>
	  <?php 
	}					

?>
<div class="clearfix"></div>
</div>
<table class="table table-bordered hide" id="tbl">
	<thead>
		<th>#</th>
		<th>Hình ảnh</th>
		<th>Tên</th>
		<th>Trạng thái</th>
	</thead>
	<tbody>
	</tbody>
	
</table>

<button class=" btn btn-success" id="get-item">LẤY TIN</button>
<div id="contentrss">
</div>
<script>
$().ready(function(){
	
	$("#get-item").click(function(){
		$("#tbl tr").each(function(){	
			
			var $obj = $(this);
			
		if($obj.find("a").length){
		jQuery.ajaxQueue({
			url:base_url+"/admin/index.php?com=<?=$_GET['com']?>&act=rss&method=get-item&type=<?=$_GET['type']?>",
			data:{type2:$obj.data("type"),"url":$obj.find("a").attr("href"),'image':$obj.find("img").attr("src"),"name":$obj.find("a").html()},
			type:'post',
			dataType: "json",
			beforeSend:function(){
				$obj.addClass("is-process");
				$("tr.is-process").find("td").last().addClass("orange").html("Đang xử lý");
				
			},
			
		}).done(function( data ) {
			$obj = $("tr.is-process");
			$obj.find("td").last().attr("class","");
			$obj.find("td").last().addClass(data.cls).html(data.stt);
			
			
			//console.log(data);
		});
		}
		})
		
		return false;
	})
	$(".add-list").click(function(){
		$("#tbl tbody").empty();
		$.ajax({
			url:base_url+"/admin/index.php?com=<?=$_GET['com']?>&act=rss&method=getlist",
			type:'get',
			data:{url:$(this).attr("href"),type:$(this).data("type")},
			success:function(data){
				
				$jdata = $.parseJSON(data);
				$.each($jdata,function(i,item){
					//console.log(item);
					$content = "<tr data-type='"+item.host+"'><td>"+i+"</td><td><img width=50 src='"+item.image+"' /></td><td><a href='"+item.link+"'>"+item.name+"</a></td><td>Đang chờ</td></tr>";
					$("#tbl tbody").append($content);
					$("#tbl").removeClass("hide");
				})
				return false;
			}
		})
		return false;
	})
	
	
})
</script>
<style>
.red{color:red}
.green{color:green}
.orange{color:orange}
</style>
</div>