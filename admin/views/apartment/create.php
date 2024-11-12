<?php

use common\components\helpers\UserUrl;
use common\models\ApartmentSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Apartment
 */

$this->title = Yii::t('app', 'Create Apartment');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Apartments'),
    'url' => UserUrl::setFilters(ApartmentSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
