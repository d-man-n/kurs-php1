<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/header.php');

switch($_GET['id']) {
    case 'admin':
        include_once $_SERVER['DOCUMENT_ROOT'] . '/route/admin.php';
        break;
    case 'products':
        include_once $_SERVER['DOCUMENT_ROOT'] . '/route/products.php';
        break;
    case 'orders':
        include_once $_SERVER['DOCUMENT_ROOT'] . '/route/orders.php';
        break;
    case 'delivery':
        include_once $_SERVER['DOCUMENT_ROOT'] . '/route/delivery.php';
        break;
    case '' :
    case 'catalog' :
        include_once $_SERVER['DOCUMENT_ROOT'] . '/route/catalog.php';
        break;
    case 'cart' :
        include_once $_SERVER['DOCUMENT_ROOT'] . '/route/cart.php';
        break;
    case 'noauth' :
        include_once $_SERVER['DOCUMENT_ROOT'] . '/route/noauth.php';
        break;
    default :
        include_once $_SERVER['DOCUMENT_ROOT'] . '/route/404.php';
        break;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/template/footer.php');
