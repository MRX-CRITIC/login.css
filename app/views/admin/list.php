<?php
/** @var array $sidebar - Меню */
/** @var string $role - Роль пользователя */

/** @var array $goods - Список товаров */

/** @var array $coming - Список прихода */

use app\lib\UserOperations;

?>

<link rel="stylesheet" href="/app/web/css/sidebar.css">
<link rel="stylesheet" href="/app/web/css/admin.css">
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

            <section class="link">
                <nav class="link-effect" id="link-effect">

                    <a href="" class="panel_admin">Список товаров</a>
                    <a href="" class="panel_admin">Список накладных</a>
                    <a href="" class="panel_admin">Инвентаризация</a>

                </nav>
            </section>


            <div class="page-content-inner">
                <h2>Меню администратора</h2>
                <div class="goods-block">
                    <div class="links_box text-end">
                        <a href="/admin/add">Добавить товар</a><br>
                        <a href="/admin/coming">Добавить приход</a>
                        <br>
                        <br>
                        <br>
                    </div>

                    <div class="cont">
                        <div class="goods">
                            <h2>Товары: </h2>
                            <br>
                            <?php if (!empty($goods)) : ?>
                                <div class="goods-list">
                                    <?php foreach ($goods as $item) : ?>
                                        <div class="goods-item">
                                            <h3>Наименование:
                                                <?= $item['name_product'] ?>

                                                <?php if ($role === UserOperations::RoleAdmin) : ?>
                                                    (<a href="/admin/edit?goods_id=<?= $item['id'] ?>">Редактировать</a>
                                                    <span> / </span>
                                                    <a href="/admin/delete?goods_id=<?= $item['id'] ?>">Удалить</a>)
                                                <?php endif ?>
                                            </h3>
                                            <div class="goods-price">Цена за ед. товара: $<?= $item['price'] ?></div>
                                            <div class="goods-grade">Сорт: <?= $item['grade'] ?></div>
                                            <div class="goods-weight">Вес упаковки: <?= $item['weight'] ?> кг</div>
                                            <div class="goods-description"> Описание: <?= $item['description'] ?></div>
                                        </div>
                                        <br>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="coming">
                            <h2>Накладные: </h2>
                            <br>
                            <?php if (!empty($coming)) : ?>
                                <div class="coming-list">
                                    <?php foreach ($coming as $item) : ?>
                                        <div class="coming-item">
                                            <h3>Наименование:
                                                <?= $item['name_product'] ?>

                                                <?php if ($role === UserOperations::RoleAdmin) : ?>
                                                    (<a href="/admin/edit?goods_id=<?= $item['id'] ?>">Редактировать</a>
                                                    <span> / </span>
                                                    <a href="/admin/delete?goods_id=<?= $item['id'] ?>">Удалить</a>)
                                                <?php endif ?>
                                            </h3>
                                            <div class="coming-count">Кол-во товара: <?= $item['count'] ?></div>

                                            <div class="coming-date">Дата:
                                                <?= date('d.m.Y H:i:s', strtotime($item['date_create'])) ?>
                                            </div>
                                            <div class="coming-user">Добавил сотрудник: <?= $item['user'] ?> </div>
                                            <div class="is_coming">Операция: <?= ($item['is_coming'] == 1) ? "Приход" : "Расход" ?></div>
                                        </div>
                                        <br>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
