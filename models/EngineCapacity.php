<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "EngineCapacity".
 *
 * @property integer $Id
 * @property double $Value
 *
 * @property Ad[] $ads
 */
class EngineCapacity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'EngineCapacity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Value'], 'required'],
            [['Value'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasMany(Ad::className(), ['EngineCapacity' => 'Id']);
    }
}
