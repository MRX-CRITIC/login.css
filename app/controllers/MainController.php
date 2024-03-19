<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\MainModels;

class MainController extends InitController
{

    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['index'],
                        'roles' => [UserOperations::RoleUser, UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/user/login');
                        }
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $this->view->title = 'Главная страница';

        $main_model = new MainModels();
        $main = $main_model->getListMain();

        $this->render('index', [
            'sidebar' => UserOperations::getMenuLinks(),
            'main' => $main,
            'role' => UserOperations::getRoleUser(),
        ]);
    }

    public function actionTocart()
    {
        $this->view->title = 'Добавление в корзину';

        $goods_id = !empty($_GET['goods_id']) ? $_GET['goods_id'] : null;
        $goods = null;
        $error_message = '';

        if (!empty($goods_id)) {
            $_SESSION['carts'][$_SESSION['user']['id']][] = $goods_id;

            $this->redirect('/main/index');
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }

        $this->render('delete', [
            'sidebar' => UserOperations::getMenuLinks(),
            'goods' => $goods,
            'error_message' => $error_message
        ]);

    }


}