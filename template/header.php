<?php
session_start();

// if (!isset($_GET['id'])) {
//   $_GET['id'] = "";
// }

if (!isset($_SESSION['id_user'])) {
  $_SESSION['id_user'] = 0;
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/src/core.php');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Fashion</title>

  <meta name="description" content="Fashion - интернет-магазин">
  <meta name="keywords" content="Fashion, интернет-магазин, одежда, аксессуары">

  <meta name="theme-color" content="#393939">

  <link rel="preload" href="/img/intro/coats-2018.jpg" as="image">
  <link rel="preload" href="/fonts/opensans-400-normal.woff2" as="font">
  <link rel="preload" href="/fonts/roboto-400-normal.woff2" as="font">
  <link rel="preload" href="/fonts/roboto-700-normal.woff2" as="font">

  <link rel="icon" href="/img/favicon.png">
  <link rel="stylesheet" href="/css/style.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
<header class="page-header">
  <a class="page-header__logo" href="#">
    <img src="/img/logo.svg" alt="Fashion">
  </a>
  <nav class="page-header__menu">
    <?=showMenu('sort', 'main-menu main-menu--header', 'main-menu__item', adminPage($uri[0]) == 2 ? 2 : 0)?>
  </nav>
</header>

        
 