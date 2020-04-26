<?php
	define("TOKEN", "hillock");			

	define("PHOTO_DN", "photo");  
	define("PHOTORZ_DN", "photoResize");  
	define("PHOTORZ_MAX", 72);  
	define("WEB4WX", 'http://'.$_SERVER['HTTP_HOST']);	
	define("DEBUG_OUTPUT","/home/wwwroot/pper/log.html");
	require 'photo.php';
	
	
	function logger($content)
	{
		if(!defined("DEBUG_OUTPUT")) return;
		$debug = print_r($content,true);
		//$debug = var_export($content,true);
		file_put_contents(DEBUG_OUTPUT, date('Y-m-d H:i:s  ').$debug."<br>", FILE_APPEND);
	}

?>