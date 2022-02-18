<?php

if(file_exists('robots.load')) {
    $text = file_get_contents('robots.load');
    $domain = $_SERVER['HTTP_HOST'];
    $subdomain = false;
    if(mb_substr_count($domain, '.') == 2) {
        list($subdomain, $domain) = explode('.', $domain, 2);
    }

    $pattern = "/(www\.|){$domain}/";
    $text = preg_replace($pattern, $_SERVER['HTTP_HOST'], $text);

    header('Content-Type: text/plain');
    echo $text;
}