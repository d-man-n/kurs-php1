<?php

/**
 * Вывести дерево каталога
 */

function showCatalog() 
{
    $res = mysqli_query(connect(), "SELECT * from `catalog` ORDER BY `id`");
    ?>
        <ul class="filter__list">
            <?php while($row = mysqli_fetch_assoc($res)): ?>

                <li>
                    <a class="filter__list-item" href="<?=$row['alias'] == 'all' ? '/' : '/catalog/' . $row['alias'] . '/'?>"><?=$row['name']?></a>
                </li>

            <?php endwhile; ?>
        </ul>
    <?php
}