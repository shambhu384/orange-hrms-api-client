<?php

include 'vendor/autoload.php';


require __DIR__.'/vendor/autoload.php';


$client = new GuzzleHttp\Client();
$res = $client->post('http://opensource.demo.orangehrmlive.com/index.php/oauth/issueToken', [
    'allow_redirects' => false,
    'http_errors' => false,
	'form_params' => [
		'client_id' => 'hrms1',
        'client_secret' => 'Demo@100',
        'grant_type' => 'client_credentials',
        ''
	]
]);
echo sprintf("Status Code: %s\n\n", $res->getStatusCode());
echo $res->getBody();
