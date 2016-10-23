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