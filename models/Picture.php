<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $creation_date
 * @property string $description
 *
 * @property Product $product
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'creation_date', 'description'], 'required'],
            [['product_id'], 'integer'],
            [['creation_date'], 'safe'],
            [['description'], 'string', 'max' => 150],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'creation_date' => 'Creation Date',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
