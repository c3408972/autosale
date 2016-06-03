<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Ad".
 *
 * @property integer $Id
 * @property integer $City
 * @property integer $Model
 * @property integer $EngineCapacity
 * @property integer $NumberHosts
 * @property integer $Mileage
 * @property integer $IdUser
 * @property string $DateTime
 *
 * @property City $city
 * @property Model $model
 * @property EngineCapacity $engineCapacity
 * @property NumberHosts $numberHosts
 * @property Mileage $mileage
 * @property User $idUser
 * @property Images[] $images
 */
class Ad extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['City', 'Model', 'EngineCapacity', 'NumberHosts', 'Mileage', 'IdUser', 'DateTime'], 'required'],
            [['City', 'Model', 'EngineCapacity', 'NumberHosts', 'Mileage', 'IdUser'], 'integer'],
            [['DateTime'], 'safe'],
            [['City'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['City' => 'Id']],
            [['Model'], 'exist', 'skipOnError' => true, 'targetClass' => Model::className(), 'targetAttribute' => ['Model' => 'Id']],
            [['EngineCapacity'], 'exist', 'skipOnError' => true, 'targetClass' => EngineCapacity::className(), 'targetAttribute' => ['EngineCapacity' => 'Id']],
            [['NumberHosts'], 'exist', 'skipOnError' => true, 'targetClass' => NumberHosts::className(), 'targetAttribute' => ['NumberHosts' => 'Id']],
            [['Mileage'], 'exist', 'skipOnError' => true, 'targetClass' => Mileage::className(), 'targetAttribute' => ['Mileage' => 'Id']],
            [['IdUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['IdUser' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'City' => 'City',
            'Model' => 'Model',
            'EngineCapacity' => 'Engine Capacity',
            'NumberHosts' => 'Number Hosts',
            'Mileage' => 'Mileage',
            'IdUser' => 'Id User',
            'DateTime' => 'Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['Id' => 'City']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Model::className(), ['Id' => 'Model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineCapacity()
    {
        return $this->hasOne(EngineCapacity::className(), ['Id' => 'EngineCapacity']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNumberHosts()
    {
        return $this->hasOne(NumberHosts::className(), ['Id' => 'NumberHosts']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMileage()
    {
        return $this->hasOne(Mileage::className(), ['Id' => 'Mileage']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'IdUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['IdAd' => 'Id']);
    }

    public function getRegion()
    {
        return $this->hasMany(Region::className(), ['Id' => 'IdRegion'])->via('city');
    }

    public function getMark()
    {
        return $this->hasMany(Mark::className(), ['Id' => 'IdMark'])->via('model');
    }

}
