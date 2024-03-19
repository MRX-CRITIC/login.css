<?php
/** @var array $sidebar - Меню */

/** @var array $main - Список товаров */

use app\lib\UserOperations;

?>

<link rel="stylesheet" href="/app/web/css/sidebar.css">
<link rel="stylesheet" href="/app/web/css/index.css">
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
<script src="/app/web/js/sidebar.js" defer></script>

<div class="page">
    <div class="container">
        <div class="cabinet_wrapped">

            <div class="cabinet_sidebar">
                <div class="l-navbar" id="navbar">
                    <nav class="nav">
                        <div>

                            <div class="nav__brand">
                                <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                                <a href="#" class="nav__logo"></a>
                            </div>

                            <?php if (!empty($sidebar)) : ?>
                                <div class="menu_box">
                                    <ul>
                                        <?php foreach ($sidebar as $link) : ?>
                                            <li>
                                                <span class="nav__name">
                                                    <a href="<?= $link['link'] ?>" class="nav__link">
                                                        <img src="<?= $link['image'] ?>" alt=" ">
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
                    <h2>Главная страница</h2>
                    <div class="main-block">
                        <?php if (!empty($main)) : ?>
                            <div class="main-list">
                                <?php foreach ($main as $item) : ?>
                                    <div class="main-item">
                                        <h3>Наименование:
                                            <?= $item['name_product'] ?>
                                        </h3>
                                        <div class="main-price">Цена за ед. товара: $<?= $item['price'] ?></div>
                                        <div class="main-grade">Сорт: <?= $item['grade'] ?></div>
                                        <div class="main-weight">Вес упаковки: <?= $item['weight'] ?> кг</div>
                                        <div class="main-description">Описание: <?= $item['description'] ?></div>
                                        <div class="a_div">
                                            <a class="a" href="/main/tocart?goods_id=<?= $item['id'] ?>">
                                                <img src="/app/web/image/cart-plus.png" class="img_cart_plus" alt="">Добавить в корзину
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>