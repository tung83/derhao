<script src="media/queue/src/jQuery.ajaxQueue.js" type="text/javascript"></script>
<?php




?>
<table class="table table-bordered hide" id="tbl">
	<thead>
		<th>#</th>
		<th>Hình ảnh/th>
		<th>Tên</th>
		<th>Trạng thái</th>
	</thead>
	<tbody>
	</tbody>
	
</table>

<button id="add-list" class="btn">THÊM TIN</button>&nbsp;<button class=" btn btn-success" id="get-item">LẤY TIN</button>
<div id="contentrss">
</div>
<script>
$().ready(function(){
	
	$("#get-item").click(function(){
		$("#tbl tr").each(function(){	
			
			var $obj = $(this);
			
		if($obj.find("a").length){
		jQuery.ajaxQueue({
			url:base_url+"/admin/index.php?com=news&act=rss&method=get-item",
			data:{"url":$obj.find("a").attr("href"),'image':$obj.find("img").attr("src"),"name":$obj.find("a").html()},
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
	$("#add-list").click(function(){
		$.ajax({
			url:base_url+"/admin/index.php?com=news&act=rss&method=getlist",
			type:'get',
			success:function(data){
				$jdata = $.parseJSON(data);
				$.each($jdata,function(i,item){
					//console.log(item);
					$content = "<tr><td>"+i+"</td><td><img width=50 src='"+item.image+"' /></td><td><a href='"+item.link+"'>"+item.name+"</a></td><td>Đang chờ</td></tr>";
					$("#tbl tbody").append($content);
					$("#tbl").removeClass("hide");
				})
				return false;
			}
		})
		return false;
	})
	$("#add-list").trigger("click");
	$("#add-list").remove();
})
</script>
<style>
.red{color:red}
.green{color:green}
.orange{color:orange}
</style>