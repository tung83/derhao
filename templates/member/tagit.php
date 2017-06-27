  <script src="assets/tagit/demo/js/jquery-ui-1.9.2.min.js"></script>
  <script src="assets/tagit/js/tagit.js"></script>
  
  <link rel="stylesheet" type="text/css" href="assets/tagit/demo/css/jquery-ui-base-1.8.20.css">
  <link rel="stylesheet" type="text/css" href="assets/tagit/css/tagit-stylish-yellow.css">
  
  <?php
	$d->query("select * from #_tag");
	$rs = $d->result_array();
	$fix_rs = array();
	foreach($rs as $k=>$v){
	
		$fix_rs[] = $v['name'];
	
	}
	
	
  
  
  ?>
  
  <script>
  function initTag(availableTags){
	console.log(availableTags);
	$('#tagxx').tagit({tagSource:availableTags, itemName: 'item',
                fieldName: 'tags[]', select:true, sortable:true,allowSpaces:true,
		 beforeTagAdded: function(event, ui) {
			
				console.log(ui.tag);
			},
			 afterTagAdded: function(evt, ui) {
                    if (!ui.duringInitialization) {
                        
						if(!inArray(ui.tagLabel,availableTags)){
							 $.post("thanh-vien/addtag.html",{"name":ui.tagLabel},function(data){
									availableTags = $.parseJSON(data);									
							 })
						}
                       
                            
					}	
					
						return false;
                
                          
                    }
                }
	  
	  
	  );
  
  }
  $(function () {
	  var availableTags = <?=json_encode($fix_rs)?>;
	  
			initTag(availableTags);
	  
	  
	  })
	  function inArray(needle, haystack) {
			var length = haystack.length;
			for(var i = 0; i < length; i++) {
				if(haystack[i] == needle) return true;
			}
			return false;
		}
		$().ready(function(){
			$("#form-submit").submit(function(){
				
				showTags();
				
			
			})
		
		})
		

	 </script>
	  <ul id="tagxx">
	 <?php
		if(isset($_GET['id'])){
			$d->query("select * from #_tag_post where post_id = ".$_GET['id']);
			foreach($d->result_array() as $k=>$v){
			
				echo '<li>'.$v['tag'].'</li>';
			}
		}
	 ?>
	 
	  </ul>
	  
	  <style>
	  ul.tagit li.tagit-choice{
		background: #4ED681;
border-radius: 0;
color: #fff;
	  }	
	  .ui-icon.ui-icon-close{display:none}
	  
	  </style>