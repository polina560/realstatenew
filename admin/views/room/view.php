<?php

use admin\components\widgets\detailView\Column;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\RoomSearch;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Room
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Apartment'), 'url' => ['/apartment/index']];
$this->params['breadcrumbs'][] = ['label' => $model->apartment->title, 'url' => ['/apartment/view', 'id' => $model->id_apartment]];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Rooms'),
    'url' => UserUrl::setFilters(RoomSearch::class, ['index', 'id_apartment' => $model->apartment->id])
];
$this->params['breadcrumbs'][] = RbacHtml::encode($this->title);
?>
<div class="room-view">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <p>
        <?= RbacHtml::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= RbacHtml::a(
            Yii::t('app', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post'
                ]
            ]
        ) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            Column::widget(),
            Column::widget(['attr' => 'id_apartment', 'viewAttr' => 'apartment.title']),
            Column::widget(['attr' => 'title']),
            Column::widget(['attr' => 'area']),
            Column::widget(['attr' => 'uid']),
        ]
    ]) ?>

</div>
