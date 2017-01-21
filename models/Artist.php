<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artist".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $name
 * @property string $birthday
 * @property string $death_date
 * @property integer $country_id
 *
 * @property Country $country
 * @property Product[] $products
 */
class Artist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creation_date', 'name', 'birthday', 'death_date', 'country_id'], 'required'],
            [['creation_date', 'birthday', 'death_date'], 'safe'],
            [['country_id'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
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
            'name' => 'Name',
            'birthday' => 'Birthday',
            'death_date' => 'Death Date',
            'country_id' => 'Country ID',
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
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['artist_id' => 'id']);
    }
}
