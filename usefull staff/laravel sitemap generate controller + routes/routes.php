<?php
Route::get('/sitemap.xml', ['as' => 'sitemap', 'uses' => 'StaticController@sitemap']);
Route::get('/sitemap/generate', ['as' => 'sitemap-generate', 'uses' => 'SitemapController@generate']);
?>