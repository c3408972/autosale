<?php

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ListView;


?>

<!--Главная страница, фильтры и отображение обьявлений-->

<form onsubmit="return false;" id="form-filtertAd" model-form="FilterForm"
      class="w3-container w3-light-grey w3-padding-12 " action="/" method="GET">
    <div class="w3-blue-grey w3-border w3-container filters ">
        <p class="w3-col s3">

            <label><?= $modelAd->getAttributeLabel('Region'); ?></label>
            <select class="w3-select w3-border" name="FilterForm[Region]">
                <option value="" selected>Выберите область</option>
                <? foreach ($modelAd->Region as $key => $value): ?>
                    <option value="<?= $value["Id"] ?>"><?= $value["Name"] ?></option>
                <? endforeach; ?>
            </select>
        </p>

        <p class="w3-col s3">
            <label><?= $modelAd->getAttributeLabel('City'); ?></label>
            <select class="w3-select w3-border" name="FilterForm[City]">
                <option value="" selected>Выберите город</option>
            </select>
        </p>

        <p class="w3-col s3">
            <label><?= $modelAd->getAttributeLabel('Mark'); ?></label>
            <select class="w3-select w3-border" name="FilterForm[Mark]">
                <option value="" selected>Выберите марку</option>
                <? foreach ($modelAd->Mark as $key => $value): ?>
                    <option value="<?= $value["Id"] ?>"><?= $value["Name"] ?></option>
                <? endforeach; ?>
            </select>
        </p>

        <p class="w3-col s3">
            <label><?= $modelAd->getAttributeLabel('Model'); ?></label>
            <select class="w3-select w3-border" name="FilterForm[Model]">
                <option value="" selected>Выберите модель</option>
            </select>
        </p>


        <p class="w3-col s3">
            <label><?= $modelAd->getAttributeLabel('EngineCapacity'); ?></label>
            <select class="w3-select w3-border" name="FilterForm[EngineCapacity]">
                <option value="" selected>Выберите мощность двигателя</option>
                <? foreach ($modelAd->EngineCapacity as $key => $value): ?>
                    <option value="<?= $value["Id"] ?>"><?= $value["Value"] ?></option>
                <? endforeach; ?>
            </select>
        </p>

        <p class="w3-col s3">
            <label><?= $modelAd->getAttributeLabel('NumberHosts'); ?></label>
            <select class="w3-select w3-border" name="FilterForm[NumberHosts]">
                <option value="" selected>Выберите количество владельцев</option>
                <? foreach ($modelAd->NumberHosts as $key => $value): ?>
                    <option value="<?= $value["Id"] ?>"><?= $value["Value"] ?></option>
                <? endforeach; ?>
            </select>
        </p>

        <p class="w3-col s3">
            <label><?= $modelAd->getAttributeLabel('Mileage'); ?></label>
            <select class="w3-select w3-border" name="FilterForm[Mileage]">
                <option value="" selected>Выберите пробег</option>
                <? foreach ($modelAd->Mileage as $key => $value): ?>
                    <option value="<?= $value["Id"] ?>"><?= $value["Value"] ?></option>
                <? endforeach; ?>
            </select>
        </p>

        <p class="w3-col s3">
            <button id="search" name="submit" value="search"
                    class="w3-select w3-btn w3-light-green w3-border w3-padding-24 w3-large"><i
                    class="fa fa-search"></i>
                Поиск
            </button>
        </p>
    </div>

</form>

<!--Оборачиваем аяком-->
<?php Pjax::begin(); ?>

<div id="items-search" class="w3-border w3-container ">

<!--     Виджет для генерации обьявлений по шаблону в _itemAd-->
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_itemAd',
        'viewParams' => [
            'modelAd' => $modelAd,
        ]
    ]); ?>

<!--    Инициализируем картинки (задаем отображаение + подписка на событие), нужно что бы после пагинации всё работало.-->
    <script>
        InitImage();
    </script>
</div>


<?php Pjax::end() ?>
