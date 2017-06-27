<?php
class admin
{
	public $user_id;
	public $d;
	public $permission;
	public $role;
	private $login_name;
	function __construct($d,$user_id=null,$role=null,$login_name){
		$this->d = $d;
		$this->user_id = $user_id;
		$this->role = $role;
		$this->addPermission();
		$this->login_name = $login_name;
	}
	function getLoginName(){
		return $_SESSION[$this->login_name]['username'];
	}
	function addHistory($id,$type=1){
		$this->d->query("select * from #_user where id = ".$this->user_id);
		$user = $this->d->fetch_array();
		$this->d->query("select * from #_donhang where id = ".$id);
		$cart = $this->d->fetch_array();
		$msg = ($type==1) ? 'xem' : 'cập nhật';
		$str = 'Thành viên: <strong>'.$user['username']."</strong> đã <strong class='red'> ".$msg." </strong> đơn hàng <strong>".$cart['madonhang']."</strong> vào lúc ".date("h:i:s d-m-y",time());
		
		$history = (json_decode($cart['history']));
		
		$history[] = $str;
		
		$this->d->query("update #_donhang set history = '".mysql_real_escape_string(json_encode($history))."' where id = ".$id);
	}	
	function getContentClassDanhmuc($type,$list=true){
		$this->d->query("select id,ten_vi from #_content_danhmuc where type='".$type."' order by stt desc");
		$list_array = $this->d->result_array();
		$ar = array();
		foreach($list_array as $k=>$v){
			$ar[$v['id']] = $v['ten_vi'];
		}
		
		if($list){
			$str = "<select class='form-control'  id='id_danhmuc' name='id_danhmuc' />";
				$str.= '<option value="">Danh mục cấp 1</option>';
				foreach($ar as $k=>$v){
					$slt= '';
					if(($_GET['id_danhmuc'] == $k)){
						$slt = "selected";
					}
					$str.= '<option value="'.$k.'" '.$slt.' >'.$v.'</option>';
				}
			$str.='</select>';
			return $str;
		}
		return $ar;
		
		
	}
	function getContentClassList($type,$list=true,$id_menu=false){
		if($id_menu){
		$this->d->query("select id,ten_vi from #_content_list where type='".$type."' and id_danhmuc = '".$_GET['id_danhmuc']."' order by stt desc");
		}else{
		$this->d->query("select id,ten_vi from #_content_list where type='".$type."' order by stt desc");	
		}
		$list_array = $this->d->result_array();
		$ar = array();
		foreach($list_array as $k=>$v){
			$ar[$v['id']] = $v['ten_vi'];
		}
		if($list){
			$str = "<select class='form-control' id='id_list' name='id_list'/>";
				$str.= '<option value="">Danh mục cấp 2</option>';
				foreach($ar as $k=>$v){
					$slt= '';
					if(($_GET['id_list'] == $k)){
						$slt = "selected";
					}
					$str.= '<option value="'.$k.'" '.$slt.'>'.$v.'</option>';
				}
			$str.='</select>';
			return $str;
		}
		return $ar;
		
		
	}
	/** get list category */
	
	
	
	
	
	
	
	
	
	
	
	function initAdd($table=_table,$cate = false){
		
	global $d,$stt,$cate,$list,$cat;
	if(!isset($_GET['id'])){
		$sql="select * from #_".$table." order by stt desc limit 1";
		$d->query($sql);
		$x = $d->fetch_array();
		$sql = $sql;
		if(isset($x['type'])){
			$sql="select * from #_".$table." where type = '".$_GET['type']."' order by stt desc limit 1";
		}
		$d->query($sql);
		if(!$d->num_rows()){
			$stt = 1;
		}else{
		$r = $d->fetch_array();
		
		$stt = $r['stt']+1;
		}
	}
	$type="";
	if(@$_GET['type']){
			$type = " and type = '".$_GET['type']."'";
		}
	$table = str_replace("_danhmuc","",$table);
	$table = str_replace("_list","",$table);
	$table = str_replace("_cat","",$table);

	$d->query("SHOW TABLES LIKE '#_".$table."_danhmuc'");

	if($d->num_rows()==1){
	
		$sql = "select * from #_".$table."_danhmuc"." where 1 = 1   $type order by stt asc";
		$d->query($sql);
		$rs = $d->result_array();
		$is_list = false;
		$d->reset();
		$d->query("SHOW TABLES LIKE '#_".$table."_list'");
		if($d->num_rows()==1){
			$is_list = true;
		}
		$is_cat = false;
		$d->reset();
		$d->query("SHOW TABLES LIKE '#_".$table."_cat'");
		if($d->num_rows()==1){
			$is_cat = true;
		}
		
		foreach($rs as $k=>$v){
			$cate[$v['id']] = $v['ten_vi'];/* ten_vi la bat buoc */
			if($is_list){
				$sql = "select * from #_".$table."_list where id_danhmuc = ".$v['id']."  $type order by stt asc";
				$d->query($sql);
				$rs_list = $d->result_array();
				$ar_tmp = array();
				foreach($rs_list as $k2=>$v2){
					$ar_tmp[$v2['id']] = $v2['ten_vi'];
					if($is_cat){
						$sql = "select * from #_".$table."_cat where id_list = ".$v2['id']."  $type order by stt asc";
						
						$d->query($sql);
						$rs_cat = $d->result_array();
						$ar_tmp_cat = array();
						foreach($rs_cat as $k3=>$v3){
							$ar_tmp_cat[$v3['id']] = $v3['ten_vi'];
						}
						
						$cat[$v2['id']] = $ar_tmp_cat;
					
						
					}
				}
				$list[$v['id']] = $ar_tmp;
				
				
				
			}
		
		}
	
	}
		

}
	
	
	
	
	
	
	
	
	
	
	
	function getListCategory($item, $lv = 3) {
    //global $cate,$list,$cat;
    global $cate, $list, $cat;
	
    if (count($cate) > 0) {
        $str = '';
        $str2 = '';
        $str3 = '';
        $json = json_encode(array());
        $json2 = $json3 = $json;

        $long = '<div style="margin:0px 0" class="col-sm-12"><div class="form-group"><label for="" class="col-sm-4 control-label">';

        $str = '<select id="id_danhmuc" required  class="form-control col-sm-6 id_danhmuc_chk" name="id_danhmuc"><option value="0">-Chọn danh mục-</option>';
        $check = 0;
        if (isset($item)) {
            $check = $item['id_danhmuc'];
        }
        foreach ($cate as $k => $v) {
            $slt = '';
            if ($k == $check) {
                $slt = 'selected';
            }
            $str.= '<option value="' . $k . '" ' . $slt . '>' . $v . '</option>';
        }
        $title = "Danh mục bài viết";
        if (count($list) > 0) {
            $title = "Danh mục cấp 1";
            $rtitle = "Danh mục cấp 2";
            $json = json_encode($cate);
            $check = 0;
            if (isset($item)) {
                $check = $item['id_list'];
            }
            $json2 = json_encode($list);
            $str2 = '<select required id="id_list" class="form-control col-sm-6 id_list_chk" name="id_list"><option value="0">-Chọn danh mục-</option>';
            if (isset($item)) {

                foreach ($list[$item['id_danhmuc']] as $k => $v) {

                    $slt = '';
                    if ($k == $check) {
                        $slt = 'selected';
                    }

                    $str2.= '<option value="' . $k . '" ' . $slt . '>' . $v . '</option>';
                }
            }

            $str2 = $long . $rtitle . ':</label> <div class="col-sm-6">' . $str2 . '</select></div></div></div>';
            if (@count($cat) > 0) {
                $title = "Danh mục cấp 1";
                $rtitle = "Danh mục cấp 2";
                $r2title = "Danh mục cấp 3";
                $json3 = json_encode($cat);
                $check = 0;


                if (isset($item)) {
                    $check = $item['id_cat'];
                }
                $json3 = json_encode($cat);
                $str3 = '<select id="id_cat" required class="form-control col-sm-6 id_cat_chk" name="id_cat"><option value="0">-Chọn danh mục-</option>';
                if (isset($item)) {

                    foreach ($cat[$item['id_list']] as $k => $v) {

                        $slt = '';
                        if ($k == $check) {
                            $slt = 'selected';
                        }

                        $str3.= '<option value="' . $k . '" ' . $slt . '>' . $v . '</option>';
                    }
                }

                $str3 = $long . $r2title . ':</label> <div class="col-sm-6">' . $str3 . '</select></div></div></div>';
            }
        }




        $str = $long . $title . ':</label> <div class="col-sm-6">' . $str . '</select></div></div></div>';
        if ($lv == 1) {
            return $str;
        } else {
            echo '<script>$().ready(function(){setCategory(' . $json . ',' . $json2 . ',' . $json3 . ');});</script>';
        }
        if ($lv == 2) {



            return $str . $str2;
        }

        if ($lv == 3) {

            return $str . $str2 . $str3;
        }
    }
}
	
	/* end get list category */
	function addPermission(){
	
		$this->d->query("select per.* from #_user_permission uper,#_permission per where id_user = ".$this->user_id." and per.id = uper.id_permission");
		foreach($this->d->result_array() as $k=>$v){
			$this->permission[$v['xcom']][] = $v;
		}
		foreach($this->permission as $k=>$v){
			foreach($v as $k2=>$v2){
				if($v2['xact']=='edit' | $v2['xact']=='add'){
					$v3 = $v2;
					$v3['xact'] = 'save';
					$this->permission[$k][] = $v3;
				}
			}
		}
	}
	public function checkPermission(){
		$role = $_SESSION[$this->login_name]['role'];
		$com = $_GET['com'];
		$act = $_GET['act'];
		$id = @$_GET['id'];
		$role = $_SESSION[$this->login_name]['role'];
		if($role==3 | $com==""){
			return true;
		}
		if(isset($this->permission[$com])){
			foreach($this->permission[$com] as $k=>$v){
				if($v['xact'] == $act | $v['xact']=='all' | (strpos($act,$v['xact']) !== false)){
					$ar = $v;
				}
			}
			return is_array($ar);	
		}
		return false;
	}
	public function showMenu($name,$com,$act,$id=null,$add=null){
		$role = $_SESSION[$this->login_name]['role'];
		if(isset($this->permission[$com]) | $role==3){
			//check($this->permission[$com]);
			$ar = false;
			if(isset($this->permission[$com])){
			foreach($this->permission[$com] as $k=>$v){
				
				if($v['xact'] == $act | $v['xact']=='all'){
					$ar = $v;
					
				}
			}
			}
			if(is_array($ar) | $role==3){
				
				$str = "<li><a href='index.php?com=".$com."&act=".$act;
				if($id){
					$str.="&id=".$id;
				}
				if($add){
					$str.="&".$add;
				}
				$str.="' />";
				
				$str.='<i class="fa fa-chevron-right"></i>'.$name."</a></li>";
				return $str;
			}
			return false;
		}
		return false;		
	}
}