<?php

function make_excerpt($string, $length = 23){
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($string)));
    return str_limit($excerpt, $length, '...');
}

function make_link($article) {
    $id = $article->id;
    $title = $article->title;

    $url = config('app.url') . '/articles/' . $id;

    return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
}
