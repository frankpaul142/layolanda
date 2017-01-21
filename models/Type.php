<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $description
 * @property string $title
 *
 * @property ProductHasMesureType[] $productHasMesureTypes
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creation_date', 'description', 'title'], 'required'],
            [['creation_date'], 'safe'],
            [['description'], 'string', 'max' => 250],
            [['title'], 'string', 'max' => 50],
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
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHasMesureTypes()
    {
        return $this->hasMany(ProductHasMesureType::className(), ['type_id' => 'id']);
    }
}
