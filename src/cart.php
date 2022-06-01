<?php

/**
 * Сохранение оформленного заказа
 */

session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/core.php');

if (!isset($_POST['surname']) || $_POST['surname'] == "") {
    die();
}

if (!isset($_POST['name']) || $_POST['name'] == "") {
    die();
}

if (!isset($_POST['phone']) || $_POST['phone'] == "") {
    die();
}

if (!isset($_POST['email']) || $_POST['email'] == "") {
    die();
}

if (isset($_POST['delivery']) && $_POST['delivery'] == 2) {
    if (!isset($_POST['city']) || $_POST['city'] == "") {
        die();
    }
    
    if (!isset($_POST['street']) || $_POST['street'] == "") {
        die();
    }
    
    if (!isset($_POST['home']) || $_POST['home'] == "") {
        die();
    }
    
    if (!isset($_POST['aprt']) || $_POST['aprt'] == "") {
        die();
    }    
}

if (isset($_POST['product']) && $_POST['product'] > 0) {
    $name = mysqli_real_escape_string(connect(), $_POST['surname']) . " " . mysqli_real_escape_string(connect(), $_POST['name']) . " " . mysqli_real_escape_string(connect(), $_POST['thirdName']);
    $phone = mysqli_real_escape_string(connect(), $_POST['phone']);
    $email = mysqli_real_escape_string(connect(), $_POST['email']);

    if (isset($_POST['delivery']) && $_POST['delivery'] == 2) {
        $address = mysqli_real_escape_string(connect(), $_POST['city']) . " " . mysqli_real_escape_string(connect(), $_POST['street']) . " " . mysqli_real_escape_string(connect(), $_POST['home']) . " " . mysqli_real_escape_string(connect(), $_POST['aprt']);
    } else {
        $address = "";
    }

    $comment = mysqli_real_escape_string(connect(), $_POST['comment']);

    $res_price = mysqli_query(connect(), "SELECT `price`FROM `products` WHERE `id` = " . $_POST['product']);
    $row = mysqli_fetch_assoc($res_price);
    $price = $row['price'] <= 2000 ? $row['price'] + 280 : $row['price'];

    $res =  mysqli_query(connect(), "INSERT INTO `orders` (`id_product`, `name`, `phone`, `email`, `delivery`, `address`, `pay`, `price`, `comment`, `status`, `cdate`) VALUES (" . $_POST['product'] . ", '" . $name . "', '" . $phone . "', '" . $email . "', '" . $_POST['delivery'] . "', '" . $address . "', '" . $_POST['pay'] . "', '" . $price . "', '" . $comment . "', '0', '" . date("Y-m-d H:i:s") . "');");

    if ($res) {
        echo 1;
    }
}
