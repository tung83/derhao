<link href="assets/css/member/style.css" type="text/css" rel="stylesheet">
<div class="main-member-place">
	<div class="title"><h2>TIN CHƯA DƯỢC DUYỆT</h2></div>
	<div class="content">
		<?php
			
		if(count($posts) > 0){
			echo '<table class="table table-bordered" >';
			echo '<thead><th width=5%>STT</th><th width=20%>Tiêu đề tin</th><th width=10%>Ngày đăng</th><th width=10%>Ngày cập nhật</th><th width=10%>Công cụ</th></thead>';
			foreach($posts as $k=>$v){
				echo '<tr>';
				
				echo '<td>'.($k+1).'</td><td><a href="thanh-vien/chinh-sua/'.$v['id'].'/'.changeTitle($v['title']).'">'.$v['title'].'</a></td><td>'.date("d-m-Y",$v['ngaytao']).'</td><td>'.date("d-m-Y",((@$v['ngaysua']) ? $v['ngaysua'] : $v['ngaytao'])).'</td><td style="text-align:center"><a href="thanh-vien/chinh-sua/'.$v['id'].'/'.changeTitle($v['title']).'.html"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="thanh-vien/chinh-sua/'.$v['id'].'/'.changeTitle($v['title']).'.html"><i class=" red glyphicon glyphicon-remove"></i></a></td>';
				echo '</tr>';
			
			}
			
			
			echo '</table>';
		}
		?>
	</div>
</div>	

<?php
	

?>
