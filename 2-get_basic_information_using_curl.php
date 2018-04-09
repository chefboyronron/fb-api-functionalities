<?php 
session_start();
require_once 'assets/php/Facebook_2.6/autoload.php';
$fb = new \Facebook\Facebook([
  'app_id' => 'APP_ID',
  'app_secret' => 'YOUR_SECRET',
  'default_graph_version' => 'v2.8',
]);
   $permissions = []; // optional
   $helper = $fb->getRedirectLoginHelper();
   $accessToken = $helper->getAccessToken();
   
if (isset($accessToken)) {
  
    $url = "https://graph.facebook.com/v2.6/me?fields=id,name,gender,email,picture,cover&access_token={$accessToken}";
    $headers = array("Content-type: application/json");
    
       
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
     curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
     curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
     curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
       
     $st=curl_exec($ch); 
     $result=json_decode($st,TRUE);
     echo "My name: ".$result['name'];
     echo "<img src=".$result['cover']['source'].">";
    
} else {
  $loginUrl = $helper->getLoginUrl('https://your-domain.com/', $permissions);
  echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
}
?>