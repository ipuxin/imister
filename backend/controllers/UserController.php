<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/28
 * Time: 23:13
 */
namespace backend\controllers;

use yii\web\Controller;

class UserController extends Controller
{
    /**
     * @var string
     * 设定公共视图文件
     */
    public $layout = 'empty';

    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionAdd()
    {
        return $this->render('add');
    }
}