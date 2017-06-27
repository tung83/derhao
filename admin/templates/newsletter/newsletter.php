<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "man":
		get_mails();
		$template = "newsletter/items";
		break;
	
	case "add":
		addAbc();
		$template = "newsletter/item_add";
		break;
	
	case "edit":
		get_mail();
		$template = "newsletter/item_add";
		break;	
		
	case "send":
		send();
		break;
	
	case "save":
		save_mail();
		break;	
	
	case "delete":
		delete();
		break;	

		
	default:
		$template = "index";
}
function addAbc(){
	global $d;
	$d->query("select * from #_newsletter where email = '".$_POST['email']."'");
	if($d->num_rows() == 0){
	$d->setTable("newsletter");
	if($d->insert(array("email"=>trim($_POST['email']),"ngaytao"=>time()))){
		$d->query("select * from #_newsletter where email = '".trim($_POST['email'])."'order by id desc limit 1");
		$m = $d->fetch_array();
		$content = '<tr>
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="'.$m['id'].'" class="chon input-sm"></td>		        
        <td style="width:50%;" align="center"><b>'.$m['email'].'</b></td>
		
		<td style="width:5%;"><a href="index.php?com=newsletter&amp;act=delete&amp;id=670" onclick="if(!confirm(""/"Xác nhận xóa""/)) return false;"><img src="media/images/delete.png" border="0"></a></td>
	</tr>';
		$data['content'] =  $content;
		$data['stt'] = 1;
		
	
	}
	}else{
		$data['stt'] = 0;
		$data['msg'] = "Email đã tồn tại";
	
	}
	echo json_encode($data);
	die;
}
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_mails(){
	global $d, $items;

	$sql = "select * from #_newsletter order by id desc";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$items = $d->result_array();
}

function get_mail(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=newsletter&act=man");
	
	$sql = "select * from #_newsletter where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=newsletter&act=man");
	$item = $d->fetch_array();
}

function save_mail(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=newsletter&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		$data['email'] = $_POST['email'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('newsletter');
		$d->setWhere('id', $id);
		if($d->update($data))
				redirect("index.php?com=newsletter&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=newsletter&act=man");
	}else{
		
		
		$data['email'] = $_POST['email'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('newsletter');
		if($d->insert($data))
			redirect("index.php?com=newsletter&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=newsletter&act=man");
	}
}


function delete(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$sql = "delete from #_newsletter where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			redirect("index.php?com=newsletter&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=newsletter&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=newsletter&act=man");
	
		
}


function send(){
	global $d,$config_url;
	$d->query("select * from #_setting");
	$global_setting = $d->fetch_array();
	$file_name= changeTitle($_FILES['file']['name']);
	
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=newsletter&act=man");
	
	if($file = upload_image("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF', _upload_hinhanh,$file_name)){
		$data['file'] = $file;
	}
	
	
	$d->setTable('hotline');
	$d->select();
	$company_mail = $d->fetch_array();
	
	if(isset($_POST['listid'])){
		
		$d->reset();
			$sql = "select email from #_newsletter where id  in (".$_POST['listid'].")";
			$d->query($sql);
			
			$list = array();
			foreach($d->result_array() as $k=>$v){
				$list[]['email'] = $v['email'];
			}
			$t = time();
			$file = null;
			//if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG|pdf|doc|docx|xls|xlsx', _upload_hinhanh,$t))
			if($_FILES['file']['name'])
			{
				
				$file[] =array($_FILES['file']['tmp_name'],$_FILES['file']['name']);
			}
			
			
			if(sendEmail($list[0]['email'], null, null, $_POST['ten'], $_POST['noidung'],$list,$file) ){ 
		
		transfer("Thông tin đã được gửi đi.", "index.php?com=newsletter&act=man");
	}
		else{
		transfer("Hệ thống bị lỗi, xin thử lại sau.", "index.php?com=newsletter&act=man");
		}
	
	}
	
}

?>