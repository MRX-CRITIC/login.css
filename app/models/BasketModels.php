<?php

namespace app\models;

use app\core\BaseModel;
use app\lib\UserOperations;

class BasketModels extends BaseModel
{

    public function getBasket()
    {
        $result = null;

        $cart = $_SESSION['carts'][$_SESSION['user']['id']];
        $srt = implode(',', $cart);

//                $basket = $this->select('SELECT name_product, price, weight, id FROM goods WHERE id = :id', [
//                        'id' => $cart
//                    ]
//                );


        $basket = $this->select('
            SELECT name_product, price, weight, id
            FROM goods
            WHERE id in (' . $srt . ')
        ');

        if (!empty($basket)) {
            $result = $basket;
        }

        return $result;
    }

    public function removalById($goods_id)
    {
        $result = false;
        $error_message = '';
        $goods = $_SESSION['carts'][$_SESSION['user']['id']];

        if (empty($goods_id)) {
            $error_message .= 'Отсутствует идентификатор записи!<br>';
        }

        if (!empty($goods)) {
            if (empty($error_message)) {
                foreach ($goods as $key => $value) {
                    if ($value == $goods_id) {
                        unset($_SESSION['carts'][$_SESSION['user']['id']][$key]);
                        $result = true;
                        break;
                    }
                }
            }
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function payment($goods_id)
    {
        $result = false;
        $error_message = '';


        if (empty($error_message)) {
            $order_id = $this->insert(
                "INSERT INTO orders (user_id) 
                        VALUES (:user_id)",
                [
                    'user_id' => $_SESSION['user']['id']
                ]
            );

            foreach ($goods_id as $good_id) {
                $this->insert(
                    "INSERT INTO order_goods (goods_id, order_id) 
                           VALUES (:goods_id, :order_id)",
                    [
                        'goods_id' => $good_id,
                        'order_id' => $order_id
                    ]
                );
            }
            $this->createSpend($order_id);
            $result = true;
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    private function createSpend($order_id)
    {

        $user_register = 'Реализация';

        $goods = $this->select(
            'select count(goods_id) as count, goods_id from order_goods
                    where order_id = :order_id
                    group by goods_id', [
            'order_id' => $order_id
        ]);

        foreach ($goods as $good) {
            $a = $this->insert('INSERT INTO coming (count, good_id, is_coming) values (:count, :good_id, 0)', [
                'count' => $good['count'],
//                'user_id' => $user_register,
                'good_id' => $good['goods_id'],
            ]);
//            var_dump($a);
//            die();
        }

    }

}