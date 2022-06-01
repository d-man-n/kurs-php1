<?php

/**
 * Функция для подключения к БД
 * 
 * @return object ссылка на подключене к БД
 */

function connect() 
{
    static $connection = null;

    if (null === $connection) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('connection Error');
        $connection->set_charset("utf8");
    }

    return $connection;
}
