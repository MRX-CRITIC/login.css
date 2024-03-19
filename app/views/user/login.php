<?php
/** @var string $error_message - Текст ошибки */
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app/web/css/login.css">
    <title></title>
</head>

<div class="l-form">

    <form name="auth_form" method="post" class="form">

        <h1 class="form__title">Авторизация</h1>
        <div class="error error_message" <?= !empty($error_message) ? null : 'hidden' ?>>
            <?= !empty($error_message) ? $error_message : null ?></div>

        <div class="form__div">
            <input type="text"
                   name="login"
                   id="field_login"
                   class="form__input"
                   maxlength="24"
                   value="<?= !empty($_POST['login']) ? $_POST['login'] : '' ?>"
                   placeholder=" "
            >
            <label for="field_login" class="form__label">Логин</label>
        </div>

        <div class="form__div">
            <input type="password"
                   name="password"
                   id="field_password"
                   class="form__input"
                   placeholder=" "
            >
            <label for="field_password" class="form__label">Пароль</label>
        </div>

        <div class="transition">
            <a href="/user/registration">Регистрация</a>
        </div>

        <button type="submit"
                name="btn_login_form"
                id="btnLoginForm"
                class="form__button"
                value="1"
        >Войти
        </button>

    </form>

</div>
</html>


