<div class="container-fluid">
<div class="row">
	<div class="kap">
		<div id="xmap">
		<div class="overlay"></div>
		<div id="map" style="height:100%"></div>
		</div>
		</div>
		
		<script type="text/javascript">
      var script = '<script type="text/javascript" src="assets/js/infobubble.js"><' + '/script>';
      document.write(script);
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	
	
		<div class="map-foot">
			<div class="">
			<form class="form-inline">
			
			<div class="col-xs-12 col-sm-12 left-foot hidden-lg mini-title-ob" >
				<div class="title">
				<?=_hethong_derhao_textile?>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-sm-6 left-foot">
			<div class="">
			<div class="part hidden-xs hidden-sm hidden-md">
			<div class="title">
				<?=_hethong_derhao_textile?>
			</div>
			</div>
		
			<div class="content-selectbox part part-1">
				<label>&nbsp;<?=_tinhthanh?></label>
				<select class="form-control" id="province-list">
					<?php 
						$nb_x = 0;
						$d->query("select id_province,noibat from #_index where hienthi = 1  group by id_province order by id_province");
						$_ar = array();
						$_arp[] = 0;
						foreach($d->result_array() as $k=>$v){
							$_ar[] = $v['id_province'];
							if($v['noibat']){
								$nb_x = $v['id_province'];
							}
						}
						$d->query("select provinceid,name from #_province where provinceid in (".implode(",",$_ar).")");
						$nb_object  = $d->result_array();
						foreach($nb_object as $k=>$v){
							if($v['provinceid']==$nb_x){
								$slt = "selected";
							}
							echo '<option value="'.$v['provinceid'].'" '.$slt.' >'.$v['name'].'</option>';
						}
					?>
					
					
					
				</select>
			
			</div>
			<div class="clearfix"></div>
			</div>
			</div>
			
			
			<?php 
					
						$d->query("select id_district from #_index where hienthi = 1  group by id_district order by id_district");
						$_ar = array();
						$_arp[] = 0;
						
						foreach($d->result_array() as $k=>$v){
							$_ar[] = $v['id_district'];
							
						}
						echo '<script>';
						$d->query("select provinceid,districtid,type,name from #_district where districtid in (".implode(",",$_ar).")");
						$_arp[] = array();
						foreach($d->result_array() as $k=>$v){
							$v['name'] = $v['type']." " .$v['name'];
							$_arp[$v['provinceid']][] = $v;
						}
						
						foreach($_arp as $k=>$v){
							if(is_array($v) & count($v) > 0){
							echo 'var _provide_'.$k.' = '.json_encode($v).';';
							}
						}
						echo '</script>';
						
					?>
			<div class="col-xs-12 col-md-6 col-sm-6 right-foot">
			<div class="">
			<div class="content-selectbox">
				<label><?=_quanhuyen?></label>
				<select class="form-control" id="district-list">
					<option value="0"><?=_all?></option>
				</select>
			
			</div>
			</div>
			</div>
			</form>
			
			
			
			<script>

					
					
					 var map, infoBubble;
                        var markersArray = [];
						var infoArray = [];
						var marker;
						
						var total_marker  = new Array();
						$.post("ajax/get-location.html",function(data){
							total_marker  = $.parseJSON(data);
							
							$(".view-marker").click(function(){
								$id = $(this).data("id");
								var target_item = new Array();
								//initMap(point,locations);
								$.each(total_marker,function(index,item){
										console.log(item);
										if(item.id==$id){
											target_item = item;
										}
								})
								
								var latitude = target_item[1];
								var longitude = target_item[2];
								var point = new google.maps.LatLng(latitude,longitude);
								
								//console.log(data);
								initMap3(point,target_item);
								return false;
						})
							
							
							
								
						})
        function initMap(point,locations)
                        {
							console.log(locations);
							xvar = new Array();
                            //var latlng = new google.maps.LatLng(10.8036305527031,106.670928957174);
							var latlng = point;
                            var myOptions = {
                                zoom: 10,
                                center: latlng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };
							
                            map = new google.maps.Map(document.getElementById("map"), myOptions);
							
							

							
                            for (i = 0; i < locations.length; i++) {

								var image = base_url+'/assets/img/maker.png';
								marker = new google.maps.Marker({
									position: new google.maps.LatLng(locations[i][1], locations[i][2]), 
									map: map,
									icon: image
								});
						
								google.maps.event.addListener(marker, 'click', (function (marker, i) {
									return function () {
										//infowindow.setContent(locations[i][0]);
										//infowindow.open(map, marker);
										deleteInfo();
										var height = 0;
										if (locations[i][0].indexOf("img")>0)
											height = 320;
										else height = 150;
										
										infoBubble = new InfoBubble({
										  map: map,
										  minWidth: 300,
										  minHeight: height,
										  content: '<div class="map_content" style="width: 260px;">'+locations[i][0]+'<div style="    text-align: right; height: 22px; position: absolute; right: 15px;"><a href="javascript:;" onclick="deleteInfo();"><img src="'+base_url+'/assets/img/map_close.gif" width="22" height="21" /></a></div></div>',
										  shadowStyle: 1,
										  padding: 20,
										  borderRadius: 4,
										  arrowSize: 0,
										  borderWidth: 1,
										  borderColor: '#EEE',
										  disableAutoPan: false,
										  hideCloseButton: true,
										  arrowPosition: 30,
										  backgroundClassName: 'phoney',
										  arrowStyle: 2
										});
										infoArray[i] = infoBubble;
										infoBubble.open(map, marker);
										
										
									}
									
								})(marker, i));
								
								
							
								
							}
						
                        }
						
						
                        function initMap3(point,locations)
                        {
							
							xvar = new Array();
                            //var latlng = new google.maps.LatLng(10.8036305527031,106.670928957174);
							var latlng = point;
                            var myOptions = {
                                zoom: 10,
                                center: latlng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };
							
                            map = new google.maps.Map(document.getElementById("map"), myOptions);
							
							

							
                            

								var image = base_url+'/assets/img/maker.png';
								marker = new google.maps.Marker({
									position: new google.maps.LatLng(locations[1], locations[2]), 
									map: map,
									icon: image
								});
						
						
										//infowindow.setContent(locations[i][0]);
										//infowindow.open(map, marker);
										deleteInfo();
										var height = 0;
										if (locations[0].indexOf("img")>0)
											height = 320;
										else height = 150;
										
										infoBubble = new InfoBubble({
										  map: map,
										  minWidth: 300,
										  minHeight: height,
										  content: '<div class="map_content" style="width: 260px;">'+locations[0]+'<div style="    text-align: right; height: 22px; position: absolute; right: 15px;"><a href="javascript:;" onclick="deleteInfo();"><img src="'+base_url+'/assets/img/map_close.gif" width="22" height="21" /></a></div></div>',
										  shadowStyle: 1,
										  padding: 20,
										  borderRadius: 4,
										  arrowSize: 0,
										  borderWidth: 1,
										  borderColor: '#EEE',
										  disableAutoPan: false,
										  hideCloseButton: true,
										  arrowPosition: 30,
										  backgroundClassName: 'phoney',
										  arrowStyle: 2
										});
										infoArray[i] = infoBubble;
										infoBubble.open(map, marker);
										
										
									
									
							
								
								
							
								
							
						
                        }
						
						
                        function placeMarker(location) {
                            // first remove all markers if there are any
                            //deleteOverlays();
                			var image = base_url+'/assets/img/maker.png';
                            var marker = new google.maps.Marker({
                                position: location, 
                                map: map,
								icon: image
                            });
                
                            // add marker in markers array
                            markersArray.push(marker);
                
                            //map.setCenter(location);

                        }
                
                        // Deletes all markers in the array by removing references to them
                        function deleteOverlays() {
                            if (markersArray) {
                                for (i in markersArray) {
                                    markersArray[i].setMap(null);
                                }
                            markersArray.length = 0;
                            }
                        }
						// Deletes all info window
                        function deleteInfo() {
                            if (infoArray) {
                                for (i in infoArray) {
                                    infoArray[i].close();
                                }
                            	infoArray.length = 0;
                            }
                        }
						
						
						  var marker_point;
						  var infowindow = new google.maps.InfoWindow();
						  						      //marker_point = new google.maps.LatLng(10.800505820355,106.7431050539);					
							  //placeMarker(marker_point);
						  						      //marker_point = new google.maps.LatLng(10.801609755649,106.74728125334);					
							  //placeMarker(marker_point);
						  						      

						$("#province-list").change(function(){
						$id = $(this).val();
						$list = eval("_provide_"+$id);
						$("#district-list option:not(:first)").remove();
						$("#district-list").next().remove();
						$.each($list,function(index,item){
							$("#district-list").append("<option value='"+item.districtid+"'>"+item.name+"</option>");
						})
						$('.map-foot .content-selectbox select').niceSelect();
						
						
						initMapv2();
						
						})
					
					
					
					function initMapv2(){
						
						
						$("#xmap .overlay").fadeIn();
						$p_name = $("#province-list").next().find("li.selected").html();
						$p_id = $("#province-list").next().find("li.selected").attr("data-value");
						
						$d_name = $("#district-list").next().find("li.selected").html();
						$d_id = $("#district-list").next().find("li.selected").attr("data-value");
						
						
						var address = (($d_id > 0) ? $d_name : "") + $p_name + " ,Việt Nam";
						
						var geocoder = new google.maps.Geocoder();

						geocoder.geocode( { 'address': address}, function(results, status) {

						if (status == google.maps.GeocoderStatus.OK) {
							var latitude = results[0].geometry.location.lat();
							var longitude = results[0].geometry.location.lng();
							var point = new google.maps.LatLng(latitude,longitude);
							$.post("ajax/get-location.html",{province:$p_id,district:$d_id},function(data){
								$("#xmap .overlay").fadeOut();
								data = $.parseJSON(data);
								
								initMap(point,data);
							})
							
									
							
							} 
						});
						
						
					}
					
							







							
                    	$(document).ready(function(){
						  
					$("#province-list").trigger("change");
					$("#district-list").change(function(){
						initMapv2();
					})
					
						});
					
				
				
			</script>
			
		
			</div>
			<div class="clearfix"></div>
		</div>
	
	</div>
	<!---------------->
	<div class="">
	<div class="clearfix"></div>
	<link href="assets/css/lienhe.css" type="text/css" rel="stylesheet" />
<link href="assets/css/map.css" type="text/css" rel="stylesheet" />
	<section id="contact" style="">	
			
			
				<div class="row">
			
			
				
				
		
		
			<div class="col-xs-12 col-md-4 col-sm-4">
			
			<div class="company-name"><h2 style="    margin-top: 2px;"><?=$rs_hotline['ten_'.$lang]?></h2><div class="clearfix"></div></div>
			<div class="list-comname">
				<div class=""><i class="fa fa-map-marker"></i>&nbsp;<?=$rs_hotline['diachi_'.$lang]?></div>
			
			</div>
			<div class="list-comname">
				<div class=""><i class="fa fa-phone"></i>&nbsp;Tel: <?=$rs_hotline['dienthoai_'.$lang]?>
				<br />&nbsp;Fax: <?=$rs_hotline['fax_'.$lang]?>
				</div>
			
			</div>
			<div class="list-comname">
				<div class=""><i class="fa fa-envelope"></i>&nbsp;<?=$rs_hotline['email_'.$lang]?></div>
			
			</div>
			</div>
			
			<div class="">
			
			<?php 
				$d->query("select address,phone,active_time,id,ten_$lang,id_type,id_province,id_district from #_index where hienthi = 1 order by stt desc");
				$rs_where = array();
				foreach($d->result_array() as $k=>$v){
					$rs_where[$v['id_type']]['data'][] = $v;
				}
			
				
			
			?>
				<div class="col-xs-12 col-md-8 col-sm-8">
				
					<?php 
						foreach($rs_where as $k2=>$v2){
							
							$slugx = _product_brand;
							if($k2==2){
								
								$slugx = _fabric_brand;
							}
							?>
						
						<div class="innder-table">
						<div class="title">
						<div class="row">
						<div class="col-xs-12 col-md-4 col-sm-12">
						<?=$slugx?>
						</div>
						<div class="col-xs-12 col-md-4 col-sm-6">
						
						<div class="content-selectbox part part-1 mini-part">

							<select class="form-control list_province intialize_list" id="">
								<option value="0" selected><?=_tinhthanh?></option>
								<?php 
							
									
									foreach($nb_object  as $k=>$v){
										
										echo '<option value="'.$v['provinceid'].'"  >'.$v['name'].'</option>';
									}
								?>
								
								
								
							</select>
						
						</div>
						</div>
						
						<div class="col-xs-12 col-md-4 col-sm-6">
						<div class="content-selectbox mini-part">
						
							<select class="form-control list_district intialize_list" >
								<option value="0"><?=_quanhuyen?></option>
							</select>
						
						</div>
						</div>
						</div>
						
						
						
						
						</div>
						
					<table class="table borderless table-fixed2 table-contact hidden-xs hidden-sm">
						<thead>
							<th width="6%">
								<div>
								STT
								</div>
							</th>
							<th width="40%">
								<div>
								<?=_diachi?>
								</div>
							</th>
							<th width="30%">
							<div>
							
								<?=_active_time?>
								</div>
							</th><th width="20%">
							<div>
								<?=_dienthoai?>
							</div>	
							</th>
							
						</thead>
						<tbody>
						<?php 
							
							foreach($v2['data'] as $k=>$v){
								
								$cl = "provin_0 distr_0 provin_".$v['id_province']." distr_".$v['id_district'];
									
								if($k > 2){
								//	$cl = "";
								}
								?>
								
								<tr class="<?=$cl?>">
									<td>
									<div>
										<?=($k+1)?>&nbsp;
										</div>
									</td>	
									<td>
									<div>
									<strong style="display:block;"><a class="view-marker" data-id="<?=$v['id']?>" href=""><?=$v['ten_'.$lang]?></a></strong>
									<?=$v['address']?>&nbsp;
									
									</div>
									</td>
									<td>
									<div>
										<?=$v['active_time']?>&nbsp;
										</div>
									</td>
									<td>
									<div>
										<?=$v['phone']?>&nbsp;
										</div>
									</td>
									
								
								</tr>
								
								<?php 
							}
						
						?>
						
									
									
								
					
					
					</table>
					
					
					
					
					
					
					
					
					<table class="table borderless table-fixed2 table-contact visible-xs visible-sm">
						
						<tbody>
						<?php 
							
							foreach($v2['data'] as $k=>$v){
								$cl = " provin_0 distr_0 provin_".$v['id_province']." distr_".$v['id_district'];
									
								if($k > 2){
								
								}
								?>
								
								<tr class="<?=$cl?>">
									<td width="10%">
									<div class="line">
										<b><?=($k+1)?>&nbsp;</b>
										</div>
									</td>	
									<td width="90%">
									<div>
									<div class='line'><?=_address?></div>
									<strong style="display:block;"><a class="view-marker" data-id="<?=$v['id']?>" href=""><?=$v['ten_'.$lang]?></a></strong>
									<?=$v['address']?>&nbsp;
									
									</div>
									
									<div>
									<div class='line'><?=_active_time?></div>
									<?=$v['active_time']?>&nbsp;
									</div>
									
									<div>
									<div class='line'><?=_dienthoai?></div>
									<?=$v['phone']?>&nbsp;
									</div>
									
									</td>
									
									
								
								</tr>
								
								<?php 
							}
						
						?>
						
									
									
								
					
					</table>
					
					
						
					
					
					
					
					
					
					
					
					<!-- <div class="m-view-more"><a href=""><?=_xemthem?></a></div> -->
				</div>
				<?php } ?>
				
				
				
				
				</div>
			
			
			
			</div>
			
			
				<div class="clearfix"></div>
					</div>
					
				</section>
	
	
	</div>
	</div>


<script src="assets/plugins/nice-select/js/jquery.nice-select.min.js"></script>
<link href="assets/plugins/nice-select/css/nice-select.css" type="text/css" rel="stylesheet" />
<script>


$(document).ready(function() {
	
	
	
$(".list_province").each(function(){
	$(this).change(function(){
		$id = $(this).val();
		$root = $(this).parents(".innder-table");
		$line = $root.find("tbody tr");
	//	alert(parseInt($(this).val()));
		$target1 = $root.find(".provin_"+parseInt($(this).val()));
		$line.addClass("x-visible");
		$target1.removeClass("x-visible");
		
		
		$list_2 = $(this).parent().parent().next().find(".intialize_list");
		
		$list = eval("_provide_"+$id);
		$list_2.find("option:not(:first)").remove();
		$list_2.next().remove();
		$.each($list,function(index,item){
			$list_2.append("<option value='"+item.districtid+"'>"+item.name+"</option>");
		})
		$list_2.niceSelect();
		
		
	})
	
})
$(".list_district").each(function(){
	$(this).change(function(){
		$id = $(this).val();
		$root = $(this).parents(".innder-table");
		$line = $root.find("tbody tr");
		
		$target1 = $root.find(".distr_"+parseInt($(this).val()));
		$line.addClass("x-visible");
		$target1.removeClass("x-visible");
	
		
		
	})
	
})
	
	

  $('.map-foot .content-selectbox select,.intialize_list').niceSelect();
  
 
	$(".m-view-more a").click(function(){
		$target = $(this).parents(".innder-table").find(".x-visible");
		
		
		
		
		if(!$(this).hasClass("show")){
			$target.show();
			$(this).addClass("show");
			$(this).html("<?=_thugon?>");
		}else{
			$target.hide();
			$(this).removeClass("show");
			$(this).html("<?=_xemthem?>");
		}
		return false;
	})

  
});
</script>

