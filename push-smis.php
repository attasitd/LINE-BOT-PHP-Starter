<?php 

$strAccessToken = "YVEMBY8D02S16AQFucHJehPAS+XrhfWPoIkF8aaay2+jTg7SDhI0ViIR9zdxMUxh9eRCESAmukmXx2018n3Y6C35WobquNSxrFMJKNW9k0wtmZ3ToRB5L93HxDhIKkyTko1/iYSMv0H0Kk3P05AlZQdB04t89/1O/w1cDnyilFU=";
 
$strUrl = "https://api.line.me/v2/bot/message/push";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
$arrPostData = array();
//$arrPostData['to'] = "U6f60b2486506604454cf305a9f6715a9";
//$arrPostData['to'] = "U7d7bcb035841f1d8ce65f766a77c7026";
//$url_a="http://rms.nawamin.ac.th/rms2line/read_userid.php";
//$data_a=file_get_contents($url_a);

//echo $data_a;
$arrPostData['to'] = $_GET["userid"];
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = $_GET["text"];;
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
 
echo "OK";
?>
