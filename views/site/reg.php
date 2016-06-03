<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */
?>

<!--Модальное окно регистрации-->
<div class="w3-hide">
    <div class="box-modal" id="ModalReg">
        <div class="box-modal_close arcticmodal-close w3-xlarge"><i class="fa fa-close"></i></div>
        <?php $form = ActiveForm::begin(
            ['options' => [
                'id' => 'form-reg',
                'class' => 'w3-container w3-light-grey w3-padding-12 w3-round-large'
            ]]); ?>
        <h2>Регистрация</h2>
        <hr>

        <div class="row-input">

            <label>E-mail</label>
            <input class="w3-input w3-border" maxlength="50" name="RegForm[email]" placeholder="Введите e-mail"
                   type="text">

            <div class="messageBlock">
                <p class="w3-hide message"></p>
            </div>
        </div>

        <div class="row-input">
            <label>Пароль</label>
            <input class="w3-input w3-border" placeholder="Введите пароль" name="RegForm[password]"
                   type="password">

            <div class="messageBlock">
                <p class="w3-hide message"></p>
            </div>
        </div>

        <div class="row-input">
            <label>Повторить пароль</label>
            <input class="w3-input w3-border"  placeholder="Повторите пароль"
                   name="RegForm[passwordRepeat]" type="password">

            <div class="messageBlock">
                <p class="w3-hide message"></p>
            </div>
        </div>
        <div class="row-input">
            <input type="button" id="send-register-btn" class="w3-btn w3-blue-grey" value="Регистрация"/>
            <span class="loader w3-hide"><i class="fa fa-spinner fa-spin  "></i></span>
            <span class="w3-hide" id="messageReg"></span>
        </div>
        <?php ActiveForm::end(); ?>
    </div>