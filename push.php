<?php

// example: https://github.com/onlinetuts/line-bot-api/blob/master/php/example/chapter-02.php

include ('line-bot-api/php/line-bot.php');

$channelSecret = 'NuIDf8sTPzPUdoIgj4fd8OFtNSVJe8HWwTwMzIeAL0I';
$access_token  = 'wgKVfqXwuHW+tQtWBfy1cIlhxp+AFoyrbBoKo3yrZ6up2lBdy9Du+ZAkzXKnDR1FNB1tDckxMJ1Owy2DbxBMFM8+uoR8I6D57tHWVhyCFBMPG6QV+sejtyV2nJZM+WlXf1ljEVNyWYOmli1g8uPG3QdB04t89/1O/w1cDnyilFU=';

$bot = new BOT_API($channelSecret, $access_token);
	
$bot->sendMessageNew('U6f60b2486506604454cf305a9f6715a9', 'Hello World !!');

if ($bot->isSuccess()) {
	echo 'Succeeded!';
	exit();
}

// Failed
echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
exit();
