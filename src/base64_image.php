<?php

/**
 * Преобразование изображение из файла в формат base64
 * 
 * @param string url файла с изображением
 * @return string закодированая строка
 */

function insert_base64_encoded_image_src($img) 
{
    $img = $_SERVER['DOCUMENT_ROOT'] . "/img" . $img;
	$imageSize = getimagesize($img);
	$imageData = base64_encode(file_get_contents($img));
	$imageSrc = "data:{$imageSize['mime']};base64,{$imageData}";

    return $imageSrc;
}