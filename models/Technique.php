<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "technique".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $description
 *
 * @property Product[] $products
 */
class Technique extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'technique';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creation_date', 'description'], 'required'],
            [['creation_date'], 'safe'],
            [['description'], 'string', 'max' => 150],
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
            'description' => 'Técnica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['technique_id' => 'id']);
    }
}
