<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperations;
use app\models\AdminModels;

class AdminController extends InitController
{
    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['list'],
                        'roles' => [UserOperations::RoleAdmin],
                        'matchCallback' => function () {
                            $this->redirect('/main/index');
                        }
                    ],
                ]
            ]
        ];
    }

    public function actionList()
    {
        $this->view->title = 'Панель администратора';

        $goods_model = new AdminModels();
        $goods = $goods_model->getListMain();
        $coming = $goods_model->getListComing();

        $this->render('list', [
            'sidebar' => UserOperations::getMenuLinks(),
            'goods' => $goods,
            'role' => UserOperations::getRoleUser(),
            'coming' => $coming
        ]);
    }

    public function actionAdd()
    {
        $this->view->title = 'Добавление товара';

        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_goods_add_form'])) {

            $goods_data = !empty($_POST['goods']) ? $_POST['goods'] : null;

            if (!empty($goods_data)) {
                $goodsModel = new AdminModels();
                $result_add = $goodsModel->add($goods_data);
                if ($result_add['result']) {
                    $this->redirect('/admin/list');
                } else {
                    $error_message = $result_add['error_message'];
                }
            }
        }

        $this->render('add', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message
        ]);
    }

    public function actionComing()
    {
        $this->view->title = 'Приход';

        $error_message = '';
        $goodsModel = new AdminModels();
        $list = $goodsModel->getListMain();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_coming_add_form'])) {

            $goods_data = !empty($_POST['coming']) ? $_POST['coming'] : null;

            if (!empty($goods_data)) {
                $result_coming = $goodsModel->coming($goods_data);
                if ($result_coming['result']) {
                    $this->redirect('/admin/list');
                } else {
                    $error_message = $result_coming['error_message'];
                }
            }
        }
        $this->render('coming', [
            'sidebar' => UserOperations::getMenuLinks(),
            'error_message' => $error_message,
            'list' => $list
        ]);
    }

    public function actionEdit()
    {
        $this->view->title = 'Редактирование товара';

        $goods_id = !empty($_GET['goods_id']) ? $_GET['goods_id'] : null;
        $goods = null;
        $error_message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btn_goods_edit_form'])) {

            $goods_data = !empty($_POST['goods']) ? $_POST['goods'] : null;

            if (!empty($goods_data)) {
                $goodsModel = new AdminModels();
                $result_edit = $goodsModel->edit($goods_id, $goods_data);
                if ($result_edit['result']) {
                    $this->redirect('/admin/list');
                } else {
                    $error_message = $result_edit['error_message'];
                }
            }
        }

        if (!empty($goods_id)) {
            $goods_model = new AdminModels();
            $goods = $goods_model->getMainById($goods_id);
            if (empty($goods)) {
                $error_message = 'Товар не найден!';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи!';
        }

        $this->render('edit', [
            'sidebar' => UserOperations::getMenuLinks(),
            'goods' => $goods,
            'error_message' => $error_message
        ]);
    }

    public function actionDelete()
    {
        $this->view->title = 'Удаление товара';

        $goods_id = !empty($_GET['goods_id']) ? $_GET['goods_id'] : null;
        $goods = null;
        $error_message = '';

        if (!empty($goods_id)) {
            $goods_model = new AdminModels();
            $goods = $goods_model->getMainById($goods_id);
            if (!empty($goods)) {
                $result_delete = $goods_model->deleteById($goods_id);
                if ($result_delete['result']) {
                    $this->redirect('/admin/list');
                } else {
                    $error_message = $result_delete['error_message'];
                }
            } else {
                $error_message = 'Товар не найден!';
            }
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