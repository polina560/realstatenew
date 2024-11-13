<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\RoomSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Room
 */


$this->title = Yii::t('app', 'Rooms');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Apartment'), 'url' => ['/apartment/index']];
$this->params['breadcrumbs'][] = ['label' => $searchModel->apartment->title, 'url' => ['/apartment/view', 'id' => $searchModel->id_apartment]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

<!--    <div>-->
<!--        --><?php //=
//            RbacHtml::a(Yii::t('app', 'Create Room'), ['create', 'id_apartment'=>$searchModel->apartment->id], ['class' => 'btn btn-success']);
////           $this->render('_create_modal', ['model' => $model]);
//        ?>
<!--    </div>-->

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            Column::widget(),
//            Column::widget(['attr' => 'id_apartment']),
            Column::widget(['attr' => 'title']),
            Column::widget(['attr' => 'area']),
            Column::widget(['attr' => 'uid']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
