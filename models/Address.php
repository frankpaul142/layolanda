<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $type
 * @property string $creation_date
 * @property string $city
 * @property string $province
 * @property integer $country_id
 * @property string $zip
 * @property string $phone
 * @property integer $user_id
 *
 * @property Country $country
 * @property User $user
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_line_1', 'type', 'creation_date', 'city', 'province', 'country_id', 'zip', 'phone', 'user_id'], 'required'],
            [['type'], 'string'],
            [['creation_date'], 'safe'],
            [['country_id', 'user_id'], 'integer'],
            [['address_line_1', 'address_line_2'], 'string', 'max' => 255],
            [['city', 'province'], 'string', 'max' => 150],
            [['zip', 'phone'], 'string', 'max' => 45],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address_line_1' => 'Address Line 1',
            'address_line_2' => 'Address Line 2',
            'type' => 'Type',
            'creation_date' => 'Creation Date',
            'city' => 'City',
            'province' => 'Province',
            'country_id' => 'Country ID',
            'zip' => 'Zip',
            'phone' => 'Phone',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
