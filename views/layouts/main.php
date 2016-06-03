<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="w3-container">
    <ul class="w3-navbar w3-border w3-light-grey">
        <?php if (Yii::$app->user->isGuest): ?>
            <li><a class="w3-hover-blue-grey  w3-large" id="reg-btn" href="#"><i class="fa fa-user-plus w3-large"></i>Регистрация</a></li>
            <li><a class="w3-hover-blue-grey w3-large" id="auth-btn" href="#"><i class="fa fa-sign-in w3-large"></i>Войти</a> </li>
        <?php else: ?>
            <li><a class="w3-hover-blue-grey w3-large w3-text-light-green" id="addAd-btn" href="#"><i class="fa fa-plus w3-large "></i> Добавить объявление</a></li>
            <li><a class="w3-hover-blue-grey w3-large w3-text-red" href="/user/logout"><i class="fa fa-sign-out w3-large "></i> Выйти</a></li>
        <?php endif; ?>
        <li class="w3-right"><h4 class="logo">AutoSale</h4></li>
    </ul>
    <?= $content ?>
</div>


<?php if (Yii::$app->user->isGuest): ?>
    <?= $this->render('//site/reg') ?>
    <?= $this->render('//site/login') ?>
<?php else: ?>
    <?= $this->render('//site/addAd') ?>
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
