<?php

function make_excerpt($string, $length = 22){
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($string)));
    return str_limit($excerpt, $length, '...');
}

function make_link($article) {
    $id = $article->id;
    $title = $article->title;

    $url = config('app.url') . '/articles/' . $id;

    return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
}

function uploadFileThumbnail($file, $folder, $file_prefix,  $width, $height)
{
    $folder_name = "uploads/images/$folder" . date("Ym/d", time());
    $dir = public_path() . '/' . "uploads/images/$folder" . date("Ym/d", time());
    dd($dir);
    if(!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
    if(!empty($file)) {
        $destinationPath = public_path() . '/' . $folder_name;
        $file = str_replace('data:image/jpeg;base64,', '', $file);
        $img = str_replace(' ', '+', $file);
        $data = base64_decode($img);
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.png';
        $file = $destinationPath . '/' . $filename;
        $success = file_put_contents($file, $data);

        // THEN RESIZE IT
        $returnData = $folder_name . '/' . $filename;
        $image = Image::make(file_get_contents(URL::asset($returnData)));
        $image = $image->resize($width,$height)->save($destinationPath . '/' . $filename);

        if($success){
            return config('app.url') . '/' . $returnData;
        }
    }
}
