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

    public function checkName($attribute, $params)
    {
        //字母，数字 2~30
        if (!preg_match("/^[\w]{2,30}$/", $this->$attribute)) {
            $this->addError($attribute, '用户名必须为2~30的数字或字母');
        } else if (self::find()->where(['username' => $this->$attribute])->count() > 0) {
            $this->addError($attribute, '用户名已经被占用');
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->date = $this->login_date = time();
            }
            $this->password = md5($this->password);
            return true;
        }
        return false;
    }

}