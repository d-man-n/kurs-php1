<?php

if (!in_array("Администраторы", isAdmin($_SESSION['id_user'])) && !in_array("Операторы", isAdmin($_SESSION['id_user']))) {
  header("Location: /noauth/");
}

$orders = getOrders();

?>
<main class="page-order">
  <h1 class="h h--1">Список заказов</h1>
  <ul class="page-order__list">

    <?php foreach($orders as $order): ?>

      <li class="order-item page-order__item">
        <div class="order-item__wrapper">
          <div class="order-item__group order-item__group--id">
            <span class="order-item__title">Номер заказа</span>
            <span class="order-item__info order-item__info--id"><?=$order['id']?></span>
          </div>
          <div class="order-item__group">
            <span class="order-item__title">Сумма заказа</span>
            <?=$order['price']?> руб.
          </div>
          <button class="order-item__toggle"></button>
        </div>
        <div class="order-item__wrapper">
          <div class="order-item__group order-item__group--margin">
            <span class="order-item__title">Заказчик</span>
            <span class="order-item__info"><?=$order['name']?></span>
          </div>
          <div class="order-item__group">
            <span class="order-item__title">Номер телефона</span>
            <span class="order-item__info"><?=$order['phone']?></span>
          </div>
          <div class="order-item__group">
            <span class="order-item__title">Способ доставки</span>
            <span class="order-item__info"><?=$order['delivery_order']?></span>
          </div>
          <div class="order-item__group">
            <span class="order-item__title">Способ оплаты</span>
            <span class="order-item__info"><?=$order['order_pay']?></span>
          </div>
          <div class="order-item__group order-item__group--status">
            <span class="order-item__title">Статус заказа</span>
            <span class="order-item__info <?=$order['status'] == 0 ? "order-item__info--no" : "order-item__info--yes"?>"><?=$order['status'] == 0 ? "Не выполнено" : "Выполнено"?></span>
            <button class="order-item__btn">Изменить</button>
          </div>
        </div>
        <div class="order-item__wrapper">
          <div class="order-item__group">
            <span class="order-item__title">Адрес доставки</span>
            <span class="order-item__info"><?=$order['delivery'] == 2 ? $order['address'] : $order['delivery_order']?></span>
          </div>
        </div>
        <div class="order-item__wrapper">
          <div class="order-item__group">
            <span class="order-item__title">Комментарий к заказу</span>
            <span class="order-item__info"><?=$order['comment']?></span>
          </div>
        </div>
      </li>

    <?php endforeach; ?>

  </ul>
</main>