<?php
require_once('vendor/autoload.php');
 
$client = new \GuzzleHttp\Client();
 
$response = $client->request('POST', 'https://api.qoreid.com/token', [
  'body' => '{"clientId":"0FEA04RB2T98XS2M3UIQ","secret":"a2911e9df7914ef89675ca74c1877e31"}',
  'headers' => [
    'accept' => 'text/plain',
    'content-type' => 'application/json',
  ],
]);
 
echo $response->getBody();