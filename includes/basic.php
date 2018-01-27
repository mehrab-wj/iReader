<?php

include_once("class/seo.php");
include_once("class/config.php");
include_once("class/objects.php");

$seo = new Seo;
$db = new DatabaseConnection;
$Build = new Build;

function getFeed($feed_url) {

    $content = file_get_contents($feed_url);
    $x = new SimpleXmlElement($content);
    foreach($x->channel->item as $entry) {
        echo "<a href='$entry->link' title='$entry->title'>" . $entry->title . "</a><br>
        ".$entry->description;
    }
}
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

function getOS() {

    global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone - IOS',
                            '/ipod/i'               =>  'iPod - IOS',
                            '/ipad/i'               =>  'iPad - IOS',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }

    return $os_platform;

}

function getBrowser() {

    global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/edge/i'       =>  'Edge',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'System Browser'
                        );

    foreach ($browser_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}
function shortUrl($link) {
  $url = 'http://opizo.com/webservice/shrink';
	$data = array(
	  'username' => 'thisismehrab@gmail.com',
	  'url' => $link,
	  );
	//Function 1 , without curl
	function httpPost_nocurl($url, $data)  {
	  $options = array(
	    'http' => array(
	      'header'  => "Content-type: application/x-www-form-urlencodedrn",
	      'method'  => 'POST',
	      'content' => http_build_query($data)
	    )
	  );
	  $context  = stream_context_create($options);
	  $result = file_get_contents($url, false, $context);
	  return $result;
	}
	//Function 2 , with curl
	function httpPost_curl($url, $data)
	{
	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    return $response;
	}
	return httpPost_curl($url, $data);
}
?>
