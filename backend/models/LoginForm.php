<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
use Yii;
use yii\web\Cookie;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $verifyCode;
    public $remember;

    /**
     * @var
     * 保存当前登录用户的一条信息
     */
    private $user;

    const BACKEND_ID = 'backend_id';
    const BACKEND_USERNAME = 'backend_username';
    const BACKEND_COOKIE = 'backend_remember';

    public function rules()
    {
        return [
            ['username', 'validateAccount', 'skipOnEmpty' => false],
            ['verifyCode', 'captcha', 'captchaAction' => 'login/captcha', 'message' => '验证码错误'],
            [['password', 'remember'], 'safe'],
        ];
    }

    /**
     * 验证用户和密码
     */
    public function validateAccount($attribute, $params)
    {
        if (!preg_match('/^\w{2,30}$/', $this->$attribute)) {
            $this->addError($attribute, '账号或密码错误');
        } else if (strlen($this->password) < 6) {
            $this->addError($attribute, '账号或密码错误');
        } else {
            /**
             * 判断用户名和密码,同时验证状态是可用的.
             * 如果
             */
            $password = md5(md5(md5($this->password), true) . 'ipuxin521');
            $user = User::find()
                ->where(['username' => $this->$attribute, 'status' => 1, 'password' => $password])
                ->asArray()
                ->one();
            if (!$user) {
                $this->addError($attribute, '账号或密码错误');
            } else {
                /**
                 * 存储用户信息
                 */
                $this->user = $user;
            }
        }
    }

    /**
     * @return bool
     * 登录验证成功,
     * 进行登录后的数据处理:
     * 是否记住登录状态
     * 保存登录信息到session,cookie
     */
    public function login()
    {
        /**
         * 存储的用户信息为假,
         * 更新用户登录后的信息为假,
         * 以上两种情况,又一个成立,就返回false,登录失败.
         */
        if (!$this->user){
            return false;
        }

        if($this->updateUserStatus()){
            return false;
        }

        /**
         * session保存用户信息
         */
        $this->createSession();

        /**
         * 如果允许记住登录,则保存cookie
         */
        if ($this->remember == 1) {
            $this->createCookie();
        }
        return true;
    }

    /**
     * session保存用户信息
     */
    private function createSession()
    {
        $session = Yii::$app->session;
        $session->set(self::BACKEND_ID, $this->user['id']);
        $session->set(self::BACKEND_USERNAME, $this->user['username']);
    }

    /**
     * 如果允许记住登录,则保存cookie
     */
    private function createCookie()
    {
        $cookie = new Cookie();
        $cookie->name = self::BACKEND_COOKIE;
        $cookie->value = [
            'id' => $this->user['id'],
            'username' => $this->user['username']
        ];
        //cookie保存7天
        $cookie->expire = time() + 60 * 60 * 24 * 7;
        $cookie->httpOnly = true;

        Yii::$app->response->cookies->add($cookie);
    }

    /**
     * @return bool
     * 更新用户登录后的信息:
     * 存储ip,更新登录时间
     */
    private function updateUserStatus()
    {
        $user = User::findOne($this->user['id']);
        $user->login_ip = 111;
        $user->login_date = 111;

        return $user->save();
    }

    /**
     * 通过cookie登录
     */
    public function loginByCookie()
    {
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has(self::BACKEND_COOKIE)) {
            $userData = $cookies->getValue(self::BACKEND_COOKIE);
            if (isset($userData['id']) && isset($userData['username'])) {
                $this->user = User::find()->where(['username' => $userData['username'], 'id' => $userData['id'], 'status' => 1])->asArray()->one();
                if ($this->user) {
                    $this->createSession();
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 退出登录
     */
    public static function lagout()
    {
        $session = Yii::$app->session;
        $session->remove(self::BACKEND_ID);
        $session->remove(self::BACKEND_USERNAME);
        $session->destroy();

        $cookies = Yii::$app->request->cookies;
        //可能存在cookie
        if ($cookies->has(self::BACKEND_COOKIE)) {
            $rememberCookie = $cookies->get(self::BACKEND_COOKIE);
            Yii::$app->response->cookies->remove($rememberCookie);
        }
        return true;
    }

}