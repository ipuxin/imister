<?php
/**
 * YiiBlog
 *
 * @author: Administrator
 * @date: 2016/5/12 23:16
 * @copyright Copyright (c) 2016 xjuke.com
 */
namespace frontend\components;

use frontend\components\BaseDb;
use common\models\Article;

class ArticleQry extends BaseDb
{

    /**
     * 获取文章的个数,默认为顶级分类
     * 根据文章类别计算该类别下的文章个数
     * @param int $cid 文章分类
     */
    public function count($cid = 0)
    {
        //预留给cid
        $where = [];
        if ($cid > 0) {
            $where['cid'] = (int)$cid;
        }
        return Article::find()->where(array_merge(['status' => 1], $where))->count();
    }

    /**
     * 读取文章数据
     *
     * @param int $cid 文章分类
     * @param int $offset 偏移量
     * @param int $limit 每页个数
     */
    public function getArticles($cid = 0, $offset = 0, $limit = 10)
    {
        $where = [];
        if ($cid > 0) {
            $where['cid'] = (int)$cid;
        }
        return Article::find()->select('id, cid, title, update_date, author, count, description')
            ->where(array_merge(['status' => 1], $where))
            ->offset($offset)->limit($limit)->asArray()->all();
    }

    /**
     * 获取热门文章
     *
     * @param int $limit 获取条数，默认10条
     */
    public function getHotArticles($limit = 10)
    {
        return Article::find()->select('id, title')->where(['status' => 1])->orderBy('count DESC')->limit($limit)->asArray()->all();
    }

    /**
     * 获取模糊查询文章的个数
     *
     * @param string $title 模糊查询标题
     */
    public function getLikeArticleCount($title)
    {
        return Article::find()->where(['and', ['status' => 1], ['like', 'title', $title]])->count();
    }

    /**
     * 获取模糊查询文章
     *
     * @param string $title 模糊查询标题
     */
    public function getLikeArticles($title, $offset = 0, $limit = 10)
    {
        return Article::find()->select('id, cid, title, update_date, author, count, description')
            ->where(['and', ['status' => 1], ['like', 'title', $title]])
            ->offset($offset)->limit($limit)->asArray()->all();
    }

}