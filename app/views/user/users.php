<?php
/** @var array $sidebar - Меню */
/** @var array $users - Список пользователей */

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
                    <h2>Пользователи</h2>
                    <div class="news-block">
                        <div class="links_box text-end">
                            <a href="/user/add">Добавить</a>
                        </div>
                        <?php if (!empty($users)) : ?>
                            <div class="news-list">
                                <?php foreach ($users as $user) : ?>
                                    <div class="news-item">
                                        <h3>
                                            Имя: <?= $user['username'] ?>
                                            (<a href="/user/edit/?user_id=<?= $user['id'] ?>">Редактировать</a>
                                            <a href="/user/delete/?user_id=<?= $user['id'] ?>">Удалить</a>)
                                        </h3>
                                        <div class="user-login">Логин: <?= $user['login'] ?></div>
                                        <div class="user-is_admin">Является администратором:
                                            <?= ($user['is_admin'] === '1') ? 'Да' : 'Нет' ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </dib>
            </div>
        </div>
    </div>
</div>