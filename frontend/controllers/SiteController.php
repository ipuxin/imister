<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    public function actionIndex()
    {
        \frontend\components\ArticleQry::getInstance()->getA();
        \frontend\components\ArticleQry::getInstance()->getA();
        \frontend\components\ArticleQry::getInstance()->getA();
        return $this->render('index');
    }

    public function actionArticle()
    {
        return $this->render('article');
    }

}
