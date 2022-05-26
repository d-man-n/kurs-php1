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
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'php1';
        $connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName) or die('connection Error');
        $connection->set_charset("utf8");
    }

    return $connection;
}