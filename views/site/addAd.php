<?
use yii\widgets\ActiveForm;

$modelAd = Yii::$app->params['modelAd'];
$count = $modelAd->LimitIsExceeded();
?>

<!--Модальное окно добавления объявления-->
<div class="w3-hide">
    <div class="box-modal" id="ModalAddAd">
        <div class="box-modal_close arcticmodal-close w3-xlarge"><i class="fa fa-close"></i></div>
        <?php $form = ActiveForm::begin(
            ['options' => [
                'id' => 'form-AddAd',
                'class' => 'w3-container w3-light-grey w3-padding-12 w3-round-large form-AddAd',
                'model-form' => 'AdForm'
            ]]); ?>
        <h2>Добавить объявление</h2>
        <hr>

        <? if ($count === true): ?>
            <div class="row-input">
                <label><?= $modelAd->getAttributeLabel('Region'); ?></label>
                <select class="w3-select w3-border" name="AdForm[Region]">
                    <option disabled selected>Выберите область</option>
                    <? foreach ($modelAd->Region as $key => $value): ?>
                        <option value="<?= $value["Id"] ?>"><?= $value["Name"] ?></option>
                    <? endforeach; ?>
                </select>

                <div class="messageBlock">
                    <p class="w3-hide message"></p>
                </div>
            </div>

            <div class="w3-hide CityRow row-input">
                <label><?= $modelAd->getAttributeLabel('City'); ?></label>
                <select class="w3-select w3-border" name="AdForm[City]">
                    <option disabled selected>Выберите город</option>
                </select>

                <div class="messageBlock">
                    <p class="w3-hide message"></p>
                </div>
            </div>

            <div class="row-input">
                <label><?= $modelAd->getAttributeLabel('Mark'); ?></label>
                <select class="w3-select w3-border" name="AdForm[Mark]">
                    <option disabled selected>Выберите марку</option>
                    <? foreach ($modelAd->Mark as $key => $value): ?>
                        <option value="<?= $value["Id"] ?>"><?= $value["Name"] ?></option>
                    <? endforeach; ?>
                </select>

                <div class="messageBlock">
                    <p class="w3-hide message"></p>
                </div>
            </div>

            <div class="w3-hide ModelRow row-input">
                <label><?= $modelAd->getAttributeLabel('Model'); ?></label>
                <select class="w3-select w3-border" name="AdForm[Model]">
                    <option disabled selected>Выберите модель</option>
                </select>

                <div class="messageBlock">
                    <p class="w3-hide message"></p>
                </div>
            </div>

            <div class="row-input">
                <label><?= $modelAd->getAttributeLabel('EngineCapacity'); ?></label>
                <select class="w3-select w3-border" name="AdForm[EngineCapacity]">
                    <option disabled selected>Выберите мощность двигателя</option>
                    <? foreach ($modelAd->EngineCapacity as $key => $value): ?>
                        <option value="<?= $value["Id"] ?>"><?= $value["Value"] ?></option>
                    <? endforeach; ?>
                </select>

                <div class="messageBlock">
                    <p class="w3-hide message"></p>
                </div>
            </div>

            <div class="row-input">
                <label><?= $modelAd->getAttributeLabel('NumberHosts'); ?></label>
                <select class="w3-select w3-border" name="AdForm[NumberHosts]">
                    <option disabled selected>Выберите количество владельцев</option>
                    <? foreach ($modelAd->NumberHosts as $key => $value): ?>
                        <option value="<?= $value["Id"] ?>"><?= $value["Value"] ?></option>
                    <? endforeach; ?>
                </select>

                <div class="messageBlock">
                    <p class="w3-hide message"></p>
                </div>
            </div>

            <div class="row-input">
                <label><?= $modelAd->getAttributeLabel('Mileage'); ?></label>
                <select class="w3-select w3-border" name="AdForm[Mileage]">
                    <option disabled selected>Выберите пробег</option>
                    <? foreach ($modelAd->Mileage as $key => $value): ?>
                        <option value="<?= $value["Id"] ?>"><?= $value["Value"] ?></option>
                    <? endforeach; ?>
                </select>

                <div class="messageBlock">
                    <p class="w3-hide message"></p>
                </div>
            </div>

            <div class="row-input">
                <input type="file" id="files" name="AdForm[Images][]" accept="image/jpeg,image/png" multiple/>

                <div class="messageBlock">
                    <p class="w3-hide message"></p>
                </div>
                <span class="loaderFiles w3-large w3-hide"><i class="fa fa-spinner fa-spin"></i></span>

                <output id="list"></output>
            </div>

            <p class="w3-hide" id="messageAdAdd"></p>

            <p class="loader w3-hide"><i class="fa fa-spinner fa-spin"></i></p>

            <div class="w3-col s12 w3-margin">
                <input class="w3-btn w3-round-large w3-blue-grey w3-large w3-padding" type="button" value="Добавить"
                       id="send-AddAd-btn">
            </div>

        <? else: ?>

            <h4 class="w3-text-red w3-center"> Превышен лимит добавления обьявлений, возможно не более <?= $count ?>
                обьявлений. </h4>

        <? endif; ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>