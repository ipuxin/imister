<?php
/**
 * 提供以下数据:
 * 文章总数,分类总数,文章类别侧栏分层显示.
 */
namespace frontend\components;

use frontend\components\BaseDb;
use common\models\Category;

class CategoryQry extends BaseDb
{

    /**
     * @return array
     * 拼合侧栏的文章类别
     */
    public function getCategorys()
    {
        /**
         * pid=-1,
         * 考虑到面包屑,当为全部时,不显示"全部"二字"
         */
        $result = [
            0 => [
                'id' => 0,
                'name' => '全部',
                'labelName' => '全部',
                'pid' => -1,
            ]
        ];
        /**
         * 获取把子类归纳到父类之后的数据
         */
        $categorys = Category::getAllCategorys();
//        \Yii::$app->tools->debug($categorys);
        foreach ($categorys as $category) {
            $result[$category['id']] = [
                'id' => $category['id'],
                'name' => $category['name'],
                'labelName' => $category['name'],
                'pid' => $category['pid']
            ];

            foreach ($category['child'] as $cate) {
                $result[$cate['id']] = [
                    'id' => $cate['id'],
                    'name' => $cate['name'],
                    'labelName' => '&nbsp;&nbsp;&nbsp;&nbsp;' . $cate['name'],
                    'pid' => $cate['pid']
                ];
            }
        }
        return $result;
    }
}