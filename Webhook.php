<?php

include_once ('Telegram.php');
include_once ('ApiLeads.php');

$body = file_get_contents('php://input');
$arr = json_decode($body, true);

$telegram = new Telegram('https://api.telegram.org/bot', '1773836592:AAFCTJi5gtiJUi_0zrWpgOJ-P7jR5p2xDFA', '-1001498859797');
$leads = new ApiLeads('http://api.leads.su/webmaster','ecf17c85e3179028e287eb511016b1fc');

if (trim($arr['message']['text']) == '/getCountry') {
    $getCountry = $leads->getCountries(50, 0, true, 10);
    foreach ($getCountry as $country) {
        $telegram->setRequest($country['id']);
        $telegram->setRequest($country['name']);
    }

}
if (trim($arr['message']['text']) == '/getAccount') {
    $getIdName = $leads->getIdName();
    $telegram->setRequest($getIdName['id']);
    $telegram->setRequest($getIdName['name']);

}
