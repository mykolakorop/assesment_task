<?php
define("BASE_URL", "https://api.privatbank.ua/p24api");
//TO DO
function api_request($resource, $method, $login, $password, $amount, $reciever_card_number, $args=null) {

    $full_url = BASE_URL . "$resource";
    $options = array(
        CURLOPT_URL => $full_url,
        CURLOPT_USERPWD => "$login:$password",
        CURLOPT_HTTPHEADER => array('Content-Type: application/json',
            'Accept: application/json'),
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => "PrivatBank API client 0.1"
    );
    if ($args) {
        $json_args = json_encode($args);
        $options[CURLOPT_POSTFIELDS] = $json_args;
    }

    $ch = curl_init();
    curl_setopt_array($ch, $options);

    $content = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ( $status > 399 ) {
        throw new Exception("Exception $status: $content");
    }
    return json_decode($content);
}

function money_transfer($login, $password, $amount, $reciever_card_number)
{
    $res = api_request("/pay_pb", "POST", $login, $password, $amount, $reciever_card_number);
}

?>