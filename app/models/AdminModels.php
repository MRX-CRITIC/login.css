<?php

namespace app\models;

use app\core\BaseModel;
use app\lib\UserOperations;

class AdminModels extends BaseModel
{
    public function add($goods_data)
    {

        $result = false;
        $error_message = '';


        if (empty($goods_data['price'])) {
            $error_message .= "Введите стоимость товара!<br>";
        }
        if (empty($goods_data['name_product'])) {
            $error_message .= "Введите наименование товара!<br>";
        }
        if (empty($goods_data['grade'])) {
            $error_message .= "Введите сорт товара!<br>";
        }
        if (empty($goods_data['weight'])) {
            $error_message .= "Введите вес товара!<br>";
        }
        if (empty($goods_data['description'])) {
            $error_message .= "Введите описание товара!<br>";
        }

        if (empty($error_message)) {
            $result = $this->insert(
                "INSERT INTO `online-shop-coffee`.goods (price, name_product, grade, weight, description, user_id) 
                        VALUES (:price, :name_product, :grade, :weight, :description, :user_id)",
                [
                    'price' => $goods_data['price'],
                    'name_product' => $goods_data['name_product'],
                    'grade' => $goods_data['grade'],
                    'weight' => $goods_data['weight'],
                    'description' => $goods_data['description'],
                    'user_id' => $_SESSION['user']['id']
                ]
            );
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function coming($coming_data)
    {

        $result = false;
        $error_message = '';


        if (empty($coming_data['good_id'])) {
            $error_message .= "Выберите товар!<br>";
        }
        if (empty($coming_data['count'])) {
            $error_message .= "Введите кол-во товара!<br>";
        }
        if (!isset($coming_data['type'])) {
            $error_message .= "Выберите вид операции!<br>";
        }

        if (empty($error_message)) {
            $result = $this->insert(
                "INSERT INTO `online-shop-coffee`.coming (good_id, count, date_create, user_id, is_coming) 
                        VALUES (:good_id, :count, NOW(), :user_id, :is_coming)",
                [
                    'good_id' => $coming_data['good_id'],
                    'count' => $coming_data['count'],
                    'user_id' => $_SESSION['user']['id'],
                    'is_coming' => $coming_data['type'],
                ]
            );
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function edit($goods_id, $goods_data)
    {

        $result = false;
        $error_message = '';


        if (empty($goods_id)) {
            $error_message .= "Отсутствует идентификатор записи!<br>";
        }
        if (empty($goods_data['price'])) {
            $error_message .= "Введите стоимость товара!<br>";
        }
        if (empty($goods_data['name_product'])) {
            $error_message .= "Введите наименование товара!<br>";
        }
        if (empty($goods_data['grade'])) {
            $error_message .= "Введите сорт товара!<br>";
        }
        if (empty($goods_data['weight'])) {
            $error_message .= "Введите вес товара!<br>";
        }
        if (empty($goods_data['description'])) {
            $error_message .= "Введите описание товара!<br>";
        }

        if (empty($error_message)) {
            $result = $this->update(
                "UPDATE `online-shop-coffee`.goods SET price = :price, name_product = :name_product, 
                            grade = :grade, weight = :weight, description = :description where id = :id",
                [
                    'price' => $goods_data['price'],
                    'name_product' => $goods_data['name_product'],
                    'grade' => $goods_data['grade'],
                    'weight' => $goods_data['weight'],
                    'description' => $goods_data['description'],
                    'id' => $goods_id
                ]
            );
        }

        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }

    public function getMainById($goods_id)
    {
        $result = null;

        $goods = $this->select('SELECT * FROM `online-shop-coffee`.goods where id = :id', [
                'id' => $goods_id
            ]
        );
        if (!empty($goods[0])) {
            $result = $goods[0];
        }
        return $result;
    }

    public function getListMain()
    {
        $result = null;

        $goods = $this->select('SELECT * FROM `online-shop-coffee`.goods');
        if (!empty($goods)) {
            $result = $goods;
        }
        return $result;
    }

    public function getListComing()
    {
        $result = null;

        $goods = $this->select('SELECT 
        g.name_product, coming.count, coming.date_create, u.username as user, coming.is_coming, coming.id 
        FROM `online-shop-coffee`.coming
        LEFT JOIN goods g on g.id = coming.good_id
        LEFT JOIN users u on u.id = coming.user_id;');

        if (!empty($goods)) {
            $result = $goods;
        }
        return $result;
    }

    public function deleteById($goods_id)
    {
        $result = false;
        $error_message = '';

        if (empty($goods_id)) {
            $error_message .= 'Отсутствует идентификатор записи!<br>';
        }
        if (empty($error_message)) {
            $result = $this->update('DELETE FROM `online-shop-coffee`.goods WHERE id = :id', [
                    'id' => $goods_id
                ]
            );
        }
        return [
            'result' => $result,
            'error_message' => $error_message
        ];
    }


}