<?php
namespace backend\controllers;

use yii\web\Controller;
use backend\models\LoginForm;
use yii;

class LoginController extends Controller
{
    /**
     * @return array
     * 验证码
     */
    public function actions()
    {
       return [
            'captcha' => [
                'class' => 'yii\captcha\captchaAction',
                'maxLength' => 4,
                'minLength' => 4,
                'width' => 80,
                'height' => 40
            ]
       ];
    }

    /**
     * @return string|\yii\web\Response
     * 后台登录验证
     * 验证以下方面:
     * 是否是post提交,是否加载数据成功,数据是否通过验证,登录后续处理是否完成;
     */
    public function actionIndex()
    {
        $model = new LoginForm();
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->validate() && $model->login()){
            return $this->redirect(['site/index']);
        }
        return $this->renderPartial('index' , ['model' => $model]);
    }
}