 <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="assets/img/user.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Hello <?=$admin->getLoginName()?></p>
			  <a href="index.php?com=user&act=logout"><i class="fa fa-circle text-error"></i> Thoát</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
			 <li class="">
			
              <a href="../index.php" target="_blank">
                <i class="fa fa-circle-o text-yellow"></i> <span>Website</span>
              </a>
             
            </li>
            <li class="">
			
              <a href="index.php">
                <i class="fa fa-circle-o text-yellow"></i> <span>Admin</span>
              </a>
             
            </li>
            

            
			 <li class="treeview ">
              <a href="#">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Thuộc tính</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Loại","product_size","man_danhmuc","","type=fabric&content=0&desc=0&img=0&title=0")?>
					
					<?=$admin->showMenu("Quản lý thuộc tính","product_size","man","","type=fabric&new=1&gallery=1&class=1&img=1&desc=1&content=1&title=1")?>
					
              </ul>
            </li>
			
			 <li class="treeview ">
              <a href="#">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Vải</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Quản lý danh mục cấp 1","product","man_danhmuc","","type=fabric&content=0&desc=0&img=0&title=0")?>
					
					<?=$admin->showMenu("Quản lý sản phẩm","product","man","","type=fabric&new=1&gallery=1&class=1&img=1&desc=1&content=1&title=1")?>
					
              </ul>
            </li>
			 <li class="treeview ">
              <a href="#">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Sản phẩm</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Quản lý danh mục cấp 1","product","man_danhmuc","","type=product&content=0&desc=0&img=0&title=0")?>
					
					<?=$admin->showMenu("Quản lý sản phẩm","product","man","","type=product&new=1&gallery=1&class=1&img=1&desc=1&content=1&title=1")?>
					
              </ul>
            </li>
			
			 <li class="treeview ">
              <a href="#">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Tin tức</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Quản lý danh mục cấp 1","product","man_danhmuc","","type=instock&content=0&desc=0&img=0&title=0")?>
					
					<?=$admin->showMenu("Quản lý tin tức","product","man","","type=instock&new=1&gallery=1&class=1&img=1&desc=1&content=1&title=1")?>
					
              </ul>
            </li>
			<li class="treeview ">
              <a href="#">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Download</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Quản lý danh mục cấp 1","content","man_danhmuc","","type=download&content=0&desc=0&img=0&title=1")?>
					
					<?=$admin->showMenu("Quản lý Download","content","man","","type=download&new=1&gallery=1&class=1&img=0&desc=0&content=0&title=1")?>
					
              </ul>
            </li>
			
			
						<li class="treeview hide">
              <a href="#">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Đơn hàng</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Quản lý đơn hàng","order","man")?>
					<?=$admin->showMenu("Hình thức thanh toán","hinhthucthanhtoan","man")?>
					<?=$admin->showMenu("Hình thức vận chuyển","hinhthucvanchuyen","man")?>
              </ul>
            </li>
			
			<li class="treeview ">
              <a href="#">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Where to buy</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Quản lý chi nhánh","index","man")?>
					
              </ul>
            </li>
			
			
			
			<li class="treeview">
              <a href="#">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Bài viết</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Triển lãm","content","man","","type=trienlam&class=0&gallery=1&title=1&desc=1&img=1&content=1")?>
					<?php $admin->showMenu("Trang chủ","index","man")?>
					
					<?=$admin->showMenu("Giới thiệu ","baiviet","edit","1","gallery=0&title=1&desc=1&img=0&content=1")?>
					<?=$admin->showMenu("Giới thiệu footer","baiviet","edit","2","gallery=0&title=1&desc=1&img=0&content=0")?>
					<?php $admin->showMenu("Tuyển dụng","baiviet","edit","2","gallery=0&title=1&desc=0&img=0&content=1")?>
					
					
              </ul>
            </li>
			
			
			
			
			
			
			
			
			
			
			<li class="treeview active">
              <a href="javascript:void(0)">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Media</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Banner","bannerqc","man")?>
					<?=$admin->showMenu("Slider","slider","man_photo","","type=slider")?>
					<?=$admin->showMenu("Slider about","slider","man_photo","","type=about")?>
					<?=$admin->showMenu("Slider fabric","slider","man_photo","","type=fabric")?>
					<?=$admin->showMenu("Slider product","slider","man_photo","","type=product")?>
					<?=$admin->showMenu("Slider promotion","slider","man_photo","","type=instock")?>
					<?=$admin->showMenu("Giải thưởng","slider","man_photo","","type=award")?>
					<?=$admin->showMenu("Logo đối tác","doitac","man_photo","","type=slider")?>
					
					<?php $admin->showMenu("Video","video","man")?>
					<?php $admin->showMenu("Background","background","man")?>
              </ul>
            </li>
			
			<li class="treeview active">
              <a href="javascript:void(0)">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Hình đại diện</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Hình trang chủ ","baiviet","edit","7","gallery=0&title=1&desc=0&img=1&content=0")?>
					<?=$admin->showMenu("Hình giới thiệu ","baiviet","edit","13","gallery=0&title=1&desc=0&img=1&content=0")?>
					<?=$admin->showMenu("Hình vải ","baiviet","edit","14","gallery=0&title=1&desc=0&img=1&content=0")?>
					<?=$admin->showMenu("Hình sản phẩm ","baiviet","edit","15","gallery=0&title=1&desc=0&img=1&content=0")?>
					<?=$admin->showMenu("Hình promotion ","baiviet","edit","16","gallery=0&title=1&desc=0&img=1&content=0")?>
				
              </ul>
            </li>
			
			<li class="treeview active">
              <a href="javascript:void(0)">
                <i class="fa fa-circle-o text-yellow"></i>
                <span>Nội dung khác</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<?=$admin->showMenu("Quản Lý Thành viên","member","man")?>
					
					<?=$admin->showMenu("Email","newsletter","man")?>
					
					<?=$admin->showMenu("Hỗ trợ trực tuyến","yahoo","man")?>
					<?=$admin->showMenu("Cập nhật mạng xã hội","social","man")?>
					<?=$admin->showMenu("Cập nhật thông tin công ty","hotline","capnhat")?>
					
					
					<?=$admin->showMenu("Quản lý meta","meta","capnhat")?>
					<?=$admin->showMenu("Quản lý thông tin liên hệ","lienhe","capnhat")?>
					<?=$admin->showMenu("Cấu hình","setting","capnhat")?>
					<?=$admin->showMenu("Thông tin footer","footer","capnhat")?>
					<?=$admin->showMenu("Thông tin tài khoản","user","admin_edit")?>
              </ul>
            </li>
			
			
          </ul>
        </section>
		<script>
		function  gup( name, url ) {
		  if (!url) url = location.href
		  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
		  var regexS = "[\\?&]"+name+"=([^&#]*)";
		  var regex = new RegExp( regexS );
		  var results = regex.exec( url );
		  return results == null ? null : results[1];
		}
		$().ready(function(){
			$(".sidebar-menu li.treeview").each(function(){
				
				$obj = $(this);
				$link = $(this).find("a").first();
				if($obj.find("ul").length){
					
					$link = $obj.find("ul").find("a").first();
				}
				/*
				if($link.attr("href").length > 10){
					$com = gup( "com", $link.attr("href"));
					$type = gup( "type", $link.attr("href"));
					
					if($com=="<?=$_GET['com']?>"){
						if($type){
							if($type=="<?=$_GET['type']?>"){
								$obj.addClass("active");
							}
						}else{
							$obj.addClass("active");
						}
					}
				}
				*/
			})
		})
	</script>