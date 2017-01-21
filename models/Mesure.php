<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mesure".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $description
 *
 * @property ProductHasMesureType[] $productHasMesureTypes
 */
class Mesure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mesure';
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
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHasMesureTypes()
    {
        return $this->hasMany(ProductHasMesureType::className(), ['mesure_id' => 'id']);
    }
}
