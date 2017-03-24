<?php
$access_token = 'nKOmWzPp5kyankLtyuVRO55hxfvkaYBjufGrossf5gYtJPNEKd83Z/03wxsxyq7cNB1tDckxMJ1Owy2DbxBMFM8+uoR8I6D57tHWVhyCFBPxM3OeaDQ37pWz5A0ONIrTGDXFolIwP+lbLy7JBaXP7gdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
