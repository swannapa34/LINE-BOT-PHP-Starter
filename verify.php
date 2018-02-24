<?php
$access_token = 'xrhqDtb6g3XTZv7CBmnIgV0HhD/9X1PqYO9s4X5jFHlsz67xiW7ORKqxygxLvSiBjmUkv1aaSVLU1/P9bunN+8ZqrZMJe/4XWQX2MLmyje+Nb4GGER+F8Nz371T9EaCiKTm0cVQYpRx6RBbutqETDAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
