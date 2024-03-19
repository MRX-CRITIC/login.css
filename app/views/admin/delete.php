<?php
/** @var array $sidebar - Меню */

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

            <div class="cabinet_content">
                <div class="page-content-inner">
                    <h2>Удаление товара</h2>
                    <form method="post" name="goods_delete_form">
                        <div class="goods_add_form">
                            <div class="alert alert-danger <?= !empty($error_message) ? null : 'hidden' ?>">
                                <?= !empty($error_message) ? $error_message : null ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>