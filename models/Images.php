<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Images".
 *
 * @property integer $Id
 * @property string $Url
 * @property integer $IdAd
 *
 * @property Ad $idAd
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Url', 'IdAd'], 'required'],
            [['Url'], 'string'],
            [['IdAd'], 'integer'],
            [['IdAd'], 'exist', 'skipOnError' => true, 'targetClass' => Ad::className(), 'targetAttribute' => ['IdAd' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Url' => 'Url',
            'IdAd' => 'Id Ad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAd()
    {
        return $this->hasOne(Ad::className(), ['Id' => 'IdAd']);
    }
}
