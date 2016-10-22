<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/13
 * Time: 22:18
 */
namespace backend\models;

use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $verifyCode;
    public $remmber;

}