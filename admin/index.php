<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$login_name = $config['md5'];
	
	$d = new database($config['database']);
	
	if(isset($_SESSION[$login_name])){
		if(isset($_SESSION[$login_name]['role'])){
		include_once _lib."admin.php";	
		$admin = new admin($d,$_SESSION[$login_name]['id'],$_SESSION[$login_name]['role'],$login_name);
		$access = array("admin_edit","save","logout");
		if(!$admin->checkPermission() & !in_array($_GET['act'],$access)){
			transfer("Truy cập bị từ chối", "index.php");
		}
		}else{
			unset($_SESSION[$login_name]);
		}
	}
	if(isAjaxRequest() & isset($_REQUEST['get_stt'])){
		$table=$_GET['com'];
		$sarray = array("danhmuc","list","cat");
		foreach($sarray as $k){
			if(strpos($_GET['act'],$k)){
				$table = $table."_".$k;
			}
		}
		
		if(isset($_GET['save'])){
			check($_REQUEST);
			$id = $_POST['pk'];
			$value = $_POST['value'];
			$d->query("update #_".$table." set stt = ".$value." where id = ".$id);
			
			die;
		}else{
			$d->query("select id from #_".$table." where hienthi = 1 ");
			$tt = $d->num_rows();
			$array_stt = array();
			for($i=1;$i<=$tt;$i++){
				$array_stt[] = $i;
			}
			echo json_encode($array_stt);
			die;
		
		}
		
	}
	
	//check($_SESSION);die;
	if(isAjaxRequest() & isset($_REQUEST['ajax'])){
		$com = $_POST['com'];
		$id = $_POST['id'];
		$type = $_POST['type'];
		$value = $_POST['value'];
		$d->setTable($com);
		$d->setWhere("id",$id);
		$d->update(array($type=>$value));
		echo $d->showSql();
		die;
	}
				
	if(file_exists("sources/".$com.".php")){
		$source = $com;
	}else{
	
	$source = "";
	$template = "index";
	}
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}
	$_SESSION['SCRIPT_FILENAME'] = str_replace("/admin/index.php","",$_SERVER['SCRIPT_FILENAME']);
	$_SESSION['SERVER_FOLDER'] = $config['finder']['folder'];
	$_SESSION['UPLOAD_DIR'] = $config['finder']['dir'];
	$sl_size = array("hotel"=>array("w"=>560,"h"=>"250"),
				"about"=>array("w"=>1349,"h"=>"370"),
				"fabric"=>array("w"=>1349,"h"=>"370"),
				"product"=>array("w"=>1349,"h"=>"370"),
				"instock"=>array("w"=>1349,"h"=>"370"),
				"slider"=>array("w"=>1349,"h"=>510),
				"award"=>array("w"=>200,"h"=>200)
				);
	if($source!="") include _source.$source.".php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NINA | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:500,400italic,700italic,300,700,500italic,300italic,400&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/fonts/myriad-pro/style.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="assets/fonts/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="assets/fonts/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
	<link href="assets/plugins/nprogress-master/nprogress.css" type="text/css" rel="stylesheet" />
	<link href="assets/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
	<link href="assets/nprogress-master/nprogress.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
	<script> var base_url = "<?=$config_url?>";var server_folder = '<?=$config['finder']['folder']?>'; var rel_url = '<?=$relative_url?>';</script>
	 <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body class="skin-blue layout-boxed sidebar-mini">

<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){?>  









 <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>NINA</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>NINA</b> Administrator</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
		<?php include _template."menu_tpl.php";?>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
         
          <ol class="breadcrumb hide">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						 <?php include _template.$template."_tpl.php"?>
					</div>	
				</div>	
			 <div class="clearfix"></div>
			 </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        
       <?php include _template."footer_tpl.php"?>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark hide">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-waring pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->

          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right" />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

   
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/ckeditor/ckeditor.js" type="text/javascript" ></script>
	<script src="assets/ckfinder/ckfinder.js" type="text/javascript" ></script>
	
	
	
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
	<script src="assets/plugins/nprogress-master/nprogress.js" type="text/javascript" ></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/app.min.js" type="text/javascript"></script>

    <!-- SlimScroll 1.3.0 -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="assets/dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js" type="text/javascript"></script>
	<script type="text/javascript" src="assets/bootstrap-switch-master/dist/js/bootstrap-switch.min.js"></script>
    <script src="assets/plugins/fancybox/jquery.fancybox.js" type="text/javascript"></script>
    <script src="assets/dist/js/demo.js" type="text/javascript"></script>
	<script type="text/javascript" src="assets/js/autoNumeric.js"></script>
	<script src="assets/colorpicker/js/bootstrap-colorpicker.min.js" type="text/javascript" ></script>
	
	<script src="assets/js/script.js"></script>





















<?php }else{?>   
				<?php include _template.$template."_tpl.php"?>
		<?php }?>
		<input type="hidden" id="com" value="<?=$_GET['com']?>" />
		<input type="hidden" id="act" value="<?=$_GET['act']?>" />
</body>
</html>
