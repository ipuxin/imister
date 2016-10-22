<?php
namespace backend\controllers;

use yii\web\Controller;
use backend\models\LoginForm;

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

    public function actionIndex()
    {
        $model = new LoginForm();

        return $this->renderPartial('index' , ['model' => $model]);
    }
}