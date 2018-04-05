<?php

function make_excerpt($string, $length = 24){
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($string)));
    return str_limit($excerpt, $length, '...');
}