<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define('_table','permission_group');
switch($act){
	case "man":
		
		$template = "permission/man";
		break;
	
	case 'ediable':
		 initEdit();
		 break;
	default:
		$template = "index";
}

function initEdit(){
	
	global $d;
	if(isAjaxRequest()){
	
		$name = $_POST['name'];
		$d->setTable("permission_group");
		$d->setWhere("id",$_POST['id']);
		$d->update(array("name"=>$_POST['name']));
	}
	$input = filter_input_array(INPUT_POST);
	echo json_encode($input);
	die;
}


	
