<?php
/** @var array $sidebar - Меню */
/** @var array $orders - Список заказов */

use app\lib\UserOperations;

?>

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
                                                        <img src="<?= $link['image'] ?>">
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
                <dib class="page-content-inner">
                    <h2>Заказы</h2>
                    <div class="news-block">
                        <?php if (!empty($orders)) : ?>
                            <div class="news-list">
                                <?php foreach ($orders as $order) : ?>
                                    <div class="news-item">
                                        <h3>
                                            Номер заказа: <?= $order['order_id'] ?>
                                            (<a href="/user/order?order_id=<?= $order['order_id'] ?>">просмотр заказа</a>)
                                        </h3>

                                        <div class="">Оплаченная сумма: <?= $order['sum(price)'] ?></div>
                                        <div class="">Кол-во товаров: <?= $order['count(*)'] ?></div>
                                        <div class="">Вес заказа: <?= $order['sum(weight)'] ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </dib>
            </div>
        </div>
    </div>
</div>