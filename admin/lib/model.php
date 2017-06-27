<?php 
	class model{
		private $_totalslug;
		private $d;
		private $lang;
		function __construct($d,$lang){
			$this->d = $d;
			$this->lang = $lang;
			$this->setTotalSlug();
		}
		function getUrlFromType($type){
			$_allower = array("news"=>"tin-tuc","service"=>"dich-vu");
			if(isset($_allower[$type])){
				return $_allower[$type];
			}
			return $type;
		}
		function setTotalSlug(){
			return false;
			$this->d->query("select * from #_tag order by length_".$this->lang." desc");
			$this->_totalslug = $this->d->result_array();
		}
		function getTagName($tag){
			$this->d->query("select * from #_tag where slug_".$this->lang." = '".$tag."'");
			$rs = $this->d->fetch_array();
			return $rs['ten_'.$this->lang];
		}
		function getContentWithTag($tagname){
			$tagname = $this->getTagName($tagname);
			$content = array();
			$this->d->query("select id,noidung_".$this->lang.",tenkhongdau,ngaytao,thumb from #_content where hienthi = 1 order by stt desc");
			$content = $this->d->result_array();
			$list = array();
			$reg ='/(?!(?:[^<\[]+[>\]]|[^>\]]+<\/a>))($name)/imsU';
			foreach ($content as $k=>$v) {
			
				$name = str_replace(',','|',$tagname);
			
				$regexp=str_replace('$name', $name, $reg);    
				if(preg_match_all($regexp,  $v['noidung_'.$this->lang], $matches)){
					$list[] = $v['id'];
				}
				
			}
			return array("id"=>$list,"name"=>$tagname);
		}
		function autoAddSeoTags($text){
		return $text;
		foreach($this->_totalslug as $k=>$v){	
			
			if(!$v['type']){
				$kw_array[$v['ten_'.$this->lang]]['link'] = "tag/".changeTitle($v['ten_'.$this->lang])."/";
			}else{
				$kw_array[$v['ten_'.$this->lang]]['link'] = $v['link'];
			}
			$kw_array[$v['ten_'.$this->lang]]['type'] = $v['type'];
		}
		$maxsingle=-1;
		$reg ='/(?!(?:[^<\[]+[>\]]|[^>\]]+<\/a>))($name)/imsU';
		foreach ($kw_array as $name=>$item) {
			$url = $item['link'];
			$stt = 0;
			$name = str_replace(',','|',$name);
			$replace="<a title=\"$1\" href=\"$url\">$1</a>";
			$regexp=str_replace('$name', $name, $reg);    
			$newtext = preg_replace($regexp, $replace, $text, $maxsingle);            
			if ($newtext!=$text) {                
				$stt++;
				$text=$newtext;                       
			}         
			if($stt > 0 & !$item['type']){
			
			}		
		}
		
		return trim( $text );
}
	
		
	}