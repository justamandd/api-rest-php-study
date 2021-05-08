<?php 

    $url = "http://localhost/api-study/02/public_html/api";

    $class = '/user';

    $param = '/1';

    $response = file_get_contents($url.$class.$param);

    //echo $response;

    $response = json_decode($response,1);

    var_dump($response);