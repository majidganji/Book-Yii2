<?php

namespace frontend\models;

use yii\base\Model;
use Yii;

class ChangePassword extends Model {

    public $password;
    public $password_repeat;
    public $old_password;
 

    public function rules() {
        return[
            [['password', 'password_repeat', 'old_password'], 'required'],
            ['password', 'string', 'min'=>6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }
    
    public function attributeLabels() {
        return[
            'password' => 'رمز عبور',
            'password_repeat' => 'تکرار رمز عبور',
            'old_password' => 'رمز عبور قبلی',
        ];
    }
    
    public function beforeValidate() {
        if ($model = User::findOne(Yii::$app->user->id)){
            if(!Yii::$app->getSecurity()->validatePassword($this->old_password, $model->password_hash)){
                $this->addError('old_password', 'رمز عبور قبلی اشتباه است.');
            }
        }
        return parent::beforeValidate();
    }
    
    public function savePassword() {
        $model = User::findOne(Yii::$app->user->id);
        $model->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        return ($model->update() ? TRUE : FALSE);
    }
    
}
