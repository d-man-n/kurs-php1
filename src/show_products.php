<?php

/**
 * Получить список товаров с учетом фильтров
 * 
 * @param integer id текущего элемента каталога
 * @param integer признак "новинка"
 * @param integer признак "распродажа"
 * @param string поле по которому будет сортировка
 * @param string направление сортировки
 * @param integer минимальная цена
 * @param integer максимальная цена
 * @param string номер страницы
 * @return array данные о товарах
 */

function showProducts($catalog_id, $new, $sale, $sort, $order, $priceBegin, $priceEnd, $page) 
{
  
    $catalog_select = $catalog_id != 1 ? " `catalog_product`.`catalog_id` = " . $catalog_id . " AND " : "";
    $catalog_join = $catalog_id != 1 ? " LEFT JOIN `catalog_product` ON `catalog_product`.`id_product` = `products`.`id` " : "";
    $new_select = $new == 1 ? " `products`.`new` = 1 AND " : "";
    $sale_select = $sale == 1 ? " `products`.`sale` = 1 AND " : "";
    $min_price_select = $priceBegin > 0 ? " `products`.`price` >= " . $priceBegin . " AND " : "";
    $max_price_select = $priceEnd > 0 ? " `products`.`price` <= " . $priceEnd . " AND " : "";

    $sql = "SELECT `products`.`id` as `id`, 
                    `products`.`name` as `name`, 
                    `products`.`price` as `price`, 
                    `images`.`image` as `image`
            FROM `products` 
            LEFT JOIN `images` ON `products`.`id` = `images`.`id_product` " .
            $catalog_join
            . " WHERE " . $catalog_select . $new_select . $sale_select . $min_price_select . $max_price_select
            . " `products`.`id` > 0 ORDER BY `" . $sort . "` " . $order;

    $res_count = mysqli_query(connect(), $sql);

    $res = mysqli_query(connect(), $sql . " LIMIT 6 OFFSET " . ($page - 1) * 6);
    
    $lines = [];

    while($row = mysqli_fetch_assoc($res)) {
        $lines[] = $row;
    }
    return [$lines, mysqli_num_rows($res_count)];
}
