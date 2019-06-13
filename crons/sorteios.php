<?php

$online = 'http://lotterynetwork.pe.hu/';
$local = 'http://localhost/sorte/';

$url = $local . 'sorteios/sorteio';

$data = array('key' => 'aewmlk');

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if (!$result) {
    echo 'Erro no gatilho de sorteios.';
}

var_dump($result);
