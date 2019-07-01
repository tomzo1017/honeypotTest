
<?php
/**
* Show user information like IP address, useragent
**/

function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
 }
$ip = getRealUserIp();
$browser = isset($_SERVER['HTTP_USER_AGENT'])
               ? strtolower($_SERVER['HTTP_USER_AGENT'])
               : '';
$referrer = "";
 if(isset($_SERVER['HTTP_REFERER'])) {
            $referrer = $_SERVER['HTTP_REFERER'];
        }
$hostname = @gethostbyaddr($ip);


 if ($referrer == "") {
  $referrer = "This page was accessed directly";
  }

$current_user = get_current_user();

echo "<b>Visitor IP address:</b><br/>" . $ip . "<br/>";
echo "<b>Browser (User Agent) Info:</b><br/>" . $browser . "<br/>";
echo "<b>Referrer:</b><br/>" . $referrer . "<br/>";
echo '<b> Hostname: </b> <br/> '. $hostname . '<br/>';
echo '<b> Current User </b> <br/>'. get_current_user() .'<br/>';


$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getOS($agent) { 


    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
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
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser($agent) {

   


    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $agent))
            $browser = $value;

    return $browser;
}


$user_os        = getOS($user_agent);
$user_browser   = getBrowser($user_agent);

$device_details = "<strong>Browser: </strong>".$user_browser."<br /><strong>Operating System: </strong>".$user_os."";

print_r($device_details);

date_default_timezone_set('Europe/Helsinki'); 


$file = fopen("data.txt", "a");
$data = ["Timestamp" => date('d.m.Y H:i'), "IP" => $ip, "referrer" => $referrer,  "Hostname" => $hostname, "Current user" => $current_user, "Browser (User Agent) Info" => $browser, "Browser" => $user_browser, "Operating System" => $user_os];
$string = json_encode($data).PHP_EOL;
fwrite($file, $string);
fclose($file);









?>


