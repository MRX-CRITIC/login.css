<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\BasketModels;

class BasketController extends InitController
{
    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['cart'],
                        'roles' => [UserOperations::RoleUser, UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ],
                ]
            ]
        ];
    }

    public function actionCart()
    {
        $this->view->title = 'Корзина';

        if (empty($_SESSION['carts'][$_SESSION['user']['id']])) {
            $_SESSION['carts'][$_SESSION['user']['id']] = [];
        }
        $basket_model = new BasketModels();
        $basket = $basket_model->getBasket();

        $this->render('cart', [
            'sidebar' => UserOperations::getMenuLinks(),
            'basket' => $basket,
            'role' => UserOperations::getRoleUser(),
        ]);
    }

    public function actionRemoval()
    {
        $this->view->title = 'Удаление товара из корзины';

        $goods_id = !empty($_GET['goods_id']) ? $_GET['goods_id'] : null;
        $error_message = '';
        $result_removal = null;


        if (!empty($goods_id)) {
            $goods_model = new BasketModels();
            $result_removal = $goods_model->removalById($goods_id);
            if ($result_removal['result']) {
                $this->redirect('/basket/cart');
            } else {
                $error_message = $result_removal['error_message'];
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }

        $this->render('removal', [
            'sidebar' => UserOperations::getMenuLinks(),
            'goods_id' => $goods_id,
            'error_message' => $error_message
        ]);
    }

    public function actionPayment()
    {
        $this->view->title = 'Оплата';

        $error_message = '';
        $result_payment = null;
        $goods_id = null;

        if (!empty($_SESSION['carts'][$_SESSION['user']['id']])) {
            $goods_id = $_SESSION['carts'][$_SESSION['user']['id']];
        }

        $goods_payment = new BasketModels();
        $result_payment = $goods_payment->payment($goods_id);
        if ($result_payment['result']) {
            $_SESSION['carts'][$_SESSION['user']['id']] = [];
            $this->redirect('/basket/cart');
        } else {
            $error_message = $result_payment['error_message'];
        }


        $this->render('payment', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message
        ]);
    }




}