<?php
 
$strAccessToken = "wgKVfqXwuHW+tQtWBfy1cIlhxp+AFoyrbBoKo3yrZ6up2lBdy9Du+ZAkzXKnDR1FNB1tDckxMJ1Owy2DbxBMFM8+uoR8I6D57tHWVhyCFBMPG6QV+sejtyV2nJZM+WlXf1ljEVNyWYOmli1g8uPG3QdB04t89/1O/w1cDnyilFU=";
 
$strUrl = "https://api.line.me/v2/bot/message/push";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
$arrPostData = array();
$arrPostData['to'] = "0899823832";
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "นี้คือการทดสอบ Push Message";
 
 
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
 
?>
