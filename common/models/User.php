<?php
namespace common\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    /**
     * 设置超级管理员id默认为2
     * 防止都删除,进不来
     */
    const SUPER_ID = 2;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            ['username', 'checkName', 'skipOnEmpty' => false],

            /**
             * 密码验证注意:修改时,密码可以为空,表示不修改
             *
             * when:执行验证的回调函数,
             * 当返回true时才验证前面条件,否则不验证,
             * 此处,当model为新增,或者密码不为空才验证.
             * 当为修改的时候:1.写密码,则验证;2.不写密码,不验证.
             * (也很巧妙哦,不过比场景复杂)
             */
            ['password', 'string', 'min' => 6, 'tooShort' => '密码的长度不能少于6位', 'skipOnEmpty' => false,
                'when' => function ($model) {
                    return ($model->isNewRecord || $model->password != '');
                }],
            ['status', 'in', 'range' => [0, 1], 'message' => '非法操作'],
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
        } else if (self::find()->where(['username' => $this->$attribute])
                /**
                 * 如果是修改,昵称可以和之前自己的昵称相同,
                 * 所以,只判断,当前昵称,不与除自己之外的用户相同就行
                 */
                ->andWhere(['!=', 'id', $this->id])->count() > 0
        ) {
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
            /**
             * 插入创建时间和登录时间
             */
            if ($this->isNewRecord) {
                $this->date = $this->login_date = time();
            }

            /**
             * 当修改时,不填密码表示不修改
             * 如果为空,就清空,
             * 否则就加密,保存
             */
            if (empty($this->password)) {
                unset($this->password);
            } else {
                $this->password = md5(md5(md5($this->password), true) . 'ipuxin521');
            }
            return true;
        }
        return false;
    }

    /**
     * 后台用户删除
     * 漂亮的checkbox多列删除,跳过管理员账户
     */
    public static function deleteIn($selected)
    {
        /**
         * 保存要删除的id,
         * 转换id的类型
         */
        $data = [];
        foreach ($selected as $select) {
            if ($select == self::SUPER_ID) continue;
            $data[] = (int)$select;
        }
        return self::deleteAll(['id' => $data]);
    }
}