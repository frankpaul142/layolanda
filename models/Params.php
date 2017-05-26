<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "params".
 *
 * @property integer $id
 * @property string $value
 * @property string $description
 */
class Params extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'params';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'description' => 'Description',
        ];
    }
}
