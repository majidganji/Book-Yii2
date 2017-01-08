<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $name;
    public $family;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User'],
            
            [['name', 'family'], 'string', 'max' => 100],
            [['name', 'family'], 'required'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password' ],
            
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels() {
        return[
            'name' => 'نام',
            'family' => 'نام خانوادگی',
            'username' => 'نام کاربری',
            'email' => 'ایمیل',
            'password' => 'رمز عبور',
            'password_repeat' => 'تکرار رمز عبور',
            'verifyCode' => 'کد امنیتی',
        ];
    }

        /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            
            $user->name =  $this->name;
            $user->family = $this->family;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->created_at = time();
            $user->updated_at= time();
            $user->last_login_time = time();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
