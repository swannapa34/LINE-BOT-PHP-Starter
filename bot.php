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
		$messages = $event['message'];
		$data = [
			'replyToken' => $replyToken,
			'messages' => json_encode($messages),
		];

		// Make a POST Request to Messaging API to reply to sender
		$url = 'https://api.line.me/v2/bot/message/reply';			
		$post = json_encode($data);
		$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

		$channel = curl_init();
		curl_setopt($channel, CURLOPT_URL, $url);
		curl_setopt($channel, CURLOPT_POST, true);
		curl_setopt($channel, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($channel, CURLOPT_POSTFIELDS, $post);
		curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($channel, CURLOPT_FOLLOWLOCATION, 1);
		$result = curl_exec($channel);
		curl_close ($channel);

		echo $result . "\r\n";
	}
}
echo "OK1";
