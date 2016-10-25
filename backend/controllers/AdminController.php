<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/14
 * Time: 23:35
 */
namespace backend\controllers;

use Yii;

class AdminController extends CommonController
{
    public $layout = 'empty';

    public function beforeAction($action)
    {
        /**
         * 登录验证:
         * 先让父类:CommonController的beforeAction执行
         */
        if (parent::beforeAction($action)) {
            if (!$this->userId) {
                return Yii::$app->response->redirect(['login/index']);
            }
            return true;
        }
        return false;
    }
}