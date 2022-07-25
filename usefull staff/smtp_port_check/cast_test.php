<?php

if (!function_exists('fsockopen')) {
    echo 'fsockopen не работает!';
    return;
}
//Используем определённые сервера на которых точно открыты нужные порты
$tests = array(
    25 => 'smtp.yandex.ru',
    //465 => 'ssl://smtp.yandex.ru',
    465 => 'ssl://smtp.gmail.com',
    //587 => 'tsl://smtp.yandex.ru',
    587 => 'smtp.yandex.ru',
);
//По циклу тестируем
foreach ($tests as $port => $server) {
    //Соединяемся
    $fp = @fsockopen($server, $port, $errno, $errstr, 5);
    //Если удачное соединение
    if ($fp) {
        echo 'Порт ' . $port . ' открыт на вашем сервере!' . "<br/>";
        fclose($fp);
    }
//Если неудачное соединение
    else {
        echo 'Порт ' . $port . ' не открыт на вашем сервере!' . "<br/>";
        //Вывод номера и причины ошибки
        echo " error num: " . $errno . ' : ' . $errstr . "<br/>";
    }
}
