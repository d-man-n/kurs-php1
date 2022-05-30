<?php

/**
 * Вывести дерево меню (верхнее и нижнее)
 * 
 * @param string сортировка меню
 * @param string имя класса для элементов списка (отличается для разных типов меню)
 * @param string имя класса для ссылок (отличается для разных типов меню)
 * @param string признак меню админки или пользовательско части
 */

function showMenu($sort, $listClass, $linkClass, $admin) 
{
    global $uri;
    
    $res = mysqli_query(connect(), "SELECT * from `menu` WHERE `admin` IN (1, " . $admin . ") ORDER BY `" . $sort . "`");
    ?>
        <ul class="<?=$listClass?>">
            <?php while ($row = mysqli_fetch_assoc($res)): ?>
            <?php 
                if (isset($uri[1]) && isset(preg_split("/\//", $row['path'])[2]) && preg_split("/\//", $row['path'])[2] == $uri[1]) {
                    $active = "active";
                }
                else if (!isset(preg_split("/\//", $row['path'])[3]) && preg_split("/\//", $row['path'])[1] == $uri[0]) {
                    $active = "active";
                } else {
                    $active = "";
                }
            ?>
                <li>
                    <a class="<?=$linkClass . " " . $active?>" href="<?=$row['path']?>"><?=$row['name']?></a>
                </li>
            <?php
                endwhile; ?>
            <?php if ($_SESSION['id_user'] > 0): ?>
                <li>
                    <a class="<?=$linkClass?>" href="/admin/exit/">Выйти</a>
                </li>
            <?php endif; ?>
        </ul>
    <?php
}