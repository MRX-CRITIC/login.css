<?php
/** @var array $sidebar - Меню */
/** @var array $basket - Список товаров в корзине */

$sum = 0;
$quantity = array_count_values($_SESSION['carts'][$_SESSION['user']['id']]);

use app\lib\UserOperations;
?>

<link rel="stylesheet" href="/app/web/css/sidebar.css">
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
<script src="/app/web/js/sidebar.js" defer></script>


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
        <h2>Корзина</h2>
        <div class="main-block">
            <?php if (!empty($basket)) : ?>
                <div class="main-list">
                    <?php foreach ($basket as $item) : ?>
                        <div class="main-item">
                            <h3>Наименование:
                                <?= $item['name_product'] ?> (<a href="/basket/removal?goods_id=<?= $item['id'] ?>">Удалить</a>)
                            </h3>

                            <div class="main-price">Цена за ед. товара: $<?= $item['price'] ?></div>
                            <div class="main-weight">Вес упаковки: <?= $item['weight'] ?> кг</div>
                            <div class="main-id">Кол - во товара: <?= $quantity[$item['id']] ?></div>
                            <div class="">Итого за товар: $<?= $quantity[$item['id']] * $item['price'] ?></div>
                            <?php $sum += ($quantity[$item['id']] * $item['price']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <h3>Итого к оплате: $<?= $sum ?></h3>
        <a href="/basket/payment">Оплатить</a>

    </div>
</div>
