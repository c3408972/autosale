<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ContactForm;
use app\models\AdForm;
use app\models\FilterForm;
use yii\web\Response;
use yii\web\UploadedFile;

Class AdController extends Controller
{

    // Добавление обьявления
    public function actionAddAd()
    {
        Yii::$app->response->format = Response::FORMAT_JSON; // указываем что ответ будет в json формате
        $modelAd = new AdForm();
        $modelAd->load(Yii::$app->request->post()); // Загружаем данные из поста в модель
        $modelAd->Images = UploadedFile::getInstances($modelAd, 'Images');  // Получаем картинки из поста
        $count = $modelAd->LimitIsExceeded();   // Получаем ответ по превышению лимита обьявлений

        if($count === true) // Если количество =true то еще лимит не превышен
        {
            if($modelAd->validate())    // Вылидируем данные
            {
                if($modelAd->AddData()) // Вызываем метод добавления обьявления, если true то отправляем успешное сообщение, если false то сообщение об ошибке
                    $response = Array("Message" => Array('success' => "Данные добавлены"));
                else $response = Array("Message" => Array('error' => "Данные не добавлены, повторите попытку"));
                return $response;
            }else{
                $response = Array("Message" => Array('error' => $modelAd->getErrors()));    // Если не прошли валидацию, то собираем ошибки и отправляем на клиент
                return $response;
            }
}else return Array("Message" => Array('error' => "Превышен лимит добавления обьявлений, возможно не более {$count} обьявлений.")); // Сообщение о превышении лимита

    }

    // Получение городов по региону
    public function actionGetCity()
    {
        $modelAd = new AdForm();
        $modelAd->load(Yii::$app->request->post()); // Загружаем данные из поста (айди региона)

        Yii::$app->response->format = Response::FORMAT_JSON; // указываем что ответ будет в json формате
        return $modelAd->GetCity(); // Отправляем найденные города
    }

    // Получение городов по марке
    public function actionGetModel()
    {
        $modelAd = new AdForm();
        $modelAd->load(Yii::$app->request->post());  // Загружаем данные из поста (айди марки)

        Yii::$app->response->format = Response::FORMAT_JSON; // указываем что ответ будет в json формате
        return $modelAd->GetModel(); // Отправляем найденные города
    }


}