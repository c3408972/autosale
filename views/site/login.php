<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'][] = $this->title;
?>


<!--Модальное окно авторизации-->
<div class="w3-hide">
    <div class="box-modal" id="ModalAuth">
        <div class="box-modal_close arcticmodal-close w3-xlarge"><i class="fa fa-close"></i></div>
        <?php $form = ActiveForm::begin(
            ['options' => [
                'id' => 'form-auth',
                'class' => 'w3-container w3-light-grey w3-padding-12 w3-round-large'
            ]]); ?>
        <h2>Авторизация</h2>
        <hr>

        <div class="row-input">
            <label>E-mail</label>
            <input class="w3-input w3-border" name="LoginForm[email]" placeholder="Введите e-mail" type="text">

            <div class="messageBlock">
                <p class="w3-hide message"></p>
            </div>
        </div>

        <div class="row-input">
            <label>Пароль</label>
            <input class="w3-input w3-border" placeholder="Введите пароль" name="LoginForm[password]" type="password">

            <div class="messageBlock">
                <p class="w3-hide message"></p>
            </div>
        </div>

        <p class="loader w3-hide"><i class="fa fa-spinner fa-spin"></i></p>
        <input type="button" id="send-logIn-btn" class="w3-btn w3-blue-grey" value="Войти"/>
        <?php ActiveForm::end(); ?>
    </div>
</div>