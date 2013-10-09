<?php

class UtilitiService{
	
	public static function printDebug($data){
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
		echo '<br />';
	}
	
	public static function createJson($json_array) {
		header('Content-type: text/javascript; charset=utf-8');
		if (is_array($json_array) && count($json_array) > 0) {
			return Zend_Json::encode($json_array);
		} else {
			return '[]';
		}
	}
	
	public static function cutJapanString($str, $maxLength){
		$length = mb_strlen($str,'utf8');
		if($length > $maxLength){
			$str = mb_substr($str, 0, $maxLength,'utf8');
			$str.= '...';
		}
		return $str;
	}
	
	public static function stripUnicode($str){
		if(!$str) return false;
	   $unicode = array(
		 'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
		 'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		 'd'=>'đ',
		 'D'=>'Đ',
		 'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		  'i'=>'í|ì|ỉ|ĩ|ị',	  
		  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
		 'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		 'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		 'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		 'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
	   );
	   foreach($unicode as $khongdau=>$codau) {
			$arr=explode("|",$codau);
		  $str = str_replace($arr,$khongdau,$str);
	   }
		return $str;
	}

	public static function now() { // Chuyển giờ hệ thống sang tiếng Việt
		$anh = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun","am","pm",":"); 
		$viet = array ("Thứ hai","Thứ ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bảy", "Chủ nhật", " phút, sáng", " phút, chiều", " giờ " ); 
		$timenow = gmdate("D, d/m/Y - g:i a.", time() + 7*3600); 
		$t = str_replace( $anh, $viet, $timenow); 
		return $t; 
	}

	public static function changeTitle($string){//VD: "Ton-Duc-Thang"
		$string = self::stripUnicode($string);
		$string = mb_convert_case($string,MB_CASE_LOWER,'utf-8');
		$string = trim($string);
		$string = str_replace(" ","-",$string);
		$string = str_replace("'","",$string);//tìm dấu nháy ' thay bằng chuỗi rỗng
		$string = str_replace('"',"",$string);//tìm dấu nháy " thay bằng chuỗi rỗng
		$string = str_replace(",","",$string);
		return $string;
	}
	
	public static function pagesLinks($totalRows, $currentPage, $pageSize=10){
		if ($totalRows<=0) return "";
		$totalPages = ceil($totalRows/$pageSize);
		if ($totalPages<=1) return "";
		$currentURL = $_SERVER['REDIRECT_URL'];
		if( isset($_GET["pageNum"]) ==true)  $currentPage = $_GET["pageNum"];
		else $currentPage = 1;
		settype($currentPage,"int");
		if ($currentPage <=0) $currentPage = 1;

		$querystring="";
		foreach($_GET as $k => $v) {
			if ($k!='pageNum') $querystring = $querystring . "&{$k}={$v}";
		}
		$querystring = $querystring != '' ? "&{$querystring}" : '';
		$firstLink=""; $prevLink=""; $lastLink=""; $nextLink="";
		$link = '';
		for ($i=1; $i<=$totalPages; $i++){
			if($i != $currentPage){
				$link.= "<a href={$currentURL}?pageNum={$i}{$querystring}>{$i}</a> | ";
			}
			else{
				$link.= "{$i} | ";
			}
		}
		return $link;
		/*if ($currentPage>1) {
			$firstLink = "<a href={$currentURL}?{$querystring}>Trang đầu</a>";
			$prevPage=$currentPage-1;
			$prevLink="<a href={$currentURL}?{$querystring}&pageNum={$prevPage}>Trang trước</a>";
		}
		if ($currentPage<$totalPages) {
			$lastLink="<a href={$currentURL}?{$querystring}&pageNum={$totalPages}>Trangcuối</a>";
			$nextPage=$currentPage+1;
			$nextLink = "<a href={$currentURL}?{$querystring}&pageNum={$nextPage}>Trang kế</a>";
		}
		return $firstLink.$prevLink.$nextLink.$lastLink;*/
	}
}
?>