<?php
/*
* @about: Generate Html Dropdown in file
* @version: 1.0
* @author: Majed Al-Chatti
*/

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


echo '<select><option value="">Select Country</option>';

foreach($result as $key=>$value) {
        echo '<option value="+'.$value.'"/>'.$key.' (+'.$code.')</option>';
}
echo '</select>';