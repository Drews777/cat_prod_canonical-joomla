<?php
// Получаем текущие курсы валют в rss-формате с сайта www.cbr.ru
$date = date("d/m/Y");
// Формируем ссылку
$link = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=$date";
// Загружаем HTML-страницу
$fd = fopen($link, "r");
$text="";
if (!$fd) echo "Запрашиваемая страница не найдена";
else
{
    // Чтение содержимого файла в переменную $text
    while (!feof ($fd)) $text .= fgets($fd, 4096);
}
// Закрыть открытый файловый дескриптор
fclose ($fd);

$content = $text;
// Разбираем содержимое, при помощи регулярных выражений
$pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";
preg_match_all($pattern, $content, $out, PREG_SET_ORDER);
$dollar = "";
$euro = "";
foreach($out as $cur)
{
    if($cur[2] == 840) $dollar = str_replace(",",".",$cur[4]);
    if($cur[2] == 978) $euro   = str_replace(",",".",$cur[4]);
}
// echo "Доллар - ".$dollar."<br>";
// echo "Евро - ".$euro."<br>";

if ($dollar!="" && $dollar!="") {
    $somecontent = $dollar."\n".$euro."\n";
    $fp = fopen('currency.txt', 'w'); // записываем курс в файл currency.txt
    fwrite($fp, $somecontent);
    fclose($fp);
}

?>