<div class="tab-pane  " id="tag" >
<script src="assets/plugins/tagator-master/jquery-1.11.0.min.js"></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script src="assets/plugins/tagator-master/jquery.caret.min.js"></script>
<script src="assets/plugins/tagator-master/jquery.tag-editor.min.js"></script>
<link href="assets/plugins/tagator-master/jquery.tag-editor.css" type="text/css" rel="stylesheet" />

<script>
$().ready(function(){

					$('#demo4').tagEditor({
						 autocomplete: {
								delay: 0, // show suggestions immediately
								position: { collision: 'flip' }, // automatic menu position up/down
								source: <?php $d->query("select ten_vi from #_tag");
							$x = array();
							foreach($d->result_array() as $k=>$v){
								$x[] = $v['ten_vi'];
							}
							echo json_encode($x);
							?>
							},
							forceLowercase: false,
						
						
						
						initialTags: <?php
							/*$d->query("select type from #_tag_content where `table` = '".$_GET['com']."' and id_baiviet = ".$item['id']);
							$x = array();
							foreach($d->result_array() as $k=>$v){
								$x[] = $v['type'];
								
							}
							*/
							$x = array();
							echo json_encode($x);
						
						?>
						,
							
						placeholder: 'Enter tags ...',
						onChange: function(field, editor, tags) {
							//console.log('change');
						},
						beforeTagSave: function(field, editor, tags, tag, val) {
							
							
							$.ajax({
								url:"index.php?com=tag&act=add_ajax",
								data:{tag:val,xcom:'<?=$_GET['com']?>',id:<?=$item['id']?>},
								type:'post',
								success:function(data){
									console.log(data);
								}
								
							})
						},
						
						beforeTagDelete: function(field, editor, tags, val) {
							console.log('delete');
						}
					});
					
					
					
					
					
					
					
					
					
					
})
</script>				
 <br />
	<b>Tag bài viết</b>
    <div>
       <textarea id="demo4" name="hash_tag"></textarea>
    </div>	
</div>
