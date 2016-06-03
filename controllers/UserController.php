<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ContactForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegForm;
use yii\web\Response;

Class UserController extends Controller
{

    // Настройка поведений
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    // Действие при регистрации
    public function actionReg()
    {
        $model = new RegForm(); // Создаем экземпляр модели регистрации
        \Yii::$app->response->format = Response::FORMAT_JSON;   // указываем что ответ будет в json формате
        if ($model->load(Yii::$app->request->post()) && $model->validate()){    // Загружаем данные в модель и проверяем что эти данные вилидны
            if ($user = $model->reg()){ // Регистрируемся и получаем ответ
                $response = Array("Message" => Array('success' => "Вы успешно зарегистрированы"));  // Если всё хорошо, то отправляем положительный ответ
                return $response;
            }else{
                Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации.');  // Если была ошибка, то отправляем сообщение об ошибке
                Yii::error('Ошибка при регистрации');
                return $this->refresh();
            }
        }

        $response = Array("Message" => Array('error' => $model->getErrors()));  // Если валидацию не прошли, то отправляем ответ с полями и ошибками.
        return $response;
    }

    // Действие авторизации пользователя
    public function actionLogin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON; // указываем что ответ будет в json формате
        if (!Yii::$app->user->isGuest){ // Если уже авторизированы, то перекидываем на домашнюю страницу
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())    // Если данные были верные, то отправляем сообщение об успехе
        {
            $response = Array("Message" => Array('success' => true));   // Подготавливаем ответ
            return $response;   // отправляем данные
        }

        $response = Array("Message" => Array('error' => $model->getErrors()));  // Если не прошли авторизацию, то собираем ошибки и отправляем на клиент
        return $response;
    }

    // Дейставие выхода и ЛК
    public function actionLogout()
    {
        Yii::$app->user->logout();  // Удаление данных авторизации
        return $this->goHome(); // Переход на домашнюю страницу
    }
}