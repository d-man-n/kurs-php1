<?php

/**
 * Изменение статуса заказа
 */

session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/core.php');

mysqli_query(connect(), "UPDATE `orders` SET `status` = '" . $_POST['status'] . "' WHERE `id` = " . $_POST['id']);
