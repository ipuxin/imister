<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends AdminController
{

    /**
     * Displays homepage.
     * @return string
     */
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    /**
     * 后台中间整块部分
     */
    public function actionMain()
    {
        echo 'main';
    }

    /**
     * 注销
     */
    public function actionLagout()
    {
        \backend\models\LoginForm::lagout();
        return $this->redirect(['login/index']);
    }
}
