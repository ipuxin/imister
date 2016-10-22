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
use common\helps\Tools;

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
            /**
             * 添加yii2自带的提示样式
             */
            Yii::$app->session->setFlash('success', '添加用户成功');
            return $this->redirect(['index']);
        }
        return $this->render('add', ['model' => $model]);
    }

    /**
     * @return string|\yii\web\Response
     * 后台编辑
     */
    public function actionEdit()
    {
        /**
         * 获取get过来的参数,设置默认值
         */
        $id = Yii::$app->request->get('id', 0);
        $model = User::findOne($id);
        /**
         * 如果不存在,就跳转到首页
         */
        if (!$model) return $this->redirect(['index']);
        /**
         * 如果编辑,并保存成功,就返回到首页
         */
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '编辑用户成功');
            return $this->redirect(['index']);
        }
        $model->password = '';
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * 复选框式删除
     * yii2,post接收传参
     */
    public function actionDelete()
    {
//        Tools::debug(Yii::$app->request->post(), 'Yii::$app->request->post()', true);

        $selected = Yii::$app->request->post('selected', []);
        if (User::deleteIn($selected)) {
            Yii::$app->session->setFlash('success', '删除用户成功');
        } else {
            Yii::$app->session->setFlash('error', '删除用户失败');
        }
        return $this->redirect(['index']);
    }
}