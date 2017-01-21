<?php

namespace app\models;

use Yii;
use yii\filters\AccessControl;
use kartik\password\StrengthValidator;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $username
 * @property string $names
 * @property string $lastnames
 * @property string $birthday
 * @property string $sex
 * @property string $type
 * @property string $password
 * @property string $auth_key
 *
 * @property Address[] $addresses
 * @property Bill[] $bills
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creation_date', 'names', 'lastnames', 'birthday', 'sex', 'type', 'password', 'auth_key'], 'required'],
            [['id'], 'integer'],
            [['creation_date', 'birthday'], 'safe'],
            [['sex', 'type'], 'string'],
            [['username', 'names', 'lastnames'], 'string', 'max' => 150],
            [['password', 'auth_key','password_reset_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creation_date' => 'Creation Date',
            'username' => 'Username',
            'names' => 'Names',
            'lastnames' => 'Lastnames',
            'birthday' => 'Birthday',
            'sex' => 'Sex',
            'type' => 'Type',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" No está implementado.');
    }
    
    public function beforeSave($insert) {

         if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                  if(isset($this->password)) 
                    $this->password = $this->hashPassword($this->password);
            }
        }
        return parent::beforeSave($insert);
    }
        public static function isUserClient($username)
    {
      if (static::findOne(['username' => $username, 'type' => 'CLIENT','status'=>'ACTIVE'])){
 
             return true;
      } else {
 
             return false;
      }
 
    }
        public static function isUserAdmin($username)
    {
      if (static::findOne(['username' => $username, 'type' => 'ADMIN','status'=>'ACTIVE'])){
 
             return true;
      } else {
 
             return false;
      }
 
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username,'status'=>'ACTIVE']);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = (1 * 4 * 60 * 60);
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
     public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
        public function validatePassword($password)
    {
         return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function hashPassword($password){

        //return hash('sha256',$password);
        return \Yii::$app->getSecurity()->generatePasswordHash($password);
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->getSecurity()->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = \Yii::$app->getSecurity()->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bill::className(), ['user_id' => 'id']);
    }
}
