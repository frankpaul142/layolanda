<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail".
 *
 * @property integer $id
 * @property integer $bill_id
 * @property integer $product_has_mesure_type_id
 * @property string $creation_date
 *
 * @property Bill $bill
 * @property ProductHasMesureType $productHasMesureType
 */
class Detail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bill_id', 'product_has_mesure_type_id', 'creation_date','price'], 'required'],
            [['bill_id', 'product_has_mesure_type_id'], 'integer'],
            [['creation_date'], 'safe'],
            [['price'], 'double'],
            [['bill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bill::className(), 'targetAttribute' => ['bill_id' => 'id']],
            [['product_has_mesure_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductHasMesureType::className(), 'targetAttribute' => ['product_has_mesure_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_id' => 'Bill ID',
            'product_has_mesure_type_id' => 'Product Has Mesure Type ID',
            'creation_date' => 'Creation Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBill()
    {
        return $this->hasOne(Bill::className(), ['id' => 'bill_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHasMesureType()
    {
        return $this->hasOne(ProductHasMesureType::className(), ['id' => 'product_has_mesure_type_id']);
    }
}
