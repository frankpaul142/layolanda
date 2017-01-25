<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
/**
 * LoginForm is the model behind the login form.
 */
class ForgotForm extends Model
{
    public $username;
   

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username'], 'required'],
            // rememberMe must be a boolean value
            ['username', 'email'],

        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function find()
    {
        
        $user=User::find()->where(['username' => $this->username])->one();
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }


}
