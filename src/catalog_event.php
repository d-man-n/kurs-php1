<?php

/**
 * Получить id элемента каталога по его наименованию (которое отображается в ЧПУ url)
 * 
 * @param string наименование элемента каталога для отобржения в ЧПУ url
 * @return integer id элемента каталога
 */

function getCatalogIdByAlias($alias) 
{
    $alias = mysqli_real_escape_string(connect(), $alias);
    $res = mysqli_query(connect(), "SELECT `id` FROM `catalog` WHERE alias = '" . $alias . "'");
    $row = mysqli_fetch_assoc($res);

    return $row['id'];
}
