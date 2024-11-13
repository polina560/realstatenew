<?php

use admin\components\widgets\detailView\Column;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\ApartmentSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Apartment
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Apartments'),
    'url' => UserUrl::setFilters(ApartmentSearch::class)
];
$this->params['breadcrumbs'][] = RbacHtml::encode($this->title);
?>
<div class="apartment-view">

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
            Column::widget(['attr' => 'title']),
            Column::widget(['attr' => 'subtitle']),
            Column::widget(['attr' => 'description']),
            Column::widget(['attr' => 'price']),
            Column::widget(['attr' => 'floor']),
            Column::widget(['attr' => 'img']),

            [
                'label' => 'Комнаты',
                'format' => 'raw',
                'value' => static function(\common\models\Apartment $apartment) {
                    $res = '';
                    foreach ($apartment->rooms as $room) {
                        $res = $res . $room->title . ', ';
//                        $res = Html::a($room->title, Url::toRoute(['room/view', 'id' => $room->id]), ['data-pjax' => '0']);
                    }
                    return $res;
                }
            ],
            Column::widget(['attr' => 'address']),
            Column::widget(['attr' => 'add_title']),
            Column::widget(['attr' => 'add_img']),
            Column::widget(['attr' => 'API_flag']),
        ]
    ]) ?>

</div>
