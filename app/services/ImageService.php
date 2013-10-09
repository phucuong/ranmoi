<?php

class ImageService{
	public static function uploadImage($fileInfo, &$error, $maxSize=2000000)
	{
		if (empty($fileInfo["tmp_name"])){
			$error = 1;
			return "";
		} else {
			$file_name = $fileInfo["name"];
			$extension = pathinfo($file_name, PATHINFO_EXTENSION);
			$upload_flag = "0";
			$file_upload_array = array("jpg", "png", "jpeg");
			foreach( $file_upload_array as $fua ){
				if ( $extension == $fua || $extension == strtoupper($fua) ){
					$upload_flag = "1";
					break;
				}
			}
			if ( $upload_flag == "1" ){
				if ( $fileInfo["size"] > $maxSize ) {
					$error = 2; //file quá lớn
					return "";
				} else {
					$config = new Zend_Config_Ini( dirname(__FILE__) . "/../".'config_'.APP_ENV.'.ini', 'common' );
					$ext = self::getExt($file_name);
					$file_source = md5(rand(1, 100))."_".date("YmdHis");
					$file_name   = $file_source . "." . $ext;
					$folderPath = dirname(__FILE__).'/../../html';
					$file_path = $folderPath . $config->web_url->upload_org;
			
					if(copy ($fileInfo["tmp_name"],$file_path."/".$file_name)) {
						chmod($file_path."/".$file_name,0777);
					} else {
						$error = 4;
						return "";//Lỗi upload
					}
			
					$file_in  = $folderPath . $config->web_url->upload_org."/".$file_name;
					$file_out = $folderPath . $config->web_url->upload_100."/".$file_name;
					self::resizeFile( $file_in, $file_out, $ext, 100, 100);
					$file_out = $folderPath . $config->web_url->upload_thumb."/".$file_name;
					self::resizeFile( $file_in, $file_out, $ext, 146, 84);
					$file_out = $folderPath . $config->web_url->upload_200."/".$file_name;
					self::resizeFile( $file_in, $file_out, $ext, 200, 200);
			
					$error = 0;
					return $file_name;
				}
			} else {
				$error = 3; //không đúng định dạng file
				return "";
			}
		}
	}
	
	public static function uploadPhoto($fileInfo, &$error, $maxSize=2000000)
	{
		if (empty($fileInfo["tmp_name"])){
			$error = 1;
			return "";
		} else {
			$file_name = $fileInfo["name"];
			$extension = pathinfo($file_name, PATHINFO_EXTENSION);
			$upload_flag = "0";
			$file_upload_array = array("jpg", "png", "jpeg");
			foreach( $file_upload_array as $fua ){
				if ( $extension == $fua || $extension == strtoupper($fua) ){
					$upload_flag = "1";
					break;
				}
			}
			if ( $upload_flag == "1" ){
				if ( $fileInfo["size"] > $maxSize ) {
					$error = 2; //file quá lớn
					return "";
				} else {
					$config = new Zend_Config_Ini( dirname(__FILE__) . "/../".'config_'.APP_ENV.'.ini', 'common' );
					$ext = self::getExt($file_name);
					$file_source = md5(rand(1, 100))."_".date("YmdHis");
					$file_name   = $file_source . "." . $ext;
					$folderPath = dirname(__FILE__).'/../../html';
					$file_path = $folderPath . $config->web_url->photo_org;
			
					if(copy ($fileInfo["tmp_name"],$file_path."/".$file_name)) {
						chmod($file_path."/".$file_name,0777);
					} else {
						$error = 4;
						return "";//Lỗi upload
					}
			
					$file_in  = $folderPath . $config->web_url->photo_org."/".$file_name;
					$file_out = $folderPath . $config->web_url->photo_138."/".$file_name;
					self::resizeFile( $file_in, $file_out, $ext, 100, 100);
			
					$error = 0;
					return $file_name;
				}
			} else {
				$error = 3; //không đúng định dạng file
				return "";
			}
		}
	}
	
	public static  function resizeFile( $fin, $fout, $ext, $width, $height )
	{
		if ( $ext == "jpg" ){
			self::resizeFileJPEG( $fin, $fout, $width, $height );
		} else if ( $ext == "gif" ){
			self::resizeFileGIF( $fin, $fout, $width, $height );
		} else if ( $ext == "png" ){
			self::resizeFilePNG( $fin, $fout, $width, $height );
		}
	}
	
	static function getExt($file_name){
		$ext = "";
		$tmp_ary = explode('.', $file_name);
		if ( !empty($tmp_ary[count($tmp_ary)-1]) ){
			$ext = strtolower($tmp_ary[count($tmp_ary)-1]);
			if ( $ext == "jpeg" ){
				$ext = "jpg";
			}
		}
		return $ext;
	}
	
	static function resizeFileJPEG( $in, $out, $width, $height ){

		$size = getimagesize($in);

		if($size[0] >= $size[1]){
			$oY = 0;
			$oX = floor($size[0] - $size[1]) / 2;
		}else{
			$oX = 0;
			$oY = floor( (($size[1] - $size[0]) / 2 ) );
		}
		$exif_datas = exif_read_data($in);
		$trimsize = $size[0] > $size[1] ? $size[1] : $size[0];
		$img_in   = @ImageCreateFromJPEG($in);
		if ($img_in){
			$img_out  = imagecreatetruecolor($width, $height);
			ImageCopyResampled($img_out,$img_in,0,0,$oX,$oY,$width, $height,$trimsize,$trimsize);
			if(isset($exif_datas['Orientation']) && $exif_datas['Orientation'] == 6){
			    $rotate = imagerotate($img_out, 270, 0);
			    imagejpeg($rotate, $out);
			} else {
				ImageJPEG($img_out,$out);
			}
			ImageDestroy($img_in);
			ImageDestroy($img_out);
			chmod($out,0777);
		}
	}

	static function resizeFileGIF( $in, $out, $width, $height ){

		$size = getimagesize($in);

		if($size[0] >= $size[1]){
			$oY = 0;
			$oX = floor($size[0] - $size[1]) / 2;
		}else{
			$oX = 0;
			$oY = floor( (($size[1] - $size[0]) / 2 ) );
		}

		$trimsize = $size[0] > $size[1] ? $size[1] : $size[0];
		$img_in   = @ImageCreateFromGIF($in);
		if ($img_in){
			$img_out  = imagecreatetruecolor($width, $height);

			ImageCopyResampled($img_out,$img_in,0,0,$oX,$oY,$width, $height,$trimsize,$trimsize);

			ImageGIF($img_out,$out);

			ImageDestroy($img_in);
			ImageDestroy($img_out);
			chmod($out,0777);
		}
	}

	static function resizeFilePNG( $in, $out, $width, $height ){

		$size = getimagesize($in);

		if($size[0] >= $size[1]){
			$oY = 0;
			$oX = floor($size[0] - $size[1]) / 2;
		}else{
			$oX = 0;
			$oY = floor( (($size[1] - $size[0]) / 2 ) );
		}

		$trimsize = $size[0] > $size[1] ? $size[1] : $size[0];
		$img_in   = @ImageCreateFromPNG($in);
		if ($img_in){
			$img_out  = imagecreatetruecolor($width, $height);

			ImageCopyResampled($img_out,$img_in,0,0,$oX,$oY,$width, $height,$trimsize,$trimsize);

			ImagePNG($img_out,$out);

			ImageDestroy($img_in);
			ImageDestroy($img_out);
			chmod($out,0777);
		}
	}
}
?>