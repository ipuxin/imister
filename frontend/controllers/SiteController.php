<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Category;
use frontend\components\CategoryQry;
use frontend\components\ArticleQry;
use yii\data\Pagination;

class SiteController extends Controller
{
    public function actionIndex()
    {
        /**
         * 使用之前Category::getAllCategorys();把子类归纳到父类中的方法,
         * 重构一下数据:是的子类打印出来后名称前有空格
         */
        $categorys = CategoryQry::getInstance()->getCategorys();

        ArticleQry::getInstance()->count();

        $pagination = new Pagination(['totalCount' => ArticleQry::getInstance()->count(), 'pageSize' => 2]);
        $articles = ArticleQry::getInstance()->getArticles(0, $pagination->offset, $pagination->limit);

//        Yii::$app->tools->debug($articles,'$articles');
        return $this->render('index', ['categorys' => $categorys, 'articles' => $articles, 'pagination' => $pagination]);
    }

    public function actionArticle()
    {
        return $this->render('article');
    }

}
