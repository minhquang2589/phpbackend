<?php

define("BASE_URL", "http://localhost/chuabaiqslv/index.php/");

function site_url($url = ""){
    return BASE_URL. $url;
}


function redirect($url){
    header('Location: '. $url);
    exit();
}

function dd($data, $die = true){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    if($die){
        die();
    }
}