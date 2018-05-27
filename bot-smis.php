<?php
$access_token = 'YVEMBY8D02S16AQFucHJehPAS+XrhfWPoIkF8aaay2+jTg7SDhI0ViIR9zdxMUxh9eRCESAmukmXx2018n3Y6C35WobquNSxrFMJKNW9k0wtmZ3ToRB5L93HxDhIKkyTko1/iYSMv0H0Kk3P05AlZQdB04t89/1O/w1cDnyilFU=';

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

			$text2 =  "ยินดีต้อนรับเข้าสู่ระบบแจ้งเตือน SMIS วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน [smis.nawamin.ac.th]";
			$user_id = $events['events'][0]['source']['userId'];
			
		//	if (strlen($text)==16){
				$url_a="http://smis.nawamin.ac.th/mis/smis2line/register_userid.php?id=$text&userid=$user_id";
				//echo "$url_a";
				$data_a=file_get_contents($url_a);
				echo $data_a;
				if ($data_a == "OK"){
					$text = $text2 . '  หมายเลขลงทะเบียนเรียบร้อยแล้ว...  <จัดทำโดยงานศูนย์ข้อมูลสารสนเทศ วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน [Attasit Datsong:OK]>';
				}else if ($data_a == "DUP"){
					$text = $text2 . '  หมายเลขลงทะเบียนของท่านเคยลงทะเบียนแล้ว... กรุณาติดต่อผู้ดูแลระบบ<จัดทำโดยงานศูนย์ข้อมูลสารสนเทศ วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน [Attasit Datsong:HTTP-Dup]>';
				}else if ($data_a == "NO_ID"){
					$text = $text2 . '  หมายเลขลงทะเบียนของท่านไม่ถูกต้อง... กรุณาติดต่อผู้ดูแลระบบ<จัดทำโดยงานศูนย์ข้อมูลสารสนเทศ วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน [Attasit Datsong:NO-ID]>';
				}else{
					$text = $text2 . '  หมายเลขลงทะเบียนของท่านไม่ถูกต้อง... กรุณาติดต่อผู้ดูแลระบบ<จัดทำโดยงานศูนย์ข้อมูลสารสนเทศ วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน [Attasit Datsong:HTTP-Err]>';
		//		}				
		//	}else{
		//		$text = $text2 . '  หมายเลขลงทะเบียนของท่านไม่ถูกต้อง... กรุณาติดต่อผู้ดูแลระบบ<จัดทำโดยงานศูนย์ข้อมูลสารสนเทศ วิทยาลัยการอาชีพนวมินทราชินีแม่ฮ่องสอน [Attasit Datsong:ID-Hr]>';
		//	}
			
		
			
			
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
