<?php
namespace common\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            ['username', 'checkName', 'skipOnEmpty' => false],
            ['password', 'string', 'min' => 6, 'tooShort' => '密码的长度不能少于6位', 'skipOnEmpty' => false],
            ['status', 'in', 'range' => [0, 1], 'message' => '非法操作']
        ];
    }

    /**
     * @param $attribute
     * @param $params
     * 自定义验证规则
     */
    public function checkName($attribute, $params)
    {
        //字母，数字 2~30
        if (!preg_match("/^[\w]{2,30}$/", $this->$attribute)) {
            $this->addError($attribute, '用户名必须为2~30的数字或字母');
        } else if (self::find()->where(['username' => $this->$attribute])->count() > 0) {
            $this->addError($attribute, '用户名已经被占用');
        }
    }

    /**
     * @param bool $insert
     * @return bool
     * 插入前的验证,
     * 必须在父类验证成功后,才能进行下一步验证
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->date = $this->login_date = time();
            }
            $this->password = md5(md5(md5($this->password), true) . 'ipuxin521');
            return true;
        }
        return false;
    }

}