<?php

if (isset($uri[1]) && $uri[1] == 'exit') {
    session_destroy();
    header("Location: /");
} else if ($_SESSION['id_user'] == 0) {
    if (isset($_POST['login_ok'])){
        $user = getUser($_POST['login']);
        if ($user && $user['password'] == md5($_POST['password'])) {
            $_SESSION['id_user'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            if (in_array("Администраторы", isAdmin($_SESSION['id_user']))) {
                $location = "/products/";
              } else if (in_array("Операторы", isAdmin($_SESSION['id_user']))) {
                $location = "/orders/";
              } else {
                $location = "/";
              }
            header("Location: " . $location);
        }
    }
} else {
    if (in_array("Администраторы", isAdmin($_SESSION['id_user']))) {
        $location = "/products/";
      } else if (in_array("Операторы", isAdmin($_SESSION['id_user']))) {
        $location = "/orders/";
      } else {
        $location = "/";
      }
    header("Location: " . $location);
}

?>
<main class="page-authorization">
  <h1 class="h h--1">Авторизация</h1>
  <form class="custom-form" action="/admin/" method="post">
    <input type="email" class="custom-form__input" name="login" required="" placeholder="Email">
    <input type="password" class="custom-form__input" name="password" required="" placeholder="Password">
    <button class="button" name="login_ok" type="submit">Войти в личный кабинет</button>
  </form>
</main>