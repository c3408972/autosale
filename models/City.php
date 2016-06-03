<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "City".
 *
 * @property integer $Id
 * @property string $Name
 * @property integer $IdRegion
 *
 * @property Ad[] $ads
 * @property Region $idRegion
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'City';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'IdRegion'], 'required'],
            [['IdRegion'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['IdRegion'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['IdRegion' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Name' => 'Name',
            'IdRegion' => 'Id Region',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasMany(Ad::className(), ['City' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
        public function getRegion()
        {
            return $this->hasOne(Region::className(), ['Id' => 'IdRegion']);
        }
}
