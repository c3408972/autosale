<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ContactForm;
use app\models\AdForm;
use app\models\FilterForm;


use yii\web\Response;


class SiteController extends Controller
{

    // Действие при обращении к корню сайта
    public function actionIndex()
    {
        $modelAd = new AdForm();    // Создаем экземпляр модели AdForm
        $modelAd->LoadData();   // Заполняем начальными данными
        $filterForm = new FilterForm(); // Создаем экземпляр модели Фильтра
        $dataProvider = $filterForm->LoadData(Yii::$app->request->queryParams); // Вызываем метод загрузки данных, передаем Get параметры

        // Записываем модель в глобальный массив параметров,
        // что бы можно было во вюхе достать, если будет обращение к другой странице
        Yii::$app->params['modelAd'] = $modelAd;

        // Записываем данные в массив для ответа
        $response = ['dataProvider' => $dataProvider,'modelAd' => $modelAd, ];

        return $this->render('index', $response); // Рендерим вюху и добавляем ответ на отправку.
    }
}
