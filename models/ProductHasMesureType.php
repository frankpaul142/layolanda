<?php

namespace app\models;

use Yii;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;
/**
 * This is the model class for table "product_has_mesure_type".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $mesure_id
 * @property double $price
 * @property integer $type_id
 * @property string $creation_date
 *
 * @property Detail[] $details
 * @property Mesure $mesure
 * @property Product $product
 * @property Type $type
 */
class ProductHasMesureType extends \yii\db\ActiveRecord implements CartPositionInterface
{
    /**
     * @inheritdoc
     */
    use CartPositionTrait;
           public function getPrice()
    {

          return $this->price;
        
    }
        public function getId()
    {
        return $this->id;
    }
    public static function tableName()
    {
        return 'product_has_mesure_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'mesure_id', 'price', 'type_id', 'creation_date','size'], 'required'],
            [['product_id', 'mesure_id', 'type_id'], 'integer'],
            [['price'], 'number'],
            [['creation_date'], 'safe'],
            [['mesure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mesure::className(), 'targetAttribute' => ['mesure_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'mesure_id' => 'Mesure ID',
            'price' => 'Price',
            'type_id' => 'Type ID',
            'creation_date' => 'Creation Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(Detail::className(), ['product_has_mesure_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMesure()
    {
        return $this->hasOne(Mesure::className(), ['id' => 'mesure_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }
}
