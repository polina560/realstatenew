<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\ApartmentSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Apartment
 */

$this->title = Yii::t('app', 'Apartments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?=
            RbacHtml::a(Yii::t('app', 'Create Apartment'), ['create'], ['class' => 'btn btn-success']);
//           $this->render('_create_modal', ['model' => $model]);
        ?>
    </div>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            Column::widget(),
            Column::widget(['attr' => 'title']),
            Column::widget(['attr' => 'subtitle']),
            Column::widget(['attr' => 'description']),
            Column::widget(['attr' => 'price']),
//            Column::widget(['attr' => 'floor']),
//            Column::widget(['attr' => 'img']),
//            Column::widget(['attr' => 'address']),
//            Column::widget(['attr' => 'add_title']),
//            Column::widget(['attr' => 'add_img']),
//            Column::widget(['attr' => 'API_flag']),
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{room}',
                'buttons' => [
                    'room' => function ($url, $model, $key) {
                        return Html::a('Комнаты', Url::toRoute(['room/index', 'id_apartment' => $model->id]), ['data-pjax' => '0']);
//                            Html::a('Комнаты', ['room/index', 'id_apartment' => $model->id]);
//                            Html::a('Комнаты', Url::to(['room/index', 'id_apartment' => $model->id]));
                    },
                ],
            ],

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
