<?php
/** @var array $sidebar - Меню */
/** @var array $goods - Новость */
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
                    <h2>Редактирование товара</h2>
                    <form method="post" name="goods_add_form">
                        <div class="goods_add_form">
                            <div class="alert alert-danger <?= !empty($error_message) ? null : 'hidden' ?>">
                                <?= !empty($error_message) ? $error_message : null ?>
                            </div>
                            <?php if (!empty($goods)): ?>

                                <div class="input_box">
                                    <label for="field_name_product">Наименование товара</label>
                                    <input type="text"
                                           name="goods[name_product]"
                                           id="field_name_product"
                                           class="form-control"
                                           maxlength="120"
                                           value="<?= !empty($_POST['goods']['name_product']) ? $_POST['goods']['name_product']
                                               : !empty($goods['name_product']) ? $goods['name_product'] : '' ?>"
                                           placeholder="Введите наименование товара"
                                    >
                                </div>

                                <div class="input_box">
                                    <label for="field_price">Цена товара</label>
                                    <input type="text"
                                           name="goods[price]"
                                           id="field_price"
                                           class="form-control"
                                           maxlength="120"
                                           value="<?= !empty($_POST['goods']['price']) ? $_POST['goods']['price']
                                               : !empty($goods['price']) ? $goods['price'] : '' ?>"
                                           placeholder="Введите цену товара"
                                    >
                                </div>

                                <div class="input_box">
                                    <label for="field_grade">Сорт товара</label>
                                    <input
                                            name="goods[grade]"
                                            id="field_grade"
                                            placeholder="Введите сорт товара"
                                            value="<?= !empty($_POST['goods']['grade']) ? $_POST['goods']['grade']
                                                : !empty($goods['grade']) ? $goods['grade'] : '' ?>"
                                    >
                                </div>

                                <div class="input_box">
                                    <label for="field_weight">Вес упаковки</label>
                                    <input
                                            name="goods[weight]"
                                            id="field_weight"
                                            placeholder="Введите вес товара"
                                            value="<?= !empty($_POST['goods']['weight']) ? $_POST['goods']['weight']
                                                : !empty($goods['weight']) ? $goods['weight'] : '' ?>"
                                    >
                                </div>

                                <div class="input_box">
                                    <label for="field_description">Описание товара</label>
                                    <input
                                            name="goods[description]"
                                            id="field_description"
                                            placeholder="Введите описание товара"
                                            value="<?= !empty($_POST['goods']['description']) ? $_POST['goods']['description']
                                                : !empty($goods['description']) ? $goods['description'] : '' ?>"
                                    >
                                </div>

                                <div class="button_box">
                                    <button type="submit"
                                            name="btn_goods_edit_form"
                                            id="btnMainEditForm"
                                            class="btn btn-primary"
                                            value="1"
                                    >Редактировать
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>