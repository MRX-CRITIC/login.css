<?php
/** @var array $sidebar - Меню */
/** @var array $list - Продукты */


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
                    <h2>Добавление накладной</h2>
                    <form method="post" name="coming_add_form">
                        <div class="coming_add_form">
                            <div class="alert alert-danger <?= !empty($error_message) ? null : 'hidden' ?>">
                                <?= !empty($error_message) ? $error_message : null ?>
                            </div>

                            <select id="" name="coming[good_id]" required>

                                <?php foreach ($list as $product): ?>

                                    <option value="<?= $product['id'] ?>">
                                        <?= $product['name_product'] ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                            <div class="input_box">
                                <label for="field_count">Кол-во товара</label>
                                <input type="text"
                                       name="coming[count]"
                                       id="field_count"
                                       class="form-control"
                                       maxlength="120"
                                       value="<?= !empty($_POST['coming']['count'])
                                           ? $_POST['coming']['count']
                                           : ''
                                       ?>"
                                       placeholder="Введите кол-во товара"
                                >
                            </div>

                            <div class="input_box">
                                <label for="field_description">Вид операции</label>
                                <select
                                    name="coming[type]"
                                    id="field_description"
                                >
                                    <option value="1">Приход</option>
                                    <option value="0">Расход</option>
                                </select>
                            </div>

                            <div class="button_box">
                                <button type="submit"
                                        name="btn_coming_add_form"
                                        id="btnComingAddForm"
                                        class="btn btn-primary"
                                        value="1"
                                >Добавить
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
