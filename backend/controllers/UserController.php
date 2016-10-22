<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/28
 * Time: 23:13
 */
namespace backend\controllers;

use yii\web\Controller;
use Yii;
use common\models\User;
use yii\data\Pagination;

class UserController extends Controller
{
    public $layout = 'empty';

    /**
     * @return string
     * 显示
     */
    public function actionIndex()
    {
        $model = User::find();
        $pagination = new Pagination(['totalCount' => $model->count(), 'pageSize' => 3]);
        $result = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index', ['result' => $result, 'pagination' => $pagination]);
    }

    /**
     * @return string
     * 后台;添加用户
     */
    public function actionAdd()
    {
        $model = new User();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            echo 'success';
        }
        return $this->render('add', ['model' => $model]);
    }
}