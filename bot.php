<?php
$access_token = 'xrhqDtb6g3XTZv7CBmnIgV0HhD/9X1PqYO9s4X5jFHlsz67xiW7ORKqxygxLvSiBjmUkv1aaSVLU1/P9bunN+8ZqrZMJe/4XWQX2MLmyje+Nb4GGER+F8Nz371T9EaCiKTm0cVQYpRx6RBbutqETDAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Get replyToken
		$replyToken = $event['replyToken'];
		// Build message to reply back
		$messages = [
			'type' => 'text',
			'text' => $content 
		];
		// Make a POST Request to Messaging API to reply to sender
		$url = 'https://api.line.me/v2/bot/message/reply';
		$data = [
			'replyToken' => $replyToken,
			'messages' => [$messages],
		];

		// Make a POST Request to Messaging API to reply to sender
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
echo "OK";
