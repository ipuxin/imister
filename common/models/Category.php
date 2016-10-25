<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/21
 * Time: 23:23
 */
namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%category}}';
    }

    public function rules()
    {
        return [
            ['pid', 'integer', 'min' => 0, 'tooSmall' => '不能小于0的整数', 'message' => '不能小于0的整数'],
            ['name', 'required', 'message' => '名称不能为空'],
            ['name', 'string', 'max' => 30, 'tooLong' => '名称长度不能大于30位'],
            ['sort_order', 'integer', 'min' => 0, 'tooSmall' => '不能小于0的整数', 'message' => '不能小于0的整数'],
            ['status', 'in', 'range' => [0, 1], 'message' => '非法操作'],
            ['pid', 'checkPid'],
        ];
    }

    /**
     * @param $attribute
     * @param $params
     * 验证修改时:
     * 如果类别有子类,就不能修改;
     * 如果设置自身为父类,也不能保存修改
     */
    public function checkPid($attribute, $params)
    {
        if (self::find()->where(['pid' => $this->id])->count() > 0) {
            $this->addError($attribute, '该类下有子类，请先移除');
        } elseif ($this->id == $this->$attribute) {
            $this->addError($attribute, '无法成为自身的子类');
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->date = time();
            }
            return true;
        }
        return false;
    }

    /**
     * 格式:key(id) => name(name)
     * @return array
     * 这也是一种比较好的生成 dropDownList(下拉列表的方式)
     */
    public static function getParentCategorys()
    {
        /**
         * 找到所有父类为0的,即找到顶级分类
         */
        $data = self::find()->where(['pid' => 0])->asArray()->all();
        return ArrayHelper::merge([0 => '父类'], ArrayHelper::map($data, 'id', 'name'));
    }

    /**
     * 读取所有文章分类 , 将子类归纳到父类中
     */
    public static function getAllCategorys()
    {
        $result = [];
        /**
         * 获取所有类别:
         * 通过 按父类(pid) 由小到大排列(ASC) 让父类排在前面
         * Array
         * (
         * [0] => Array
         * (
         * [id] => 5
         * [pid] => 0
         * [name] => 编程语言
         * [sort_order] => 0
         * [status] => 1
         * [date] => 1477227518
         * )
         *
         * [1] => Array
         * (
         * [id] => 9
         * [pid] => 0
         * [name] => PHP框架
         * [sort_order] => 1
         * [status] => 1
         * [date] => 1477359974
         * )
         */
        $data = self::find()->orderBy('pid ASC')->asArray()->all();

        foreach ($data as $v) {
            /**
             * 处理父类:
             * 父类没有顶级分类,pid==0
             */
            if ($v['pid'] == 0) {
                /**
                 * 组合:
                 * 1.把当前父类的值,赋给一个数组,数组的下标为当前数据的ID;
                 * 2.父类没有子类,所以,父类数组的用于存放子类的值,暂时为空.
                 */
                $result[$v['id']] = $v;
                $result[$v['id']]['child'] = [];
            } else if ($result[$v['pid']]) {
                /**
                 * 如果存在父类:
                 * 就把当前的值存储到,父类中,
                 * 找到组合好的pid数组,拼接到下标为child的地方
                 */
                $result[$v['pid']]['child'][] = $v;
            }
        }
        /**
         * Array
         * (
         * [5] => Array
         * (
         * [id] => 5
         * [pid] => 0
         * [name] => 编程语言
         * [sort_order] => 0
         * [status] => 1
         * [date] => 1477227518
         * [child] => Array
         * (
         * [0] => Array
         * (
         * [id] => 6
         * [pid] => 5
         * [name] => PHP
         * [sort_order] => 0
         * [status] => 1
         * [date] => 1477227530
         * )
         *
         * [1] => Array
         * (
         * [id] => 7
         * [pid] => 5
         * [name] => Java
         * [sort_order] => 2
         * [status] => 1
         * [date] => 1477227550
         * )
         *
         * [2] => Array
         * (
         * [id] => 8
         * [pid] => 5
         * [name] => C++
         * [sort_order] => 1
         * [status] => 1
         * [date] => 1477227562
         * )
         *
         * )
         *
         * )
         */
        return $result;
    }

    /**
     * 读取文章中的所有分类 ， 根据id排序
     */
    public static function getCategory()
    {
        return ArrayHelper::index(self::find()->select('id,name')->asArray()->all(), 'id');
    }

    /**
     * @param $selected
     * @return int
     * 删除
     */
    public static function deleteIn($selected)
    {
        $selected = array_map('intval', $selected);
        return self::deleteAll(['id' => $selected]);
    }
}