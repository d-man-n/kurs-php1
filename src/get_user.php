<?php

/**
 * Функции для работы с пользователями
 */

 /**
 * Получить данные пользователя по его логину
 * 
 * @param string логин пользователя
 * @return array данные пользователя
 */

function getUser($username) 
{
    $username = mysqli_real_escape_string(connect(), $username);
    $res = mysqli_query(connect(), "SELECT * from `users` WHERE email = '" . $username . "'");
    return mysqli_fetch_assoc($res);
}

 /**
 * Получить список групп для текущего пользователя
 * 
 * @param integer id пользователя
 * @return array список групп
 */

function isAdmin($id) 
{
    $sql = "SELECT `groups`.`name` AS `name` 
                FROM `users` 
                LEFT JOIN `group_user` ON `users`.`id` = `group_user`.`id_user` 
                LEFT JOIN `groups` ON `groups`.`id` = `group_user`.`id_group`
                WHERE `users`.`id` = " . $id;

    $res = mysqli_query(connect(), $sql);

    $lines = [];

    while($row = mysqli_fetch_assoc($res)) {
        $lines[] = $row['name'];
    }
    return $lines;
}
