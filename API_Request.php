<?php ob_start();
session_start();
$url = explode("/",$_SERVER['REQUEST_URI']);
$projectname = $url[1] == ''?'':$url[1].'/';
$https = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://";
$baseurl = ($_SERVER['HTTP_HOST'] == 'localhost:88' || $_SERVER['HTTP_HOST'] == '192.168.1.121:88') ?  "http://".$_SERVER['HTTP_HOST']."/roja_website/" : $https."www.roja.one/";
$apiurl = ($_SERVER['HTTP_HOST'] == 'localhost:88' || $_SERVER['HTTP_HOST'] == '192.168.1.121:88') ? "http://192.168.1.121:3500/api/" :  $https."api.roja.one/api/";
define('BASE_URL', $baseurl);
$apiurl = $apiurl;

function contactRequest($data){
	global $apiurl;
	$browser= getBrowser();
	$device= getDevice();
	$platform=getPlatform();
	$data['browser'] = $browser;
	$data['device'] = $device;
	$data['platform'] = $platform;
	$data['ip'] = $_SERVER['REMOTE_ADDR'];
	$ch = curl_init($apiurl.'website/webenquiryform');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	$response_json = curl_exec($ch);
	curl_close($ch);
	return $response_json;
}

function demoRequest($data){
	global $apiurl;
	$browser= getBrowser();
	$device= getDevice();
	$platform=getPlatform();
	$data['browser'] = $browser;
	$data['device'] = $device;
	$data['platform'] = $platform;
	$data['ip'] = $_SERVER['REMOTE_ADDR'];
	$ch = curl_init($apiurl.'website/requestdemoform');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	$response_json = curl_exec($ch);
	curl_close($ch);
	return $response_json;
}

function getBrowser() {
	
	if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("MSIE")))
	{
	$browser="Internet Explorer";
	}
	else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("Presto")))
	{
	$browser="Opera";
	}
	else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("CHROME")))
	{
	$browser="Google Chrome";
	}
	else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("SAFARI")))
	{
	$browser="Safari";
	}
	else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("FIREFOX")))
	{
	$browser="Firefox";
	}
	elseif(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("EDGE")))
	{
	$browser="Microsoft Edge";
	}
	else
	{
	$browser="Other";
	}
	return $browser;
}

function getDevice() {

	$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
	$isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet")); 
	$isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows")); 
	$isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android")); 
	$isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone")); 
	$isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad")); 
	$isIOS = $isIPhone || $isIPad; 
	
	if($isMob){ 
		$device="Mobile"; 
	}
	if($isTab){ 
		$device="Tablet";
	} 
	if($isIOS){ 
		$device="Ios"; 
	}
	elseif($isAndroid){ 
		$device="Android"; 
	}
	elseif($isWin){ 
		$device="Windows"; 
	}
	else{ 
		$device="Desktop"; 
	}
	return $device;
}


function getPlatform() {
    $userAgent = strtolower($_SERVER["HTTP_USER_AGENT"]);
    $platform = "Unknown";

   

    // Check for specific platform keywords
    if (strrpos($userAgent, "windows")) {
        $platform = "Windows";
    } elseif (strrpos($userAgent, "macintosh") || strrpos($userAgent, "mac os x")) {
        $platform = "Mac OS";
    } elseif (strrpos($userAgent, "android")) {
        $platform = "Android";
    } elseif (strrpos($userAgent, "iphone")) {
        $platform = "iPhone";
    } elseif (strrpos($userAgent, "ipad")) {
        $platform = "iPad";
    } elseif (strrpos($userAgent, "linux")) {
        $platform = "Linux";
    }

    return $platform;
}
?>