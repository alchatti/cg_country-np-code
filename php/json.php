<?php
/*
* @about: Generate Json file contains Country & Their Phone Codes
* @version: 1.0
* @author: Majed Al-Chatti
*/
ini_set("allow_url_fopen", 1);

$json = file_get_contents('http://country.io/phone.json');
$phone = json_decode($json,true);
$json = file_get_contents('http://country.io/names.json');
$country = json_decode($json,true);

$result = array();

foreach($country as $key=>$value) {

    $codes = explode(" and ",str_replace("+","",$phone[$key]));
    foreach( $codes as $code ){
        if(strlen(trim($code)) > 0 ){
            $result[$value . " (+".$code.")"] = $code;
        }
    }   
}
ksort($result);
$fp = fopen('../out/list.json', 'w');
fwrite($fp, json_encode($result));
fclose($fp);
header("Location: /out/list.json");
?>