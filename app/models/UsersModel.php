<?php

namespace app\models;

use app\core\BaseModel;

class UsersModel extends BaseModel
{
    public function addNewUser($username, $login, $password)
    {
        $error_message = '';
        $result = false;

        $user = $this->select("SELECT login FROM users WHERE login = :login", [
            'login' => $login
        ]);

        if (empty($user)) {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $result = $this->insert(
                "INSERT INTO users (username, login, password) VALUES (:username, :login, :password)",
                [
                    'username' => $username,
                    'login' => $login,
                    'password' => $password
                ]
            );

        } else {
            $error_message .= "Такой пользователь существует!<br>";
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function authByLogin($login, $password)
    {
        $result = false;
        $error_message = '';

        if (empty($login)) {
            $error_message .= "Введите логин!<br>";
        }
        if (empty($password)) {
            $error_message .= "Введите пароль!<br>";
        }
        if (empty($error_message)) {
            $users = $this->select('SELECT * FROM users where login = :login', [
                'login' => $login
            ]);

            if (!empty($users[0])) {
                $passwordCorrect = password_verify($password, $users[0]['password']);

                if ($passwordCorrect) {
                    $_SESSION['user']['id'] = $users[0]['id'];
                    $_SESSION['user']['username'] = $users[0]['username'];
                    $_SESSION['user']['login'] = $users[0]['login'];
                    $_SESSION['user']['is_admin'] = ($users[0]['is_admin'] == '1');

                    $result = true;
                } else {
                    $error_message .= "Неверный логин или пароль!<br>";
                }
            } else {
                $error_message .= "Неверный логин или пароль!<br>";
            }
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function changePasswordByCurrentPassword($current_password, $new_password, $confirm_new_password)
    {
        $result = false;
        $error_message = '';

        if (empty($current_password)) {
            $error_message .= "Введите текущий пароль!<br>";
        }
        if (empty($new_password)) {
            $error_message .= "Введите новый пароль!<br>";
        }
        if (empty($confirm_new_password)) {
            $error_message .= "Повторите новый пароль!<br>";
        }
        if ($new_password != $confirm_new_password) {
            $error_message .= "Пароли не совпадают!<br>";
        }

        if (empty($error_message)) {
            $users = $this->select('SELECT * from users where login = :login', [
                'login' => $_SESSION['user']['login']
            ]);

            if (!empty($users[0])) {
                $passwordCorrect = password_verify($current_password, $users['0']['password']);

                if ($passwordCorrect) {
                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $updatePassword = $this->update('update users set password = :password where login = :login', [
                        'login' => $_SESSION['user']['login'],
                        'password' => $new_password
                    ]);

                    $result = $updatePassword;
                } else {
                    $error_message .= "Неверный пароль!<br>";
                }
            } else {
                $error_message .= "Произошла ошибка при смене пароля!<br>";
            }
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function getListUsers()
    {
        $result = null;

        $users = $this->select('SELECT id, username, login, is_admin FROM USERS');
        if (!empty($users)) {
            $result = $users;
        }
        return $result;
    }

    public function getListOrders()
    {
        $result = null;

        $orders = $this->select(
            'select order_id, count(*), sum(price), sum(weight)
                from order_goods
                         left join goods g on order_goods.goods_id = g.id
                         left join orders o on o.id = order_goods.order_id
                where o.user_id = :id
                group by order_id', [

            'id' => $_SESSION['user']['id']
        ]);
        if (!empty($orders)) {
            $result = $orders;
        }
        return $result;
    }

    public function getListOrder($order_id)
    {
        $result = null;

        $order = $this->select(
            'select goods_id as id, name_product, price, grade, weight, date_create
                 from order_goods
                        left join goods g on order_goods.goods_id = g.id
                        left join orders o on o.id = order_goods.order_id
                where order_goods.order_id = :id', [
            'id' => $order_id
        ]);

        if (!empty($order)) {
            $result = $order;
        }
        return $result;
    }

}