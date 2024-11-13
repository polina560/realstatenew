<?php

use common\components\helpers\UserUrl;
use common\models\RoomSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Room
 */

$this->title = Yii::t('app', 'Create Room');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Apartment'), 'url' => ['/apartment/index']];
$this->params['breadcrumbs'][] = ['label' => $model->apartment->title, 'url' => ['/apartment/view', 'id' => $model->id_apartment]];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Rooms'),
    'url' => UserUrl::setFilters(RoomSearch::class, ['index', 'id_apartment' => $model->apartment->id])
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
