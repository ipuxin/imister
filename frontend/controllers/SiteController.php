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
    public function actionIndex($cid = 0)
    {
        $cid = (int)$cid;
        /**
         * 使用之前Category::getAllCategorys();把子类归纳到父类中的方法,
         * 重构一下数据:是的子类打印出来后名称前有空格
         */
        $categorys = CategoryQry::getInstance()->getCategorys();

        //获取当前筛选分类
        $nowCategory = [];
        /**
         * 如果传入的分类不为0,但不存在于数据库中,
         * 设置为默认分类0
         */
        if ($cid != 0 && !isset($categorys[$cid])) {
            $cid = 0;
        } else {
            $nowCategory = $categorys[$cid];
        }

        /**
         * 获取文章列表
         * 根据传入的类别进行分页,数据展示
         */
        $pagination = new Pagination(['totalCount' => ArticleQry::getInstance()->count($cid), 'pageSize' => 2]);
        $articles = ArticleQry::getInstance()->getArticles($cid, $pagination->offset, $pagination->limit);

        /**
         * 获取热门文章
         * 默认10条
         */
        $hotNum = 10;
        $hotArticles = ArticleQry::getInstance()->getHotArticles($hotNum);

//        Yii::$app->tools->debug($articles,'$articles');
        return $this->render('index', ['categorys' => $categorys, 'articles' => $articles, 'pagination' => $pagination, 'nowCategory' => $nowCategory, 'hotArticles' => $hotArticles]);
    }

    public function actionArticle()
    {
        return $this->render('article');
    }

    /**
     * @param string $search
     * @return string|\yii\web\Response
     * 展示搜索结构
     * 和展示文章列表几乎一模一样
     */
    public function actionSearch($search = '')
    {

        if ($search == '' || mb_strlen($search,'utf-8') > 255) {
            return $this->redirect(['site/index']);
        }

//        Yii::$app->tools->debug(ArticleQry::getInstance()->getLikeArticleCount($search));

        //所有分类
        $categorys = CategoryQry::getInstance()->getCategorys();

        $pagination = new Pagination(['totalCount' => ArticleQry::getInstance()->getLikeArticleCount($search), 'pageSize' => 10]);
        $articles = ArticleQry::getInstance()->getLikeArticles($search, $pagination->offset, $pagination->limit);

        //热门文章
        $hotArticles = ArticleQry::getInstance()->getHotArticles();

        return $this->render('index', ['categorys' => $categorys, 'articles' => $articles, 'pagination' => $pagination , 'nowCategory' => [], 'hotArticles' => $hotArticles , 'search' => $search]);

    }
}
