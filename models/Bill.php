<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $creation_date
 *
 * @property User $user
 * @property Detail[] $details
 */
class Bill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'creation_date'], 'required'],
            [['user_id'], 'integer'],
            [['creation_date'], 'safe'],
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
            'user_id' => 'User ID',
            'creation_date' => 'Creation Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(Detail::className(), ['bill_id' => 'id']);
    }
}
