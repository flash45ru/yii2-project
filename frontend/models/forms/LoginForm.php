<?php

namespace frontend\models\forms;

use yii\base\Model;
use frontend\models\User;
use Yii;

class LoginForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['password', 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function login()
    {
        if ($this->validate()) {
            $user = User::findByUsername($this->username);
            return Yii::$app->user->login($user);
        }
        return false;
    }

    public function validatePassword($attribute, $params)
    {
        $user = User::findByUsername($this->username);
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect password');

        }
    }
}