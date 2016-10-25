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
    private $a;

    public function __construct()
    {
        $this->a = mt_rand(111, 999);
    }

    public function getA()
    {
        echo $this->a . '<br>';

    }

    /**
     * 获取文章的个数
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
        return Article::find()->select('id, cid, title, update_date, author, count, description')->where(array_merge(['status' => 1], $where))->offset($offset)->limit($limit)->asArray()->all();
    }
}