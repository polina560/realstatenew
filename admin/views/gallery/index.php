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
 * @var $searchModel  common\models\GallerySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Gallery
 */

$this->title = Yii::t('app', 'Gallery');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?=
            RbacHtml::a(Yii::t('app', 'Create Gallery'), ['create'], ['class' => 'btn btn-success']);
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
            Column::widget(['attr' => 'name']),


//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{room}',
//                'buttons' => [
//                    'room' => function ($url, $model, $key) {
//                        return Html::a('Изображения', Url::to(['gallery-image/index', 'id_gallery' => $model->id]));
////                            Html::a('Комнаты', ['room/index', 'id_apartment' => $model->id]);
//                    },
//                ],
//            ],

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
