<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Model".
 *
 * @property integer $Id
 * @property string $Name
 * @property integer $IdMark
 *
 * @property Ad[] $ads
 * @property Mark $idMark
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'IdMark'], 'required'],
            [['IdMark'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['IdMark'], 'exist', 'skipOnError' => true, 'targetClass' => Mark::className(), 'targetAttribute' => ['IdMark' => 'Id']],
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
            'IdMark' => 'Id Mark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasMany(Ad::className(), ['Model' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMark()
    {
        return $this->hasOne(Mark::className(), ['Id' => 'IdMark']);
    }
}
