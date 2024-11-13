<?php

use common\components\helpers\UserUrl;
use common\models\ApartmentSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $modelApartment common\models\Apartment
 * @var $modelsRooms common\models\Room
 */

$this->title = Yii::t('app', 'Update Apartment: {name}', [
    'name' => $modelApartment->title,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Apartments'),
    'url' => UserUrl::setFilters(ApartmentSearch::class)
];
$this->params['breadcrumbs'][] = ['label' => Html::encode($modelApartment->title), 'url' => ['view', 'id' => $modelApartment->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="apartment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelApartment' => $modelApartment,
        'modelsRooms' => $modelsRooms,
        'isCreate' => false
    ]) ?>

</div>
