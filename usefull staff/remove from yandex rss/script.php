<?
// Вставлять в functions.php

function yturbo_replace_h1($content) {

    //что заменить
    $pattern = '/<td class="order" art=(.*?)><a href=(.*?)>(.*?)<\/a><\/td>/i';
    //на что заменить
    $replacement = '';
    //производим замену
    $content = preg_replace($pattern, $replacement, $content);

    return $content;
}
add_filter( 'yturbo_the_content', 'yturbo_replace_h1' );