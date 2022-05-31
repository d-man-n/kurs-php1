<?php

/**
 * Получить список оформленных заказов
 * 
 * @return array данные оформленных заказов
 */

function getOrders() 
{
    $sql = "SELECT `orders`.`id` AS `id`, 
                    `orders`.`name` AS `name`, 
                    `orders`.`phone` AS `phone`, 
                    `orders`.`email` AS `email`, 
                    `orders`.`address` AS `address`, 
                    `orders`.`price` AS `price`, 
                    `orders`.`delivery` AS `delivery`,   
                    `orders`.`comment` AS `comment`, 
                    `orders`.`status` AS `status`, 
                    `order_pay`.`name` AS `order_pay`, 
                    `delivery_order`.`name` AS `delivery_order` 
                FROM `orders` 
                LEFT JOIN `order_pay` ON `order_pay`.`id` = `orders`.`pay` 
                LEFT JOIN `delivery_order` ON `delivery_order`.`id` = `orders`.`delivery`
                ORDER BY `status`, `orders`.`cdate` DESC";

    $res = mysqli_query(connect(), $sql);
    $lines = [];

    while($row = mysqli_fetch_assoc($res)) {
      $lines[] = $row;
    }

    return $lines;
}