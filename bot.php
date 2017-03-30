<?php
$access_token = 'wgKVfqXwuHW+tQtWBfy1cIlhxp+AFoyrbBoKo3yrZ6up2lBdy9Du+ZAkzXKnDR1FNB1tDckxMJ1Owy2DbxBMFM8+uoR8I6D57tHWVhyCFBMPG6QV+sejtyV2nJZM+WlXf1ljEVNyWYOmli1g8uPG3QdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			$text2 =  "ยินดีต้อนรับเข้าสู่ระบบแจ้งเตือนงานสารบรรณ วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน[rms.nawamin.ac.th]";
			$user_id = $events['events'][0]['source']['userId'];
			
			if (strlen($text)==13){
				$url_a="http://rms.nawamin.ac.th/rms2line/register_userid.php?id=$text&userid=$user_id";
				//echo "$url_a";
				$data_a=file_get_contents($url_a);
				echo $data_a;
				if ($data_a == "OK"){
					$text = $text2 . '  หมายเลขลงทะเบียนเรียบร้อยแล้ว...  <จัดทำโดยงานศูนย์ข้อมูลสารสนเทศ วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน [Attasit Datsong:OK]>';
				}else if ($data_a == "DUP"){
					$text = $text2 . '  หมายเลขลงทะเบียนของท่านเคยลงทะเบียนแล้ว... กรุณาติดต่อผู้ดูแลระบบ<จัดทำโดยงานศูนย์ข้อมูลสารสนเทศ วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน [Attasit Datsong:HTTP-Dup]>';
				}else{
					$text = $text2 . '  หมายเลขลงทะเบียนของท่านไม่ถูกต้อง...  กรุณาติดต่อผู้ดูแลระบบ<จัดทำโดยงานศูนย์ข้อมูลสารสนเทศ วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน [Attasit Datsong:HTTP-Err]>';
				}				
			}else{
				$text = $text2 . '  หมายเลขลงทะเบียนของท่านไม่ถูกต้อง... กรุณาติดต่อผู้ดูแลระบบ<จัดทำโดยงานศูนย์ข้อมูลสารสนเทศ วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน [Attasit Datsong:ID-Err]>';
			}
			
		
			
			
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
