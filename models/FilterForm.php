<?php
namespace app\models;

use yii\base\Model;
use app\models\Region;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class FilterForm extends model
{
    public $Region;
    public $City;
    public $Mark;
    public $Model;
    public $EngineCapacity;
    public $NumberHosts;
    public $Mileage;
    public $Images;

    public function rules()
    {
        return [
                    [['Region','City','Mark','Model','EngineCapacity' ,'NumberHosts' ,'Mileage', 'Images', ], 'integer'],
                ];
    }

    public function attributeLabels()
    {
        return [
            'Region' => 'Область',
            'City' => 'Город',
            'Mark' => 'Марка',
            'Model' => 'Модель',
            'EngineCapacity' => 'Мощность двигателя',
            'NumberHosts' => 'Количество владельцев',
            'Mileage' => 'Пробег',
            'Images' => 'Изображения',
        ];
    }

    // Метод выборки данных обьявлений
    public function LoadData($params){
        $this->load($params);   // Загружаем данные в модель - это нужно для фильтра
        $query = Ad::find();

        if($this->validate())   // Делаем валидацию
        {
            $arrCity = $arrModel = [];  // Создаем массив для городов

            if($this->City) // Если город был выбран
                $arrCity = $this->City; // то записываем его

            if($this->Model)    // Если была выбрана модель
                $arrModel = $this->Model; // то записываем её

            if($this->Region && !$this->City)   // Если был выбран регион, но не выбран город
            {
                $city = City::find()->where([ 'IdRegion' => $this->Region ])->asArray()->all(); // Выбираем все города по региону
                foreach($city as $value)    // Прокручиваем города и вносим в единый миссив с айдихами
                    array_push($arrCity, $value['Id']);
            }

            if($this->Mark && !$this->Model) // Если была выбрана марка, но не выбрана модель
            {
                $model = \app\models\Model::find()->where([ 'IdMark' => $this->Mark ])->asArray()->all(); // Выбираем все модели по марке
                foreach($model as $value)    // Прокручиваем модели и вносим в единый миссив с айдихами
                    array_push($arrModel, $value['Id']);
            }

            // Провайдер который принимает на вход обьеки Query и производит выборку на основании внесенных правил фильтрации, данных пагинации и сортировки
            $dataProvider = new ActiveDataProvider([
                'query' => $query->with('region')->with('mark')->andFilterWhere([
                    'city'  => $arrCity,
                    'model'  => $arrModel,
                    'engineCapacity'  => $this->EngineCapacity,
                    'numberHosts'  => $this->NumberHosts,
                    'mileage'  => $this->Mileage,
                ]),
                'sort' => [
                    'defaultOrder' => ['DateTime' => SORT_DESC],
                ],
                'pagination' => [
                    'pageSize' => 6,
                ]
            ]);

            return $dataProvider;
        } else  // Если в параметрах были буквы то заходим сюда, так как валидация не пропустит, отдаем данные по стандарту.
        {
            // Провайдер который принимает на вход обьеки Query и производит выборку на основании внесенных правил фильтрации, данных пагинации и сортировки
            $dataProvider = new ActiveDataProvider([
                'query' => $query->with('region')->with('mark'),
                'sort' => [
                    'defaultOrder' => ['DateTime' => SORT_DESC],
                ],
                'pagination' => [
                    'pageSize' => 6,
                ]
            ]);
            return $dataProvider;
        }

    }
}