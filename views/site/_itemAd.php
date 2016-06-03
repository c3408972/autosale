<!--Страница для listView, генерация елементов-->

<div class="w3-col w3-row-padding s4 w3-padding">
    <div class="w3-card-4 w3-display-container imagesAuto">

        <?php foreach ($model['images'] as $image): ?>
            <img class="w3-hide" src="/web/uploads/<?= $image['Url'] ?>" alt="Norway">
        <? endforeach; ?>
        <div class="w3-container w3-center characteristics">
            <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable">
                <tr>
                    <td><?= $modelAd->getAttributeLabel('Region'); ?></td>
                    <td><?= $model['region'][0]['Name'] ?></td>
                </tr>
                <tr>
                    <td><?= $modelAd->getAttributeLabel('City'); ?></td>
                    <td><?= $model['city']['Name'] ?></td>
                </tr>
                <tr>
                    <td><?= $modelAd->getAttributeLabel('Mark'); ?></td>
                    <td><?= $model['mark'][0]['Name'] ?></td>
                </tr>
                <tr>
                    <td><?= $modelAd->getAttributeLabel('Model'); ?></td>
                    <td><?= $model['model']['Name'] ?></td>
                </tr>
                <tr>
                    <td><?= $modelAd->getAttributeLabel('EngineCapacity'); ?></td>
                    <td><?= $model['engineCapacity']['Value'] ?></td>
                </tr>
                <tr>
                    <td><?= $modelAd->getAttributeLabel('NumberHosts'); ?></td>
                    <td><?= $model['numberHosts']['Value'] ?></td>
                </tr>
                <tr>
                    <td><?= $modelAd->getAttributeLabel('Mileage'); ?></td>
                    <td><?= $model['mileage']['Value'] ?></td>
                </tr>
            </table>
        </div>
        <a change-img="prev" class="w3-btn-floating w3-dark-grey arrows left">❮</a>
        <a change-img="next" class="w3-btn-floating w3-dark-grey arrows right">❯</a>
    </div>
</div>
