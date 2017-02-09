<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $artist_id
 * @property integer $category_id
 * @property string $creation_date
 * @property string $description
 * @property string $product_date
 * @property integer $technique_id
 * @property integer $material_id
 * @property integer $flowing_id
 * @property string $support
 *
 * @property Picture[] $pictures
 * @property Artist $artist
 * @property Category $category
 * @property Flowing $flowing
 * @property Material $material
 * @property Technique $technique
 * @property ProductHasMesureType[] $productHasMesureTypes
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['artist_id', 'category_id', 'creation_date', 'description', 'technique_id', 'material_id', 'flowing_id'], 'required'],
            [['artist_id', 'category_id', 'technique_id', 'material_id', 'flowing_id'], 'integer'],
            [['creation_date', 'product_date'], 'safe'],
            [['description'], 'string', 'max' => 150],
            [['support'], 'string', 'max' => 45],
            [['artist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artist::className(), 'targetAttribute' => ['artist_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['flowing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flowing::className(), 'targetAttribute' => ['flowing_id' => 'id']],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::className(), 'targetAttribute' => ['material_id' => 'id']],
            [['technique_id'], 'exist', 'skipOnError' => true, 'targetClass' => Technique::className(), 'targetAttribute' => ['technique_id' => 'id']],
            ['important', 'in', 'range' => ['ACTIVE','INACTIVE']],
            ['status', 'in', 'range' => ['ACTIVE','INACTIVE']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'artist_id' => 'Artist ID',
            'category_id' => 'Category ID',
            'creation_date' => 'Creation Date',
            'description' => 'Description',
            'product_date' => 'Product Date',
            'technique_id' => 'Technique ID',
            'material_id' => 'Material ID',
            'flowing_id' => 'Flowing ID',
            'support' => 'Support',
            'title' =>'Título'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPictures()
    {
        return $this->hasMany(Picture::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtist()
    {
        return $this->hasOne(Artist::className(), ['id' => 'artist_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlowing()
    {
        return $this->hasOne(Flowing::className(), ['id' => 'flowing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnique()
    {
        return $this->hasOne(Technique::className(), ['id' => 'technique_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMesuretypes()
    {
        return $this->hasMany(ProductHasMesureType::className(), ['product_id' => 'id']);
    }
        public function getMinorprice()
    {
        return $this->hasMany(ProductHasMesureType::className(), ['product_id' => 'id'])->orderBy(['price'=>SORT_DESC])->one();
    }
       public function getTypes()
    {
       return $this->hasMany(Type::className(),['id' => 'type_id'])->viaTable('product_has_mesure_type',['product_id' => 'id']);
    }
           public function getMesures()
    {
       return $this->hasMany(Mesure::className(),['id' => 'mesure_id'])->viaTable('product_has_mesure_type',['product_id' => 'id']);
    }  
}
