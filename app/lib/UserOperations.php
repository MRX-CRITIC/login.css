<?php

namespace app\lib;
class UserOperations
{
    const RoleGuest = 'guest';
    const RoleAdmin = 'admin';
    const RoleUser = 'user';

    public static function getRoleUser()
    {
        $result = self::RoleGuest;
        if (isset($_SESSION['user']['id']) && ($_SESSION['user']['is_admin'])) {
            $result = self::RoleAdmin;
        } elseif (isset($_SESSION['user']['id'])) {
            $result = self::RoleUser;
        }
        return $result;
    }

    public static function getMenuLinks()
    {
        $role = self::getRoleUser();
        $list[] = [
            'image' => '../app/web/image/main.png',
            'title' => 'Главная страница',
            'link' => '/main/index'
        ];
        $list[] = [
            'image' => '../app/web/image/basket.png',
            'title' => 'Корзина',
            'link' => '/basket/cart'
        ];
        $list[] = [
            'image' => '../app/web/image/profile.png',
            'title' => 'Мой профиль',
            'link' => '/user/profile'
        ];
        if ($role === self::RoleAdmin) {
            $list[] = [
                'image' => '../app/web/image/users.png',
                'title' => 'Пользователи',
                'link' => '/user/users'
            ];
            $list[] = [
                'image' => '../app/web/image/admin.png',
                'title' => 'Учет',
                'link' => '/admin/list'
            ];
        }
        $list[] = [
            'image' => '../app/web/image/exit.png',
            'title' => 'Выход',
            'link' => '/user/logout'
        ];
        return $list;
    }
}
