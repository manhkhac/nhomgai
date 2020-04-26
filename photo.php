<?php


class photo
{

	
	
	public function getPhotos($dirName,$max,$photoDate = null)
	{
//		logger("getPhotos------------1");	
		$photoDir = opendir('./'.$dirName); 
		$i = 0;
		$files = array();
		//$file
		while (false !== ($file = readdir($photoDir)) ){//&& $i < 108) { 
			list($filesname,$kzm)=explode(".",$file);
			if($kzm=="gif" or $kzm=="jpg" or $kzm=="JPG" or $kzm=="png" or $kzm=="PNG") { 
			  if (!is_dir("./".$file)) { 
				$files[$i]["name"] = $file;
				$files[$i]["size"] = round((filesize($dirName .'/'.$file)/1024),2);
				$files[$i]["time"] = date("Y-m-d H:i:s",filemtime($dirName .'/'.$file));
				$i++;
			   }
			  }
		}
		closedir($photoDir);

		foreach($files as $k=>$v){
			$size[$k] = $v['size'];
			$time[$k] = $v['time'];
			$name[$k] = $v['name'];
		}

		array_multisort($time,SORT_DESC,SORT_STRING, $files);
		
		if(count($files) > $max)  
			$photos = array_slice($files,0,$max);
		else
			$photos = $files;
			
		return $photos;
	}
	
	
	
	public function savePhoto($url,$fromUsername)
	{

		if(is_dir(basename($fromUsername))) {
			echo "The Dir was not exits";
			Return false;
		}
		
		$url = preg_replace( '/(?:^[\'"]+|[\'"\/]+$)/', '', $url );
		
		
		$pathPhoto = './'.PHOTO_DN.'/';
		$pathPhotoResize = './'.PHOTORZ_DN .'/';
		list($msec,$sec) = explode ( " ", microtime () );  
		$seq = str_replace('0.','~',$msec);

		$filename = date('Ymd~His',$sec). $seq.'-'.$fromUsername.'.jpg';
		
		$hander = curl_init();
		$fp = fopen($pathPhoto.$filename,'wb');

		curl_setopt($hander,CURLOPT_URL,$url);
		curl_setopt($hander,CURLOPT_FILE,$fp);
		curl_setopt($hander,CURLOPT_HEADER,0);
		curl_setopt($hander,CURLOPT_FOLLOWLOCATION,1);
	  //curl_setopt($hander,CURLOPT_RETURNTRANSFER,false);
		curl_setopt($hander,CURLOPT_TIMEOUT,60);

		curl_exec($hander);
		curl_close($hander);
		fclose($fp);

		$this->resizePhoto($filename,$pathPhoto,$pathPhotoResize,120,160);
		
				
		Return $filename;
	}
	
	public function resizePhoto($filename,$srcDir,$disDir,$distWidth,$distHeight)
	{
		// Content type
		//header('Content-type: image/jpeg');
		// Get new dimensions
		list($width, $height) = getimagesize($srcDir.$filename);
		$percent = 1;
		if($width /$height >= $distWidth/$distHeight)
			{
				
				if($width > $distWidth)
				{
					$percent = $distWidth/$width;
				}
			} 
			else
			{
				if($height > $distHeight)
				{
					$percent = $distHeight/$height;
				}
			}
		$new_width = $width * $percent;
		$new_height = $height * $percent;
	
		$image_p = imagecreatetruecolor($new_width, $new_height);
		$image = imagecreatefromjpeg($srcDir.$filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		
		// Output
		imagejpeg($image_p, $disDir.$filename, 100);
	}

}

	$photoObj = new photo();


?>