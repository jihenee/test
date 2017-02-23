<?php

include __DIR__.'/vendor/autoload.php';
use Guzzle\Http\Client;

// create our http client (Guzzle)
$http = new Client('http://coop.apps.knpuniversity.com', array(
    'request.options' => array(
        'exceptions' => false,
    )
));


$request=$http->post('/api/2/eggs-collect');
$request->addHeader('Authorization','Bearer ff79d5849c114613dbe221602dbdd40cf091a8a8');
$response=$request->send();
echo $response->getBody();
echo "\n\n";