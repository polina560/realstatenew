<?php

use common\components\helpers\UserUrl;
use common\models\RoomSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Room
 */

$this->title = Yii::t('app', 'Create Room');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Rooms'),
    'url' => UserUrl::setFilters(RoomSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
