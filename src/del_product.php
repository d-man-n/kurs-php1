<?php

/**
 * Удаление товара
 */

session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/core.php');

//Удаление файла
$res = mysqli_query(connect(), "SELECT `image` FROM `images` WHERE `id_product` = " . $_POST['id']);
unlink($_SERVER['DOCUMENT_ROOT'] . "/img" . mysqli_fetch_assoc($res)['image']);

//Удаление товара
mysqli_query(connect(), "DELETE FROM `products` WHERE `id` = " . $_POST['id']);
