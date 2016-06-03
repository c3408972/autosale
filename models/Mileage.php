<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Mileage".
 *
 * @property integer $Id
 * @property integer $Value
 *
 * @property Ad[] $ads
 */
class Mileage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Mileage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Value'], 'required'],
            [['Value'], 'integer'],
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
        return $this->hasMany(Ad::className(), ['Mileage' => 'Id']);
    }
}
