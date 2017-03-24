<?php
$access_token = 'wgKVfqXwuHW+tQtWBfy1cIlhxp+AFoyrbBoKo3yrZ6up2lBdy9Du+ZAkzXKnDR1FNB1tDckxMJ1Owy2DbxBMFM8+uoR8I6D57tHWVhyCFBMPG6QV+sejtyV2nJZM+WlXf1ljEVNyWYOmli1g8uPG3QdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
