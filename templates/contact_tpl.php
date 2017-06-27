<div class="container-fluid">
	<div class="row">
		
	
	<!---------------->
	<div class="clearfix"></div>
	<link href="assets/css/lienhe.css" type="text/css" rel="stylesheet" />
<link href="assets/css/map.css" type="text/css" rel="stylesheet" />
	<section id="contact" style="">	
			
			
				<div class="">
			
			<div class="col-xs-12 col-md-3 col-sm-6 info-logo">
				
				<a href="" title="<?=$rs_hotline['ten_'.$lang]?>" >
					<img src="<?=_upload_hinhanh_l.$rs_hotline['logo']?>" class="img-responsive" />
				</a>
		
			
			</div>
			<div class="col-xs-12 col-md-4 col-sm-6">
			<div class="company-name"><h2 class="aleft"><?=$rs_hotline['ten_'.$lang]?></h2><div class="clearfix"></div></div>
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
			
			<div class="col-xs-12 col-md-5 col-sm-12">
				<div class="title-contact"><h2><?=_fromlienhe?></h2><div class="clearfix"></div></div>
				<?php 
					if(isset($error)){
						echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
					}
				
				
				?>
            <form method="post" name="frm" action="" class="form-horizontal">
				
				<div class="">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 col-xs-12 control-label"><?=_name?></label>
						<div class="col-sm-8 col-xs-12">
						  <input name="name" type="text" required class="form-control" id="name" value="<?=$_POST['name']?>" placeholder="" size="40" />
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 col-xs-12 control-label"><?=_tel?></label>
						<div class="col-sm-8 col-xs-12">
						  <input name="phone" id="phone" type="text" required class="form-control" value="<?=$_POST['phone']?>"  size="40"  />
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 col-xs-12 control-label"><?=_email?></label>
						<div class="col-sm-8 col-xs-12">
						  <input name="email" id="email" type="text" required class="form-control" value="<?=$_POST['email']?>"  size="40"  />
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 col-xs-12 control-label"><?=_message?></label>
						<div class="col-sm-8 col-xs-12">
						  <textarea name="content" cols="35"   class="form-control" rows="5"  id="content" style="background-color:#FFFFFF; color:#666666;"><?=$_POST['content']?></textarea>
						</div>
					</div>
                    
					<div class="form-group">
						
						<div class="col-xs-12 col-sm-11 btn-form">
								<input class="btn btn-default" type="button" value="Reset" onclick="document.frm.reset();" />
								<input class="btn btn-default" type="submit" value="Send" onclick="" />
						</div>
						<div class="clearfix"></div>
					</div>
                       
                       
					
                       
                    
						
						<div class="clearfix"></div>
						
                             
                                                       
                            </div>                             
                       
	             </form>
                </div>
				<div class="clearfix"></div>
					</div>
					
				</section>
	
	
	</div>


</div>
