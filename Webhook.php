<?php

include_once ('Telegram.php');
include_once ('ApiLeads.php');

$body = file_get_contents('php://input'); //Получаем в $body json строку
$arr = json_decode($body, true); //Разбираем json запрос на массив в переменную $arr

function cir_strrev($stroka){ //Так как функция strrev не умеет нормально переворачивать кириллицу, нужен костыль через массив. Создадим функцию
    preg_match_all('/./us', $stroka, $array);
    return implode('',array_reverse($array[0]));
}
$telegram = new Telegram('https://api.telegram.org/bot', '1773836592:AAFCTJi5gtiJUi_0zrWpgOJ-P7jR5p2xDFA', '-1001498859797');
$leads = new ApiLeads('http://api.leads.su/webmaster','ecf17c85e3179028e287eb511016b1fc');

//$getTelegram = $telegram->setRequest('test');

$getCountry = $leads->getCountries(50, 0, true, 10);

var_dump($getCountry);die();

