<?php
/** @var array $sidebar - Меню */
/** @var array $order - Заказ */
$sum = 0;

use app\lib\UserOperations;

?>

<link rel="stylesheet" href="/app/web/css/order.css">
<link rel="stylesheet" href="/app/web/css/sidebar.css">
<script src="/app/web/js/sidebar.js" defer></script>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

<div class="page">
    <div class="container">
        <div class="cabinet_wrapped">

            <div class="cabinet_sidebar">
                <div class="l-navbar" id="navbar">
                    <nav class="nav">
                        <div>
                            <div class="nav__brand">
                                <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                                <a href="#" class="nav__logo"></a></div>
                            <?php if (!empty($sidebar)) : ?>
                                <div class="menu_box">
                                    <ul>
                                        <?php foreach ($sidebar as $link) : ?>
                                            <li>
                                                <span class="nav__name">
                                                    <a href="<?= $link['link'] ?>" class="nav__link">
                                                        <img src="<?= $link['image'] ?>" alt="">
                                                        <?= $link['title'] ?>
                                                    </a>
                                                </span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                    </nav>
                </div>
            </div>

            <div class="cabinet_content">
                <div class="page-content-inner">
                    <div class="title">
                        <h2>Заказ № <?= $_GET['order_id'] ?></h2>
                        <div>Дата заказа: <?= $order[0]['date_create'] ?></div>
                    </div>
                    <div class="order-block">
                        <?php if (!empty($order)) : ?>
                        <div class="order-list">
                            <?php foreach ($order

                                           as $item) : ?>
                            <div class="order-item">
                                <h3>Наименование товара: <?= $item['name_product'] ?></h3>
                                <div class="">Вес товара: <?= $item['weight'] ?> кг</div>
                                <div class="">Цена за единицу товара: $<?= $item['price'] ?></div>
                                <?php $sum += $item['price']; ?>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <h2 class="sum">Итого оплачено за заказ: $<?= $sum ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
