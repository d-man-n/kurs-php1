<?php

/**
 * Создание и редактирование товаров
 */

session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/core.php');

if (isset($_POST['product-id']) && $_POST['product-id'] > 0) {
    //Данные для сохранения товара
    $productName = mysqli_real_escape_string(connect(), $_POST['product-name']);
    $productPrice = mysqli_real_escape_string(connect(), $_POST['product-price']);
    $new = isset($_POST['new']) ? 1 : 0;
    $sale = isset($_POST['sale']) ? 1 : 0;

    //Сохранение изменений о товаре
    mysqli_query(connect(), "UPDATE `products` SET `name` = '" . $productName . "', `price` = '" . $productPrice . "', `new` = " . $new . ", `sale` = " . $sale . " WHERE `id` = " . $_POST['product-id']);

    //Сохранение изменений привязки товара к каталогу
    mysqli_query(connect(), "DELETE FROM `catalog_product` WHERE `id_product` = " . $_POST['product-id']);
    foreach($_POST['catalog'] as $catalog_id) {
        mysqli_query(connect(), "INSERT INTO `catalog_product` (`catalog_id`, `id_product`) VALUES (" . $catalog_id . ", " . $_POST['product-id'] . ")");
    }

    //Если изменилась картинка товара
    if ($_FILES['product-photo']['name'] != "") {
        //Удаление старого файла
        $res = mysqli_query(connect(), "SELECT `image` FROM `images` WHERE `id_product` = " . $_POST['product-id']);
        unlink($_SERVER['DOCUMENT_ROOT'] . "/img" . mysqli_fetch_assoc($res)['image']);

        //Данные для загрузки файла
        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/img/products/';
        $uploadfile = $uploaddir . basename($_FILES['product-photo']['name']);

        //Загрузка нового файла
        if (move_uploaded_file($_FILES['product-photo']['tmp_name'], $uploadfile)) {
            mysqli_query(connect(), "UPDATE `images` SET `image` = '/products/" . basename($_FILES['product-photo']['name']) . "' WHERE `id_product` = " . $_POST['product-id']);
        } else {
            echo "error";
        }
    }
} else {
    //Данные для загрузки файла
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/img/products/';
    $uploadfile = $uploaddir . basename($_FILES['product-photo']['name']);

    //Данные для сохранения товара
    $productName = mysqli_real_escape_string(connect(), $_POST['product-name']);
    $productPrice = mysqli_real_escape_string(connect(), $_POST['product-price']);
    $new = isset($_POST['new']) ? 1 : 0;
    $sale = isset($_POST['sale']) ? 1 : 0;

    //Сохранение нового товара
    mysqli_query(connect(), "INSERT INTO `products` (`name`, `description`, `price`, `new`, `sale`, `cdate`) VALUES ('" . $productName . "', 'Новый товар', '" . $productPrice . "', " . $new . ", " . $sale . ", '" . date("Y-m-d H:i:s") . "')");
    $id = mysqli_insert_id(connect());

    //Сохранение привязки товара к каталогу
    foreach($_POST['catalog'] as $catalog_id) {
        mysqli_query(connect(), "INSERT INTO `catalog_product` (`catalog_id`, `id_product`) VALUES (" . $catalog_id . ", " . $id . ")");
    }
    
    //Сохранение картинки товара
    if (move_uploaded_file($_FILES['product-photo']['tmp_name'], $uploadfile)) {
        mysqli_query(connect(), "INSERT INTO `images` (`id_product`, `sort`, `image`) VALUES (" . $id . ", 0, '/products/" . basename($_FILES['product-photo']['name']) . "')");
    } else {
        echo "error";
    }
}

