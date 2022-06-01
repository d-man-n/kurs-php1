<?php

/**
 * Функции для работы с товарами
 */

 /**
 * Получить данные о товаре по его id
 * 
 * @param integer id товара
 * @return array все данные о товаре
 */

function getProductById($id) 
{
    $id = mysqli_real_escape_string(connect(), $id);
    $sql = "SELECT `products`.`id` AS `id`, 
                    `products`.`name` AS `name_product`, 
                    `products`.`price` AS `price`, 
                    `products`.`new` AS `new`, 
                    `products`.`sale` AS `sale`, 
                    `images`.`id` AS `image_id`,
                    `images`.`image` AS `image`
            FROM `products` 
            LEFT JOIN `images` ON `images`.`id_product` = `products`.`id`
            WHERE `products`.`id` = " . $id;
    $res = mysqli_query(connect(), $sql);
    return mysqli_fetch_assoc($res);
}

/**
 * Получить данные элементов каталога по id товара, который к ним принадлежит
 * 
 * @param string id товара
 * @return array данные элементов каталога
 */

function getCatalogByProductId($id) 
{
    $id = mysqli_real_escape_string(connect(), $id);
    $sql = "SELECT `catalog`.`id` AS `id`
            FROM `catalog` 
            LEFT JOIN `catalog_product` ON `catalog_product`.`catalog_id` = `catalog`.`id` 
            LEFT JOIN `products` ON `products`.`id` = `catalog_product`.`id_product` 
            WHERE `products`.`id` = " . $id;

    $res = mysqli_query(connect(), $sql);
    $lines = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $lines[] = $row['id'];
    }

    return $lines;
}

/**
 * Получить список всех товаров
 * 
 * @return array данные товаров
 */

function getProducts() 
{

    $res_product = mysqli_query(connect(), "SELECT * FROM `products` ORDER BY `name`");

    $lines_product = [];
    while ($row_product = mysqli_fetch_assoc($res_product)) {
        $res_catalog = mysqli_query(connect(), "SELECT `catalog`.`id` AS `id`, `catalog`.`name` AS `name` FROM `catalog` LEFT JOIN `catalog_product` ON `catalog_product`.`catalog_id` = `catalog`.`id` WHERE `catalog_product`.`id_product` = " . $row_product['id']);
        $lines_catalog = [];
        while ($row_catalog = mysqli_fetch_assoc($res_catalog)) {
            $lines_catalog[] = $row_catalog['name'];
        }

        $row_product["catalog"] = $lines_catalog;
        $lines_product[] = $row_product;
    }

    return $lines_product;
}

/**
 * Получить минимальную и максимальную цены для списка товаов на странице
 * 
 * @param integer id элемента каталога
 * @param integer признак товара "новинка"
 * @param integer признак товара "распродажа"
 * @return array массив с минимальной и максимальной ценой
 */

function getMinMaxPrice($catalog_id, $new, $sale) 
{
    $catalog_select = $catalog_id != 1 ? " `catalog_product`.`catalog_id` = " . $catalog_id . " AND " : "";
    $new_select = $new == 1 ? " `products`.`new` = 1 AND " : "";
    $sale_select = $sale == 1 ? " `products`.`sale` = 1 AND " : "";

    $sql = "SELECT MIN(`products`.`price`) AS `min_price`, 
                    MAX(`products`.`price`) AS `max_price`
            FROM `products` 
            LEFT JOIN `catalog_product` ON `catalog_product`.`id_product` = `products`.`id` 
            WHERE " . $catalog_select . $new_select . $sale_select . " `products`.`id` > 0";

    $res = mysqli_query(connect(), $sql);

    return mysqli_fetch_assoc($res);
}
