<link href="assets/css/member/style.css" type="text/css" rel="stylesheet">
<div class="main-member-place">
	<div class="title"><h2>TIN ĐANG HIỂN THỊ</h2></div>
	<div class="content">
		<?php
			
		if(count($posts) > 0){
			echo '<table class="table table-bordered" >';
			echo '<thead><th>STT</th><th>Tiêu đề tin</th><th>Lượt xem</th><th>Ngày hết hạn</th><th>Công cụ</th></thead>';
			foreach($posts as $k=>$v){
				echo '<tr>';
				echo '<td>'.($k+1).'</td><td><a href="thanh-vien/chinh-sua/'.$v['id'].'/'.changeTitle($v['title']).'">'.$v['title'].'</a></td><td>'.$v['luotxem'].'</td>';
				?>
				
				<td style="font-weight:bold">
				
				<?php
			
				$time = $v['ngay_ket_thuc'];
				$now = date("d-m-Y",time());
				if($now > $time){
					echo '<span style="color:red">';
					
				}else{
					echo '<span style="color:green">';
				}
				echo $time;
				echo '</span>';
				
				
						

				?>		
				</td>
				
				<?php
				
				echo '<td style="text-align:center"><a href="thanh-vien/chinh-sua/'.$v['id'].'/'.changeTitle($v['title']).'.html"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="thanh-vien/chinh-sua/'.$v['id'].'/'.changeTitle($v['title']).'.html"><i class=" red glyphicon glyphicon-remove"></i></a></td>';
				echo '</tr>';
			
			}
			
			
			echo '</table>';
		}
		?>
	</div>
</div>	

<?php
	

?>
