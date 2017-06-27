<table class="table table-bordered" id="table-edit">
	<?php 
		$d->query("select * from #_permission_group");
		foreach($d->result_array() as $k=>$v){
		?>
			<tr>
				<td><?=$v['id']?></td>		
				<td><?=$v['name']?></td>		
			</tr>
		
		<?php 
		}
	
	
	?>

</table>

<script>
$().ready(function(){
	$('#table-edit').Tabledit({
    url: 'index.php?com=<?=$_GET['com']?>&act=ediable',
    columns: {
        identifier: [0, 'id'],
        editable: [[1, 'name']]
    },
    onDraw: function() {
        console.log('onDraw()');
    },
    onSuccess: function(data, textStatus, jqXHR) {
        console.log('onSuccess(data, textStatus, jqXHR)');
        console.log(data);
        console.log(textStatus);
        console.log(jqXHR);
    },
    onFail: function(jqXHR, textStatus, errorThrown) {
        console.log('onFail(jqXHR, textStatus, errorThrown)');
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    },
    onAlways: function() {
        console.log('onAlways()');
    },
    onAjax: function(action, serialize) {
        console.log('onAjax(action, serialize)');
        console.log(action);
        console.log(serialize);
    }
});
})

</script>
<form id="xform">
	<div class="form-group">
    <label for="exampleInputEmail1">Group</label>
    <select class="form-control" name="per[xgroup]">
	<?php 
		$d->query("select * from #_permission_group order by id desc");
		
		foreach($d->result_array() as $k=>$v){
			echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';
			
		}
	
	
	?>
</select>
  </div>
	<div class="form-group">
    <label for="exampleInputEmail1">Tên</label>
    <input type="text" name="per[name]" class="form-control" id="exampleInputEmail1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Com</label>
    <input type="text" name="per[xcom]" class="form-control" id="exampleInputPassword1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Act</label>
    <input type="text" name="per[xact]" class="form-control" id="exampleInputPassword1" placeholder="">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Xid</label>
    <input type="text" name="per[xid]" class="form-control xid" id="exampleInputPassword1" placeholder="">
  </div>
  <button type="submit">Save</button>
  <div id="permission">
  
  </div>


  <script>
	$("#xform").submit(function(){
		$.post("index.php",$(this).serialize(),function(data){
			console.log(data);
			$(".xid").val("");
			$("#permission").html(data);
		})
		return false;
	})
  
  </script>